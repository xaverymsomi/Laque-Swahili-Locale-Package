# vicent/laque-swahil-locale
[![codecov](https://codecov.io/gh/vicent-dev/laque-swahil-locale/branch/main/graph/badge.svg)](https://codecov.io/gh/vicent-dev/laque-swahil-locale)
[![Latest Stable Version](https://img.shields.io/packagist/v/vicent/laque-swahil-locale.svg)](https://packagist.org/packages/vicent/laque-swahil-locale)
[![Total Downloads](https://img.shields.io/packagist/dt/vicent/laque-swahil-locale.svg)](https://packagist.org/packages/vicent/laque-swahil-locale)



<p align="center"><img src="assets/logo.svg" width="260" alt="Laque Swahili Locale logo" /></p>

Framework‑agnostic, **SOLID** PHP library for Swahili localization:
- ICU/intl date, time, number, and currency formatting (with PHP fallback)
- Lightweight Swahili inflector (noun classes + passive verbs for UX)
- Terminology dictionary (Sw ↔ En)
- Optional PSR‑15 locale negotiation middleware

**Author**: Vicent Msomi <msomivicent@gmail.com>

## Install
```bash
composer require vicent/laque-swahil-locale
```

## Quick start
```php
use Laque\SwahiliLocale\Locale\DateNumber\IntlDateNumberFormatter;
use Laque\SwahiliLocale\Locale\Inflection\SwahiliInflector;
use Laque\SwahiliLocale\Locale\Terms\Terminology;
use Laque\SwahiliLocale\Locale\Terms\PhpFileLoader;

$fmt = class_exists(\NumberFormatter::class)
  ? new IntlDateNumberFormatter('sw_TZ')
  : new Laque\SwahiliLocale\Locale\DateNumber\FallbackDateNumberFormatter('sw_TZ');

$infl = new SwahiliInflector(['mtumiaji'=>'watumiaji']);
$terms = new Terminology(new PhpFileLoader(__DIR__.'/resources/terms'));

echo $fmt->formatCurrency(1250000, 'TZS');
echo $infl->pluralizeNoun('kifurushi', 3);
echo $terms->translate('Jina Kamili', 'sw_TZ', 'en_US');
```

MIT © 2025 Vicent Msomi

## Packagist Auto-Update
- After publishing to GitHub, submit the repo to Packagist.
- In Packagist (Maintainer settings), **enable GitHub Hook** so new tags push updates automatically.
- Alternatively, create a Packagist **API token** and set up a GitHub Action to ping Packagist on tag (optional).


## Examples
Run from repo root after `composer install`:

```bash
php examples/formatting.php
php examples/inflection.php
php examples/terminology.php
php examples/middleware-demo.php
```
