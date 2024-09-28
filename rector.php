<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withSets([
        \Rector\Set\ValueObject\SetList::PHP_83,
        //\Rector\Set\ValueObject\LevelSetList::UP_TO_PHP_83,
    ])
    ->withPaths([
        __DIR__.'/src',
        __DIR__.'/tests',
        __DIR__.'/tools',
    ]);
// uncomment to reach your current PHP version
// ->withPhpSets()
