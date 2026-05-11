#!/usr/bin/env php
<?php

/**
 * ESI SDK Generator
 *
 * Fetches the ESI OpenAPI spec and generates:
 *   - src/Generated/Resources/{Tag}Resource.php  (one per ESI tag group)
 *   - src/Generated/Responses/{Tag}/{OperationId}Response.php  (DTOs)
 *
 * Usage:
 *   php bin/generate.php
 *   php bin/generate.php --spec=/path/to/swagger.json   (use local file)
 *   php bin/generate.php --dry-run                       (print to stdout, don't write)
 *
 * Compatibility-date policy:
 *   The spec is fetched from the URL defined in ESI_SPEC_URL (with ?version=_latest).
 *   The compatibility_date constant at the top of this file must be updated when the
 *   spec is regenerated. A major version bump to esi-client is required when the
 *   compatibility_date changes (it affects the X-Compatibility-Date header sent to ESI).
 */

declare(strict_types=1);

// ---------------------------------------------------------------------------
// Configuration
// ---------------------------------------------------------------------------

const ESI_SPEC_URL = 'https://esi.evetech.net/latest/swagger.json';

/** The X-Compatibility-Date sent with every ESI request by this client version. */
const ESI_COMPATIBILITY_DATE = '2025-10-01';

/** Parameters that are ESI infrastructure noise — never exposed in method signatures. */
const SKIP_PARAMS = ['datasource', 'If-None-Match', 'token', 'user_agent', 'Accept-Language'];

$dryRun   = in_array('--dry-run', $argv, true);
$specFile = null;
foreach ($argv as $arg) {
    if (str_starts_with($arg, '--spec=')) {
        $specFile = substr($arg, 7);
    }
}

$generatedDir = __DIR__.'/../src/Generated';

// ---------------------------------------------------------------------------
// Load spec
// ---------------------------------------------------------------------------

echo "Loading ESI spec...\n";
$specJson = $specFile ? file_get_contents($specFile) : file_get_contents(ESI_SPEC_URL);
if ($specJson === false) {
    fwrite(STDERR, "ERROR: Failed to load ESI spec.\n");
    exit(1);
}
$spec = json_decode($specJson, true, 512, JSON_THROW_ON_ERROR);
echo "Loaded. Processing ".count($spec['paths'])." paths.\n";

// ---------------------------------------------------------------------------
// Helpers
// ---------------------------------------------------------------------------

function resolveParam(array $param, array $spec): array
{
    if (isset($param['$ref'])) {
        $key = basename($param['$ref']);
        return $spec['parameters'][$key] ?? $param;
    }
    return $param;
}

function toCamelCase(string $snake): string
{
    return lcfirst(str_replace('_', '', ucwords($snake, '_')));
}

function toPascalCase(string $snake): string
{
    return str_replace('_', '', ucwords($snake, '_'));
}

/** "Faction Warfare" → "FactionWarfareResource" */
function tagToResourceClass(string $tag): string
{
    return str_replace(' ', '', ucwords($tag)).'Resource';
}

/** "Faction Warfare" → "FactionWarfare" (namespace subdir) */
function tagToNamespace(string $tag): string
{
    return str_replace(' ', '', ucwords($tag));
}

/** Map swagger type to PHP type hint */
function swaggerTypeToPhp(string $type, string $format = ''): string
{
    return match (true) {
        $type === 'integer'           => 'int',
        $type === 'boolean'           => 'bool',
        $type === 'number'            => 'float',
        $type === 'string'            => 'string',
        $type === 'array'             => 'array',
        default                       => 'mixed',
    };
}

/**
 * Generate a DTO class from a schema object.
 * Returns [className, phpCode, nestedDtos[]]
 * nestedDtos is an array of ['class'=>..., 'namespace'=>..., 'code'=>...]
 */
