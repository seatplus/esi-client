<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;

return RectorConfig::configure()
    ->withSets([
        SetList::PHP_85,
    ])
    ->withPaths([
        __DIR__.'/src',
        __DIR__.'/tests',
        __DIR__.'/bin',
    ]);
// uncomment to reach your current PHP version
// ->withPhpSets()
