#!/usr/bin/env php
<?php
require __DIR__ . '/../vendor/autoload.php';

use Laque\SwahiliLocale\Locale\DateNumber\IntlDateNumberFormatter;
use Laque\SwahiliLocale\Locale\DateNumber\FallbackDateNumberFormatter;
use Laque\SwahiliLocale\Locale\Inflection\SwahiliInflector;
use Laque\SwahiliLocale\Locale\Terms\Terminology;
use Laque\SwahiliLocale\Locale\Terms\PhpFileLoader;

echo "== Date & Number ==\n";
$fmt = class_exists(\NumberFormatter::class) ? new IntlDateNumberFormatter('sw_TZ') : new FallbackDateNumberFormatter('sw_TZ');
echo $fmt->formatDateTime(new DateTimeImmutable('2025-08-13 14:05:00'), 'long', 'short', 'Africa/Dar_es_Salaam'), PHP_EOL;
echo $fmt->formatCurrency(1250000, 'TZS'), PHP_EOL;

echo "\n== Inflection ==\n";
$infl = new SwahiliInflector(['mtumiaji'=>'watumiaji', 'akaunti'=>'akaunti']);
echo $infl->pluralizeNoun('kifurushi', 3), PHP_EOL;
echo $infl->conjugateVerb('hifadhi'), PHP_EOL;

echo "\n== Terminology ==\n";
$terms = new Terminology(new PhpFileLoader(__DIR__ . '/../resources/terms'));
echo "sw->en: ", $terms->translate('Jina Kamili', 'sw_TZ', 'en_US'), PHP_EOL;
echo "en->sw: ", $terms->translate('Phone Number', 'en_US', 'sw_TZ'), PHP_EOL;

echo "\nOK\n";