function generateDto(
    string $className,
    string $namespace,
    array $schema,
    array $spec,
    bool $isItem = false
): array {
    $properties = $schema['properties'] ?? [];
    $required   = $schema['required'] ?? [];

    if (empty($properties)) {
        // Primitive or empty schema — don't generate a DTO
        return [$className, null, []];
    }

    $nestedDtos = [];

    // Separate required vs optional
    $requiredProps  = [];
    $optionalProps  = [];
    foreach ($properties as $propName => $propSchema) {
        if (in_array($propName, $required, true)) {
            $requiredProps[$propName] = $propSchema;
        } else {
            $optionalProps[$propName] = $propSchema;
        }
    }

    $lines = [];
    $fromLines = [];

    foreach ([$requiredProps, $optionalProps] as $isOptional => $props) {
        foreach ($props as $propName => $propSchema) {
            $phpType = resolvePropType($propName, $propSchema, $className, $namespace, $spec, $nestedDtos);
            $nullable = (bool) $isOptional;
            if ($nullable) {
                $lines[]     = "        public readonly ?{$phpType} \${$propName} = null,";
                $fromLines[] = "            {$propName}: \$data->{$propName} ?? null,";
            } else {
                $lines[]     = "        public readonly {$phpType} \${$propName},";
                $fromLines[] = "            {$propName}: \$data->{$propName},";
            }
        }
    }

    // Build from() body with casting for nested DTOs
    $fromBody = buildFromBody($properties, $required, $className, $namespace, $nestedDtos);

    $constructorBody = implode("\n", $lines);

    $code = <<<PHP
<?php

namespace Seatplus\\EsiClient\\Generated\\Responses\\{$namespace};

/**
 * Generated from ESI OpenAPI spec.
 * Do not edit manually — run bin/generate.php instead.
 */
readonly class {$className}
{
    public function __construct(
{$constructorBody}
    ) {}

    public static function from(object \$data): self
    {
        return new self(
{$fromBody}
        );
    }
}
PHP;

    return [$className, $code, $nestedDtos];
}

/** Resolve the PHP type for a property, generating nested DTOs as needed. */
function resolvePropType(
    string $propName,
    array $propSchema,
    string $parentClass,
    string $namespace,
    array $spec,
    array &$nestedDtos
): string {
    $type   = $propSchema['type'] ?? '';
    $format = $propSchema['format'] ?? '';

    if ($type === 'object' || isset($propSchema['properties'])) {
        // Nested object — generate a sub-DTO
        $nestedClass = $parentClass.toPascalCase($propName);
        [$nc, $code, $subNested] = generateDto($nestedClass, $namespace, $propSchema, $spec);
        if ($code) {
            $nestedDtos[] = ['class' => $nestedClass, 'namespace' => $namespace, 'code' => $code];
            $nestedDtos   = array_merge($nestedDtos, $subNested);
        }
        return $nestedClass;
    }

    if ($type === 'array') {
        $items = $propSchema['items'] ?? [];
        $itemType = $items['type'] ?? '';
        if ($itemType === 'object' || isset($items['properties'])) {
            $nestedClass = $parentClass.toPascalCase($propName).'Item';
            [$nc, $code, $subNested] = generateDto($nestedClass, $namespace, $items, $spec);
            if ($code) {
                $nestedDtos[] = ['class' => $nestedClass, 'namespace' => $namespace, 'code' => $code];
                $nestedDtos   = array_merge($nestedDtos, $subNested);
            }
        }
        return 'array';
    }

    return swaggerTypeToPhp($type, $format);
}

/** Build the body of the from() method, with proper casting for nested DTOs and arrays. */
function buildFromBody(
    array $properties,
    array $required,
    string $parentClass,
    string $namespace,
    array $nestedDtos
): string {
    $nestedClassNames = array_column($nestedDtos, 'class');

    $lines = [];
    // Required first
    foreach ([$required, array_diff(array_keys($properties), $required)] as $isOptional => $propNames) {
        foreach ((array) $propNames as $propName) {
            if (! isset($properties[$propName])) {
                continue;
            }
            $propSchema = $properties[$propName];
            $type       = $propSchema['type'] ?? '';

            if ($type === 'object' || isset($propSchema['properties'])) {
                $nestedClass = $parentClass.toPascalCase($propName);
                if ((bool) $isOptional) {
                    $lines[] = "            {$propName}: isset(\$data->{$propName}) ? {$nestedClass}::from(\$data->{$propName}) : null,";
                } else {
                    $lines[] = "            {$propName}: {$nestedClass}::from(\$data->{$propName}),";
                }
                continue;
            }

            if ($type === 'array') {
                $items     = $propSchema['items'] ?? [];
                $itemType  = $items['type'] ?? '';
                $nestedClass = $parentClass.toPascalCase($propName).'Item';
                if (($itemType === 'object' || isset($items['properties'])) && in_array($nestedClass, $nestedClassNames, true)) {
                    if ((bool) $isOptional) {
                        $lines[] = "            {$propName}: isset(\$data->{$propName}) ? array_map(fn(object \$i) => {$nestedClass}::from(\$i), (array) \$data->{$propName}) : null,";
                    } else {
                        $lines[] = "            {$propName}: array_map(fn(object \$i) => {$nestedClass}::from(\$i), (array) \$data->{$propName}),";
                    }
                    continue;
                }
            }

            if ((bool) $isOptional) {
                $lines[] = "            {$propName}: \$data->{$propName} ?? null,";
            } else {
                $lines[] = "            {$propName}: \$data->{$propName},";
            }
        }
    }

    return implode("\n", $lines);
}

