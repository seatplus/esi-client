# Esi-Client

[![Latest Version on Packagist](https://img.shields.io/packagist/v/seatplus/esi-client.svg?style=flat-square)](https://packagist.org/packages/seatplus/esi-client)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/seatplus/esi-client/run-tests?label=tests)](https://github.com/seatplus/esi-client/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/seatplus/esi-client/Check%20&%20fix%20styling?label=code%20style)](https://github.com/seatplus/esi-client/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/seatplus/esi-client.svg?style=flat-square)](https://packagist.org/packages/seatplus/esi-client)

A standalone ESI (Eve Swagger Interface) Client Library using kevinrob/guzzle-cache-middleware.

## Installation

You can install the package via composer:

```bash
composer require seatplus/esi-client
```


## Usage

```php
$esi = new Seatplus\EsiClient\EsiClient();

$esi->setVersion('v5'); // if you do not set a version, esi-client is using '/latest'

// make a call
$character_info = $esi->invoke('get', '/characters/{character_id}/', [
    'character_id' => 95725047,
]);

echo $character_info;
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

As of today this esi client only supports Laravel Cache Middleware. However [`Kevinrob/guzzle-cache-middleware`](https://github.com/Kevinrob/guzzle-cache-middleware) supports various others such as:
* Doctrine cache 
* Laravel cache 
* Flysystem 
* PSR6 
* WordPress Object Cache

if you plan to use this client with any of these a proper CacheMiddleware would be needed.
Same goes to the HTTP client. This client and its cache middleware had been designed to use with Guzzle7 (but you can use it with any PSR-7 HTTP client). Please submit your PR accordingly implementing other HTTP clients.

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Felix Huber](https://github.com/seatplus)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
