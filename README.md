# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/zoparga/simplepay-laravel.svg?style=flat-square)](https://packagist.org/packages/zoparga/simplepay-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/zoparga/simplepay-laravel.svg?style=flat-square)](https://packagist.org/packages/zoparga/simplepay-laravel)
![GitHub Actions](https://github.com/zoparga/simplepay-laravel/actions/workflows/main.yml/badge.svg)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require zoparga/simplepay-laravel
```
Publish config file

```php artisan vendor:publish --provider="zoparga\SimplePayLaravel\SimplepayLaravelServiceProvider" --tag="config"```

## Usage

```php
// Usage description here
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email zoltan@pappz.hu instead of using the issue tracker.

## Credits

-   [Zoltán Papp](https://github.com/zoparga)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
