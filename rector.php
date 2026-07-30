<?php

declare(strict_types=1);

use Pest\Rector\Set\PestSetList;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;

return RectorConfig::configure()
    ->withSets([
        SetList::PHP_85,
        PestSetList::CODING_STYLE,
    ])
    ->withPaths([
        __DIR__.'/src',
        __DIR__.'/tests',
    ]);
// uncomment to reach your current PHP version
// ->withPhpSets()