// ---------------------------------------------------------------------------
// Process operations
// ---------------------------------------------------------------------------

/** @var array<string, list<array>> $resourceOps  tag → list of operations */
$resourceOps = [];

/** @var array<string, array{namespace: string, code: string}> $allDtos */
$allDtos = [];

foreach ($spec['paths'] as $path => $pathData) {
    $pathLevelParams = array_map(
        fn (array $p) => resolveParam($p, $spec),
        $pathData['parameters'] ?? []
    );

    foreach (['get', 'post', 'put', 'delete'] as $httpMethod) {
        if (! isset($pathData[$httpMethod])) {
            continue;
        }
        $op = $pathData[$httpMethod];

        $tag         = $op['tags'][0] ?? 'Unknown';
        $operationId = $op['operationId'] ?? '';
        $methodName  = toCamelCase($operationId);
        $namespace   = tagToNamespace($tag);

        // Collect and filter parameters
        $opParams = array_map(
            fn (array $p) => resolveParam($p, $spec),
            $op['parameters'] ?? []
        );
        $allParams = array_merge($pathLevelParams, $opParams);

        // Deduplicate by name (op-level overrides path-level)
        $paramsByName = [];
        foreach ($allParams as $p) {
            $paramsByName[$p['name']] = $p;
        }

        $filteredParams = array_filter(
            $paramsByName,
            fn (array $p) => ! in_array($p['name'], SKIP_PARAMS, true)
        );

        // Sort: required path first, required query/body next, optional last
        usort($filteredParams, function (array $a, array $b): int {
            $inOrder   = ['path' => 0, 'query' => 1, 'body' => 2, 'header' => 3];
            $aRequired = $a['required'] ?? false;
            $bRequired = $b['required'] ?? false;
            // Required params always before optional
            if ($aRequired !== $bRequired) {
                return $bRequired <=> $aRequired; // true > false
            }
            return ($inOrder[$a['in']] ?? 9) <=> ($inOrder[$b['in']] ?? 9);
        });

        // Determine response schema
        $resp200    = $op['responses']['200'] ?? null;
        $schema     = $resp200['schema'] ?? null;
        $xPages     = isset($resp200['headers']['X-Pages']);
        $isAuth     = isset($paramsByName['token']);

        $responseType = 'void';
        $dtoClass     = null;
        $returnPhpDoc = 'EsiResult<null>';
        $phpItemType  = 'mixed';
        $phpType      = 'mixed';

        if ($schema) {
            $stype = $schema['type'] ?? (isset($schema['properties']) ? 'object' : '');

            if ($stype === 'object' || isset($schema['properties'])) {
                $responseType = 'object';
                $dtoClass     = toPascalCase($operationId).'Response';
                [$dtoClass, $dtoCode, $nestedDtos] = generateDto($dtoClass, $namespace, $schema, $spec);
                if ($dtoCode) {
                    $allDtos[$dtoClass] = ['namespace' => $namespace, 'code' => $dtoCode];
                    foreach ($nestedDtos as $nd) {
                        $allDtos[$nd['class']] = ['namespace' => $nd['namespace'], 'code' => $nd['code']];
                    }
                }
                $returnPhpDoc = "EsiResult<{$dtoClass}>";

            } elseif ($stype === 'array') {
                $items    = $schema['items'] ?? [];
                $itemType = $items['type'] ?? (isset($items['properties']) ? 'object' : '');

                if ($itemType === 'object' || isset($items['properties'])) {
                    $responseType = $xPages ? 'paginated_array' : 'plain_array';
                    $dtoClass     = toPascalCase($operationId).'Item';
                    [$dtoClass, $dtoCode, $nestedDtos] = generateDto($dtoClass, $namespace, $items, $spec);
                    if ($dtoCode) {
                        $allDtos[$dtoClass] = ['namespace' => $namespace, 'code' => $dtoCode];
                        foreach ($nestedDtos as $nd) {
                            $allDtos[$nd['class']] = ['namespace' => $nd['namespace'], 'code' => $nd['code']];
                        }
                    }
                    $returnPhpDoc = "EsiResult<array<{$dtoClass}>>";
                } else {
                    // Primitive array (array of int/string/etc.)
                    $phpItemType  = swaggerTypeToPhp($itemType);
                    $responseType = 'primitive_array';
                    $returnPhpDoc = "EsiResult<array<{$phpItemType}>>";
                }
            } else {
                // Scalar (number/integer/string)
                $phpType      = swaggerTypeToPhp($stype);
                $phpItemType  = $phpType;
                $responseType = 'scalar';
                $returnPhpDoc = "EsiResult<{$phpType}>";
            }
        }

        $resourceOps[$tag][] = [
            'httpMethod'   => $httpMethod,
            'path'         => $path,
            'operationId'  => $operationId,
            'methodName'   => $methodName,
            'params'       => array_values($filteredParams),
            'responseType' => $responseType,
            'dtoClass'     => $dtoClass,
            'namespace'    => $namespace,
            'returnPhpDoc' => $returnPhpDoc,
            'xPages'       => $xPages,
            'isAuth'       => $isAuth,
            'phpItemType'  => $phpItemType ?? ($phpType ?? 'mixed'),
        ];
    }
}

