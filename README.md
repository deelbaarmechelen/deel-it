# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/deelbaarmechelen/deel-it.svg?style=flat-square)](https://packagist.org/packages/deelbaarmechelen/deel-it)
[![Build Status](https://img.shields.io/travis/deelbaarmechelen/deel-it/master.svg?style=flat-square)](https://travis-ci.org/deelbaarmechelen/deel-it)
[![Quality Score](https://img.shields.io/scrutinizer/g/deelbaarmechelen/deel-it.svg?style=flat-square)](https://scrutinizer-ci.com/g/deelbaarmechelen/deel-it)
[![Total Downloads](https://img.shields.io/packagist/dt/deelbaarmechelen/deel-it.svg?style=flat-square)](https://packagist.org/packages/deelbaarmechelen/deel-it)

This package is intended to complement the [Snipe IT application](https://github.com/snipe/snipe-it) for use in a 'Deel-IT' project  
It auto-generates an asset tag when needed and keeps track of last used sequence number 

## Installation

You can install the package via composer:

``` bash
composer require deelbaarmechelen/deel-it
```

Next export and run the database migrations
``` bash
php artisan vendor:publish --provider="Deelbaarmechelen\DeelIt\DeelItServiceProvider" --tag="migrations"
```

## Usage

``` php
// Usage description here
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email bernard@deelbaarmechelen.be instead of using the issue tracker.

## License

The GNU GPLv3. Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).