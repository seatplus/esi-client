#!/usr/bin/env php
<?php

/**
 * ESI SDK Generator — OpenAPI 3.1.0 edition
 *
 * Fetches the ESI OpenAPI YAML spec and generates:
 *   - src/Generated/Resources/{Tag}Resource.php  (one per tag)
 *
 * Response DTOs are NOT generated here — they live in seatplus/esi-schema.
 * Resources import from Seatplus\EsiSchema\Responses\*.
 *
 * Usage:
 *   php bin/generate.php [--compatibility-date=2025-12-16] [--spec=/path/to/openapi.yaml] [--dry-run]
 */

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

// ---------------------------------------------------------------------------
// CLI args
// ---------------------------------------------------------------------------

$args = [];
foreach (array_slice($argv, 1) as $arg) {
    if (str_starts_with($arg, '--')) {
        [$k, $v] = explode('=', ltrim($arg, '-'), 2) + [1 => 'true'];
        $args[$k] = $v;
    }
}

$dryRun = isset($args['dry-run']);
$specFile = $args['spec'] ?? null;

// ---------------------------------------------------------------------------
// Fetch compatibility dates and spec
// ---------------------------------------------------------------------------

$COMPAT_DATE_URL = 'https://esi.evetech.net/meta/compatibility-dates';
$SPEC_BASE_URL = 'https://esi.evetech.net/meta/openapi.yaml';

if (isset($args['compatibility-date'])) {
    $compatDate = $args['compatibility-date'];
} else {
    echo "Fetching compatibility dates...\n";
    $datesJson = file_get_contents($COMPAT_DATE_URL);
    $dates = json_decode($datesJson, true)['compatibility_dates'] ?? [];
    $compatDate = $dates[0] ?? '2025-12-16'; // first = latest
    echo "Using compatibility_date: {$compatDate}\n";
}

if ($specFile) {
    echo "Loading spec from file: {$specFile}\n";
    $rawSpec = file_get_contents($specFile);
} else {
    $specUrl = "{$SPEC_BASE_URL}?compatibility_date={$compatDate}";
    echo "Fetching spec from {$specUrl}...\n";
    $rawSpec = file_get_contents($specUrl);
}

$spec = Yaml::parse($rawSpec);
$schemas = $spec['components']['schemas'] ?? [];
$paths = $spec['paths'] ?? [];

define('ESI_COMPATIBILITY_DATE', $compatDate);

// ---------------------------------------------------------------------------
// Output directories
// ---------------------------------------------------------------------------

$generatedDir = __DIR__.'/../src/Generated';

// ---------------------------------------------------------------------------
// Helper: convert OAS3 type/format to PHP type
// ---------------------------------------------------------------------------

function oas3TypeToPhp(array $prop): string
{
    $type = $prop['type'] ?? 'mixed';
    $format = $prop['format'] ?? '';

    return match (true) {
        $type === 'integer' => 'int',
        $type === 'number' => 'float',
        $type === 'boolean' => 'bool',
        $type === 'string' => 'string',
        $type === 'array' => 'array',
        default => 'mixed',
    };
}

/**
 * Return a PHP zero/fallback value expression for a given PHP type.
 * Used in defensive from() — required fields use ?? fallback to survive
 * CCP stealth changes that remove fields without bumping the compatibility date.
 */
function phpTypeZeroValue(string $phpType): string
{
    return match ($phpType) {
        'int' => '0',
        'float' => '0.0',
        'bool' => 'false',
        'string' => "''",
        'array' => '[]',
        default => 'null',
    };
}

// ---------------------------------------------------------------------------
// Helper: resolve a $ref string to a PHP type (or class name if object)
// ---------------------------------------------------------------------------

/** @var array<string,string> $commonModelTypes schemaName → 'int'|'string'|'float' */
$commonModelTypes = [];

foreach ($schemas as $name => $schema) {
    if ($schema['x-common-model'] ?? false) {
        $commonModelTypes[$name] = oas3TypeToPhp($schema);
    }
}

function resolveRef(string $ref, array $commonModelTypes): string
{
    $name = basename(str_replace('#/components/schemas/', '', $ref));

    return $commonModelTypes[$name] ?? $name; // primitive or class name
}

// ---------------------------------------------------------------------------
// Helper: determine PHP type for a schema property
// ---------------------------------------------------------------------------

