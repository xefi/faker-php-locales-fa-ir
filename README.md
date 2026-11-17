# Faker PHP — fa_IR locale

Persian (Iran) (`fa_IR`) locale for [Faker PHP](https://github.com/xefi/faker-php).

## Installation

```bash
composer require --dev xefi/faker-php-locales-fa-ir
```

The service provider is discovered automatically through Composer.

## Usage

```php
use Xefi\Faker\Faker;

$faker = new Faker('fa_IR');
```

Generators without a `fa_IR` variant fall back to the default locale.

## What's included

- Names in Persian script: `name()`, `firstName()`, `lastName()`, `title()`.
- Personal identifier: `codeMelli()` (کد ملی, 10 digits with check digit).
- Company identifier: `shenaseMelli()` (شناسه ملی, 11 digits with check digit).
- Addresses: `province()` (31 ostans), `city()`, 10-digit `postcode()`, `streetName()`, `streetAddress()` and `fullAddress()`.
- Phone numbers with the `0` trunk prefix or the `+98` indicator.
- `iban()`: `IR` IBAN (شبا) with a valid checksum.
- Colours and text in Persian. Generated identifiers, postcodes and numbers use ASCII digits.

## Contributing

1. Fork the repository and create a branch from `main`.
2. Add an extension under `src/Extensions/` and register it in `FakerFaIrServiceProvider::boot()`.
3. Add a test under `tests/Unit/`.
4. Run the suite with `vendor/bin/phpunit` (or `docker compose run php vendor/bin/phpunit`).
5. Open a pull request against `main`.

## License

MIT
