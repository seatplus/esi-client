<?php

use Seatplus\EsiClient\Exceptions\EsiClientException;

it('marks every exception in the package as an EsiClientException', function () {
    $classes = array_map(
        fn (string $file): string => 'Seatplus\\EsiClient\\Exceptions\\'.basename($file, '.php'),
        glob(__DIR__.'/../../../src/Exceptions/*.php') ?: []
    );

    expect($classes)->not->toBeEmpty();

    foreach ($classes as $class) {
        $reflection = new ReflectionClass($class);

        // The marker interface itself is in the same directory.
        if ($reflection->isInterface()) {
            continue;
        }

        expect($reflection->implementsInterface(EsiClientException::class))
            ->toBeTrue("{$class} must implement ".EsiClientException::class);
    }
});