function propToPhpType(array $prop, array $commonModelTypes, array $schemas): string
{
    if (isset($prop['$ref'])) {
        return resolveRef($prop['$ref'], $commonModelTypes);
    }

    $type = $prop['type'] ?? 'mixed';

    if ($type === 'array') {
        $items = $prop['items'] ?? [];
        if (isset($items['$ref'])) {
            $itemType = resolveRef($items['$ref'], $commonModelTypes);

            return 'array'; // @var array<{$itemType}> used in phpdoc
        }

        return 'array';
    }

    return oas3TypeToPhp($prop);
}

// ---------------------------------------------------------------------------
// Helper: PascalCase tag → resource class name
// ---------------------------------------------------------------------------

function tagToResourceClass(string $tag): string
{
    return str_replace(' ', '', ucwords($tag)).'Resource';
}

// ---------------------------------------------------------------------------
// Generate a DTO class for an object schema (or the items of an array schema)
// ---------------------------------------------------------------------------

function generateDtoClass(
    string $className,
    array $properties,
    array $required,
    array $commonModelTypes,
    array $schemas,
    string $suffix = ''
): string {
    $requiredSet = array_flip($required);

    // Split into required (non-nullable) and optional (nullable)
    $requiredProps = [];
    $optionalProps = [];
    foreach ($properties as $propName => $prop) {
        if (isset($requiredSet[$propName])) {
            $requiredProps[$propName] = $prop;
        } else {
            $optionalProps[$propName] = $prop;
        }
    }

    $constructorLines = [];
    $fromLines = [];
    $useStatements = [];

    foreach ($requiredProps as $propName => $prop) {
        $phpType = propToPhpType($prop, $commonModelTypes, $schemas);
        // Track class references for use statements
        if (! in_array($phpType, ['int', 'float', 'bool', 'string', 'array', 'mixed'], true)) {
            $useStatements[] = "use Seatplus\\EsiClient\\Generated\\Responses\\{$phpType};";
        }
        $constructorLines[] = "        public readonly {$phpType} \${$propName},";

        if ($phpType === 'array') {
            $items = $prop['items'] ?? [];
            if (isset($items['$ref'])) {
                $itemClass = resolveRef($items['$ref'], $commonModelTypes);
                if (! in_array($itemClass, ['int', 'float', 'bool', 'string'], true)) {
                    $useStatements[] = "use Seatplus\\EsiClient\\Generated\\Responses\\{$itemClass};";
                    $fromLines[] = "            {$propName}: array_map(fn(object \$i) => {$itemClass}::from(\$i), (array) (\$data->{$propName} ?? [])),";
                } else {
                    $fromLines[] = "            {$propName}: (array) (\$data->{$propName} ?? []),";
                }
            } else {
                $fromLines[] = "            {$propName}: (array) (\$data->{$propName} ?? []),";
            }
        } elseif (! in_array($phpType, ['int', 'float', 'bool', 'string', 'array', 'mixed'], true)) {
            // Object DTO — defensive: fall back to empty object so ::from() still runs
            $fromLines[] = "            {$propName}: {$phpType}::from(\$data->{$propName} ?? new \\stdClass()),";
        } else {
            // Primitive — defensive cast with zero-value fallback
            $zero = phpTypeZeroValue($phpType);
            $cast = $phpType !== 'mixed' ? "({$phpType}) " : '';
            $fromLines[] = "            {$propName}: {$cast}(\$data->{$propName} ?? {$zero}),";
        }
    }

    foreach ($optionalProps as $propName => $prop) {
        $phpType = propToPhpType($prop, $commonModelTypes, $schemas);
        if (! in_array($phpType, ['int', 'float', 'bool', 'string', 'array', 'mixed'], true)) {
            $useStatements[] = "use Seatplus\\EsiClient\\Generated\\Responses\\{$phpType};";
        }
        if ($phpType === 'array') {
            $constructorLines[] = "        public readonly ?array \${$propName} = null,";
            $fromLines[] = "            {$propName}: isset(\$data->{$propName}) ? (array) \$data->{$propName} : null,";
        } elseif (! in_array($phpType, ['int', 'float', 'bool', 'string', 'array', 'mixed'], true)) {
            $constructorLines[] = "        public readonly ?{$phpType} \${$propName} = null,";
            $fromLines[] = "            {$propName}: isset(\$data->{$propName}) ? {$phpType}::from(\$data->{$propName}) : null,";
        } elseif ($phpType === 'mixed') {
            $constructorLines[] = "        public readonly mixed \${$propName} = null,";
            $fromLines[] = "            {$propName}: \$data->{$propName} ?? null,";
        } else {
            $constructorLines[] = "        public readonly ?{$phpType} \${$propName} = null,";
            $fromLines[] = "            {$propName}: \$data->{$propName} ?? null,";
        }
    }

    $constructorBlock = implode("\n", $constructorLines);
    $fromBlock = implode("\n", $fromLines);
    $useBlock = empty($useStatements)
        ? ''
        : "\n".implode("\n", array_unique($useStatements))."\n";

    $fullName = $className.$suffix;
    $compatDate = ESI_COMPATIBILITY_DATE;

    return <<<PHP
    <?php

    namespace Seatplus\\EsiClient\\Generated\\Responses;
    {$useBlock}
    /**
     * Generated from ESI OpenAPI spec (compatibility date: {$compatDate}).
     * Do not edit manually — run bin/generate.php instead.
     */
    readonly class {$fullName}
    {
        public function __construct(
    {$constructorBlock}
        ) {}

        public static function from(object \$data): self
        {
            return new self(
    {$fromBlock}
            );
        }
    }
    PHP;
}

