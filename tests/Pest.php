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


use Firebase\JWT\JWT;
use PHPUnit\Framework\TestCase;

uses(TestCase::class)
    ->group('integration')
    ->in('Integration');

uses(TestCase::class)
    ->group('unit')
    ->in('Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

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

function getFaker()
{
    return \Faker\Factory::create();
}

function buildEsiAuthentication(array $params = [])
{
    $faker = getFaker();

    $factory_array = [
        'client_id' => $faker->randomNumber,
        'secret' => $faker->md5,
        'access_token' => buildJWT(json_encode([
            'scp' => [],
        ])),
        'refresh_token' => $faker->sha1,
    ];

    foreach ($params as $key => $value) {
        $factory_array[$key] = $key === 'access_token' ? buildJWT($value) : $value;
    }

    return new \Seatplus\EsiClient\DataTransferObjects\EsiAuthentication(
        access_token: $factory_array['access_token'],
        refresh_token: $factory_array['refresh_token'],
        client_id: $factory_array['client_id'],
        secret: $factory_array['secret'],
    );
}

function buildJWT(string $payload): string
{
    $jwt_header = json_encode([
        "alg" => "RS256",
        "kid" => "JWT-Signature-Key",
        "typ" => "JWT",
    ]);

    $data = JWT::urlsafeB64Encode($jwt_header) . "." . JWT::urlsafeB64Encode($payload);

    $signature = hash_hmac(
        'sha256',
        $data,
        'test'
    );

    return "${data}.${signature}";
}
