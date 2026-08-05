<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

use Faker\Factory;
use Faker\Generator;
use Firebase\JWT\JWT;
use PHPUnit\Framework\TestCase;
use Seatplus\EsiClient\DataTransferObjects\EsiAuthentication;

uses(TestCase::class)
    ->group('integration')
    ->in('Integration');

uses(TestCase::class)
    ->group('unit')
    ->in('Unit');

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function getFaker(): Generator
{
    return Factory::create();
}

function buildEsiAuthentication(array $params = []): EsiAuthentication
{
    $faker = getFaker();

    $factoryArray = [
        'clientId' => $faker->randomNumber(),
        'secret' => $faker->md5(),
        'accessToken' => buildJWT(json_encode([
            'scp' => [],
        ])),
        'refreshToken' => $faker->sha1(),
    ];

    foreach ($params as $key => $value) {
        $factoryArray[$key] = $key === 'accessToken' ? buildJWT($value) : $value;
    }

    return new EsiAuthentication(
        accessToken: $factoryArray['accessToken'],
        refreshToken: $factoryArray['refreshToken'],
        clientId: $factoryArray['clientId'],
        secret: $factoryArray['secret'],
    );
}

function buildJWT(string $payload): string
{
    $jwtHeader = json_encode([
        'alg' => 'RS256',
        'kid' => 'JWT-Signature-Key',
        'typ' => 'JWT',
    ]);

    $data = JWT::urlsafeB64Encode($jwtHeader).'.'.JWT::urlsafeB64Encode($payload);

    $signature = hash_hmac(
        'sha256',
        $data,
        'test'
    );

    return "{$data}.{$signature}";
}