// ---------------------------------------------------------------------------
// Tag → operations map
// ---------------------------------------------------------------------------

$SKIP_PARAMS = ['AcceptLanguage', 'IfNoneMatch', 'CompatibilityDate', 'Tenant', 'IfModifiedSince'];

/** @var array<string, array<array>> $tagOps */
$tagOps = [];

foreach ($paths as $path => $pathItem) {
    foreach ($pathItem as $httpMethod => $op) {
        if (! is_array($op) || ! isset($op['operationId'])) {
            continue;
        }

        $tag = str_replace(' ', '', ucwords($op['tags'][0] ?? 'Unknown'));
        $operationId = $op['operationId'];
        // method = camelCase(operationId)
        $methodName = lcfirst($operationId);

        // Collect params
        $params = [];
        foreach ($op['parameters'] ?? [] as $param) {
            if (isset($param['$ref'])) {
                // Shared param ref — get name from ref string
                $paramName = basename(str_replace('#/components/parameters/', '', $param['$ref']));
                if (in_array($paramName, $SKIP_PARAMS, true)) {
                    continue;
                }

                // We don't know details from ref — shouldn't happen for real params
                continue;
            }
            $params[] = $param;
        }

        // requestBody
        $requestBody = null;
        $rbSchema = $op['requestBody']['content']['application/json']['schema'] ?? null;
        if ($rbSchema) {
            $requestBody = $rbSchema;
        }

        // Auth
        $isAuth = ! empty($op['security']);
        $scopes = $op['security'][0]['OAuth2'] ?? [];

        // Response schema
        $resp200 = $op['responses']['200'] ?? [];
        $respSchema = $resp200['content']['application/json']['schema'] ?? null;
        $schemaRef = $respSchema['$ref'] ?? null;
        $schemaName = $schemaRef ? basename(str_replace('#/components/schemas/', '', $schemaRef)) : null;

        // X-Pages header
        $xPages = isset($resp200['headers']['X-Pages']);

        // Determine response type
        $schema = $schemaName ? ($schemas[$schemaName] ?? []) : [];
        $schemaType = $schema['type'] ?? 'void';
        $responseType = 'void';
        $dtoClass = null;
        $phpDocReturn = 'EsiResult<null>';
        $primitiveType = null;
        $primitivePhp = null;

        if ($schemaName) {
            if ($schemaType === 'object') {
                $responseType = 'object';
                $dtoClass = $schemaName;
                $phpDocReturn = $schemaName;  // returns DTO directly, no EsiResult wrapper
            } elseif ($schemaType === 'array') {
                $items = $schema['items'] ?? [];
                if (isset($items['$ref'])) {
                    // array<OtherSchema>
                    $itemClass = resolveRef($items['$ref'], $commonModelTypes);
                    $responseType = 'array_ref';
                    $dtoClass = $itemClass;
                    $phpDocReturn = "EsiResult<array<{$itemClass}>>";
                } elseif (($items['type'] ?? '') === 'object') {
                    // array<inline-object> → use SchemaNameItem DTO
                    $responseType = 'array_item';
                    $dtoClass = $schemaName.'Item';
                    $phpDocReturn = "EsiResult<array<{$schemaName}Item>>";
                } else {
                    // array<primitive>
                    $primitiveType = oas3TypeToPhp($items);
                    $responseType = 'array_primitive';
                    $dtoClass = null;
                    $phpDocReturn = "EsiResult<array<{$primitiveType}>>";
                }
            } elseif ($schemaType !== 'void') {
                // primitive (e.g. wallet balance → float)
                $responseType = 'primitive';
                $primitivePhp = oas3TypeToPhp($schema);
                $dtoClass = null;
                $phpDocReturn = "EsiResult<{$primitivePhp}>";
            }
        }

        $tagOps[$tag][] = [
            'path' => $path,
            'httpMethod' => $httpMethod,
            'methodName' => $methodName,
            'params' => $params,
            'requestBody' => $requestBody,
            'isAuth' => $isAuth,
            'scopes' => $scopes,
            'schemaName' => $schemaName,
            'responseType' => $responseType,
            'dtoClass' => $dtoClass,
            'phpDocReturn' => $phpDocReturn,
            'xPages' => $xPages,
            'primitiveType' => $primitiveType ?? ($primitivePhp ?? null),
            '_commonModelTypes' => $commonModelTypes,
        ];
    }
}