// ---------------------------------------------------------------------------
// Generate resource files
// ---------------------------------------------------------------------------

function buildMethodSignature(array $op): string
{
    $args = [];
    foreach ($op['params'] as $param) {
        // Body params have a schema.type, not a top-level type
        $schemaType = $param['schema']['type'] ?? null;
        $phpType  = swaggerTypeToPhp($param['type'] ?? ($schemaType ?? 'mixed'), $param['format'] ?? '');
        if ($param['in'] === 'body') {
            $phpType = 'mixed'; // body can be array or object depending on schema
        }
        $name     = lcfirst(toPascalCase($param['name']));
        $required = $param['required'] ?? false;

        if ($name === 'page') {
            $args[] = "int \$page = 1";
        } elseif ($required) {
            $args[] = "{$phpType} \${$name}";
        } else {
            $args[] = "?{$phpType} \${$name} = null";
        }
    }

    return implode(', ', $args);
}

function buildInvokeCall(array $op): string
{
    $path      = $op['path'];
    $method    = $op['httpMethod'];
    $uriData   = [];
    $queryData = [];
    $bodyVar   = null;

    foreach ($op['params'] as $param) {
        $name = lcfirst(toPascalCase($param['name']));
        if ($param['in'] === 'path') {
            $uriData[] = "'{$param['name']}' => \${$name}";
        } elseif ($param['in'] === 'query') {
            $queryData[] = "'{$param['name']}' => \${$name}";
        } elseif ($param['in'] === 'body') {
            $bodyVar = $name;
        }
    }

    $uriDataStr   = empty($uriData)   ? '[]' : '['.implode(', ', $uriData).']';
    $queryDataStr = empty($queryData) ? '[]' : '['.implode(', ', $queryData).']';
    $bodyStr      = $bodyVar ? "(array) \${$bodyVar}" : '[]';

    if ($bodyVar || $method !== 'get') {
        return "\$this->client->invoke('{$method}', '{$path}', {$uriDataStr}, 'latest', {$queryDataStr}, {$bodyStr})";
    }

    return "\$this->client->invoke('{$method}', '{$path}', {$uriDataStr}, 'latest', {$queryDataStr})";
}

