# Laravel Passes

[![Latest Version on Packagist](https://img.shields.io/packagist/v/chiiya/laravel-passes.svg?style=flat-square)](https://packagist.org/packages/chiiya/laravel-passes)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/chiiya/laravel-passes/lint?label=code%20style)](https://github.com/chiiya/laravel-passes/actions?query=workflow%3Alint+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/chiiya/laravel-passes.svg?style=flat-square)](https://packagist.org/packages/chiiya/laravel-passes)

Laravel package for creating iOS and Android Wallet Passes.

## Installation

You can install the package via composer:

```bash
composer require chiiya/laravel-passes
```

Publish the configuration files with:

```bash
php artisan vendor:publish --tag="passes-config"
```

## Usage

This package is a thin wrapper around [chiiya/passes](https://github.com/chiiya/passes), that allows you to directly
inject the Google repositories or Apple `PassFactory` in your application:

```php
public function __construct(
    private OfferClassRepository $offers,
    private PassFactory $apple,
)

public function handle(): void
{
    $this->apple->create(...);
    $this->offers->get(...);
}
```

You may also use the `PassBuilder` class, which is an entry point to all pass building functionalities and contains
a helper method for creating a signed Google JWT:

```php
use Chiiya\LaravelPasses\PassBuilder;

public function __construct(
    private PassBuilder $builder,
)

public function handle(): void
{
    $this->builder->apple()->create(...);
    $this->builder->google()->offerClasses()->create(...);
    $this->builder->google()->createJWT()->addOfferObject(...)->sign();
}
```

For documentation on method signatures, check out [chiiya/passes](https://github.com/chiiya/passes).

## Testing

Since this package uses the Laravel HTTP Client under the hood to perform API requests,
you may simply call `Http::fake()` to fake responses in your tests. For mocking specific responses,
check out the [example responses](https://github.com/chiiya/passes/tree/master/tests/Google/Fixtures/responses).

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