// ---------------------------------------------------------------------------
// Build method signature
// ---------------------------------------------------------------------------

function buildMethodSig(array $op): string
{
    $args = [];

    // Sort: required path, required query/body, optional last
    usort($op['params'], function ($a, $b) {
        $aReq = $a['required'] ?? false;
        $bReq = $b['required'] ?? false;

        return $bReq <=> $aReq;
    });

    foreach ($op['params'] as $param) {
        $name = lcfirst(str_replace('_', '', ucwords($param['name'], '_')));
        $paramSchema = $param['schema'] ?? $param;
        // Resolve $ref in param schema (e.g., CharacterID → int)
        if (isset($paramSchema['$ref'])) {
            $phpType = resolveRef($paramSchema['$ref'], $op['_commonModelTypes'] ?? []);
            if (! in_array($phpType, ['int', 'float', 'string', 'bool', 'array'], true)) {
                $phpType = 'mixed'; // unexpected object ref in param — use mixed
            }
        } else {
            $phpType = oas3TypeToPhp($paramSchema);
        }
        $required = $param['required'] ?? false;

        if ($name === 'page') {
            $args[] = 'int $page = 1';
        } elseif ($required) {
            $args[] = "{$phpType} \${$name}";
        } else {
            $args[] = "?{$phpType} \${$name} = null";
        }
    }

    // requestBody
    if ($op['requestBody']) {
        $args = array_merge(['mixed $requestBody'], $args);
    }

    return implode(', ', $args);
}

// ---------------------------------------------------------------------------
// Build return statement
// ---------------------------------------------------------------------------

function buildInvoke(array $op): string
{
    $path = $op['path'];
    $method = $op['httpMethod'];

    $uriData = [];
    $queryData = [];

    foreach ($op['params'] as $param) {
        $name = lcfirst(str_replace('_', '', ucwords($param['name'], '_')));
        if (($param['in'] ?? '') === 'path') {
            $uriData[] = "'{$param['name']}' => \${$name}";
        } elseif (($param['in'] ?? '') === 'query') {
            $queryData[] = "'{$param['name']}' => \${$name}";
        }
    }

    $uriStr = empty($uriData) ? '[]' : '['.implode(', ', $uriData).']';
    $queryStr = empty($queryData) ? '[]' : '['.implode(', ', $queryData).']';
    $bodyStr = $op['requestBody'] ? '(array) $requestBody' : '[]';

    if ($op['requestBody'] || $method !== 'get') {
        return "\$this->client->invoke('{$method}', '{$path}', {$uriStr}, 'latest', {$queryStr}, {$bodyStr})";
    }

    return "\$this->client->invoke('{$method}', '{$path}', {$uriStr}, 'latest', {$queryStr})";
}