function buildReturnStatement(array $op): string
{
    $responseType = $op['responseType'];
    $dtoClass     = $op['dtoClass'];
    $invoke       = buildInvokeCall($op);
    $phpItemType  = $op['phpItemType'] ?? 'int';

    switch ($responseType) {
        case 'object':
            return <<<PHP
        \$response = {$invoke};
        return EsiResult::fromResponse(\$response, {$dtoClass}::from(\$response->data));
PHP;
        case 'paginated_array':
        case 'plain_array':
            return <<<PHP
        \$response = {$invoke};
        return EsiResult::fromResponse(\$response, array_map(
            fn(object \$item) => {$dtoClass}::from(\$item),
            (array) \$response->data,
        ));
PHP;
        case 'primitive_array':
            return <<<PHP
        \$response = {$invoke};
        /** @var array<{$phpItemType}> \$data */
        \$data = array_values((array) \$response->data);
        return EsiResult::fromResponse(\$response, \$data);
PHP;
        case 'scalar':
            return <<<PHP
        \$response = {$invoke};
        /** @var {$phpItemType} \$scalar */
        \$scalar = json_decode(\$response->raw);
        return EsiResult::fromResponse(\$response, \$scalar);
PHP;
        default: // void
            return <<<PHP
        \$response = {$invoke};
        return EsiResult::fromResponse(\$response, null);
PHP;
    }
}

function generateResourceFile(string $tag, array $ops, array $allDtos): string
{
    $resourceClass = tagToResourceClass($tag);
    $namespace     = tagToNamespace($tag);

    // Collect use statements for DTOs
    $useStatements = [];
    foreach ($ops as $op) {
        if ($op['dtoClass']) {
            $useStatements[] = "use Seatplus\\EsiClient\\Generated\\Responses\\{$namespace}\\{$op['dtoClass']};";
            // Also collect nested DTOs used in from() methods
            if (isset($allDtos[$op['dtoClass']])) {
                // nested DTOs are in the same namespace, no extra use needed
            }
        }
    }
    $useStatements = array_unique($useStatements);
    sort($useStatements);
    $useBlock = empty($useStatements) ? '' : implode("\n", $useStatements)."\n";

    $methods = [];
    foreach ($ops as $op) {
        $sig      = buildMethodSignature($op);
        $body     = buildReturnStatement($op);
        $doc      = "     * @return {$op['returnPhpDoc']}";
        $auth     = $op['isAuth'] ? "\n     * @requires-auth Use ->withToken(\$accessToken) on the client." : '';
        $paged    = $op['xPages'] ? "\n     * @paginated    Use \$page parameter to iterate pages." : '';

        $methods[] = <<<PHP
    /**
{$doc}{$auth}{$paged}
     */
    public function {$op['methodName']}({$sig}): EsiResult
    {
{$body}
    }
PHP;
    }

    $methodsBlock = implode("\n\n", $methods);
    $compatDate = ESI_COMPATIBILITY_DATE;

    return <<<PHP
<?php

namespace Seatplus\\EsiClient\\Generated\\Resources;

use Seatplus\\EsiClient\\EsiResult;
{$useBlock}
/**
 * ESI tag: {$tag}
 *
 * Generated from ESI OpenAPI spec (compatibility date: {$compatDate}).
 * Do not edit manually — run bin/generate.php instead.
 */
class {$resourceClass} extends AbstractResource
{
{$methodsBlock}
}
PHP;
}

// ---------------------------------------------------------------------------
// Write files
// ---------------------------------------------------------------------------

$writtenFiles = 0;

if (! $dryRun) {
    // Ensure directories exist
    foreach (array_keys($resourceOps) as $tag) {
        $dir = "{$generatedDir}/Responses/".tagToNamespace($tag);
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
    }
}

// Write resource files
foreach ($resourceOps as $tag => $ops) {
    $resourceClass = tagToResourceClass($tag);
    $code          = generateResourceFile($tag, $ops, $allDtos);
    $filePath      = "{$generatedDir}/Resources/{$resourceClass}.php";

    if ($dryRun) {
        echo "\n// === {$filePath} ===\n";
        echo substr($code, 0, 500)."...\n";
    } else {
        file_put_contents($filePath, $code);
        echo "  wrote: src/Generated/Resources/{$resourceClass}.php\n";
    }
    $writtenFiles++;
}

// Write DTO files
foreach ($allDtos as $className => $dto) {
    $dir      = "{$generatedDir}/Responses/{$dto['namespace']}";
    $filePath = "{$dir}/{$className}.php";

    if ($dryRun) {
        echo "\n// === {$filePath} ===\n";
        echo substr($dto['code'], 0, 300)."...\n";
    } else {
        file_put_contents($filePath, $dto['code']);
        echo "  wrote: src/Generated/Responses/{$dto['namespace']}/{$className}.php\n";
    }
    $writtenFiles++;
}

echo "\nDone. Wrote {$writtenFiles} files.\n";