function buildReturn(array $op): string
{
    $invoke = buildInvoke($op);
    $type = $op['responseType'];
    $dto = $op['dtoClass'];
    $primT = $op['primitiveType'] ?? 'int';

    return match ($type) {
        'object' => <<<PHP
                \$response = {$invoke};
                \$dto = {$dto}::from(\$response->data);
                \$dto->isCachedLoad = \$response->isCachedLoad();
                \$dto->pages = \$response->pages ?? 1;
                return \$dto;
        PHP,

        'array_item' => <<<PHP
                \$response = {$invoke};
                return EsiResult::fromResponse(\$response, array_map(
                    fn(object \$item) => {$dto}::from(\$item),
                    (array) \$response->data,
                ));
        PHP,

        'array_ref' => <<<PHP
                \$response = {$invoke};
                return EsiResult::fromResponse(\$response, array_map(
                    fn(object \$item) => {$dto}::from(\$item),
                    (array) \$response->data,
                ));
        PHP,

        'array_primitive' => <<<PHP
                \$response = {$invoke};
                /** @var array<{$primT}> \$data */
                \$data = array_map(fn(mixed \$i) => ({$primT}) \$i, (array) \$response->data);
                return EsiResult::fromResponse(\$response, \$data);
        PHP,

        'primitive' => <<<PHP
                \$response = {$invoke};
                /** @var {$primT} \$scalar */
                \$scalar = json_decode(\$response->raw);
                return EsiResult::fromResponse(\$response, \$scalar);
        PHP,

        default => <<<PHP
                \$response = {$invoke};
                return EsiResult::fromResponse(\$response, null);
        PHP,
    };
}

// ---------------------------------------------------------------------------
// Generate resource file
// ---------------------------------------------------------------------------

function generateResourceFile(string $tag, array $ops, array $schemas, array $commonModelTypes): string
{
    $resourceClass = tagToResourceClass($tag);
    $compatDate = ESI_COMPATIBILITY_DATE;

    $useStatements = [];
    $methods = [];

    foreach ($ops as $op) {
        $sig = buildMethodSig($op);
        $body = buildReturn($op);
        $doc = "     * @return {$op['phpDocReturn']}";
        $auth = $op['isAuth'] ? "\n     * @scope ".implode(', ', $op['scopes']) : '';
        $paged = $op['xPages'] ? "\n     * @paginated Use \$page param to iterate pages." : '';

        // use statement for the DTO — all DTOs come from seatplus/esi-schema
        if ($op['dtoClass'] && ! in_array($op['dtoClass'], ['int', 'float', 'bool', 'string'], true)) {
            $useStatements[] = "use Seatplus\\EsiSchema\\Responses\\{$op['dtoClass']};";
        }

        // Return type hint: object endpoints return DTO directly; others return EsiResult
        $returnHint = $op['responseType'] === 'object'
            ? ($op['dtoClass'] ?? 'mixed')
            : 'EsiResult';

        $methods[] = <<<PHP
            /**
        {$doc}{$auth}{$paged}
             */
            public function {$op['methodName']}({$sig}): {$returnHint}
            {
        {$body}
            }
        PHP;
    }

    $useBlock = empty($useStatements)
        ? ''
        : implode("\n", array_unique($useStatements))."\n";
    $methodsBlock = implode("\n\n", $methods);

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
// Write resource files only (DTOs come from seatplus/esi-schema)
// ---------------------------------------------------------------------------

$writtenFiles = 0;

if (! $dryRun) {
    // Resources directory
    $resourcesDir = "{$generatedDir}/Resources";
    if (! is_dir($resourcesDir)) {
        mkdir($resourcesDir, 0755, true);
    }

    // Write resource files
    foreach ($tagOps as $tag => $ops) {
        $source = generateResourceFile($tag, $ops, $schemas, $commonModelTypes);
        $class = tagToResourceClass($tag);
        $file = "{$resourcesDir}/{$class}.php";
        file_put_contents($file, $source);
        echo "  wrote: src/Generated/Resources/{$class}.php\n";
        $writtenFiles++;
    }
}

echo "\nDone. Wrote {$writtenFiles} resource files.\n";
echo 'Tags found: '.count($tagOps)."\n";
echo "Note: DTOs are sourced from seatplus/esi-schema — not generated here.\n";
