<?php
require __DIR__ . '/../vendor/autoload.php';

use Laque\SwahiliLocale\Locale\DateNumber\IntlDateNumberFormatter;
use Laque\SwahiliLocale\Locale\DateNumber\FallbackDateNumberFormatter;

$fmt = class_exists(\NumberFormatter::class) ? new IntlDateNumberFormatter('sw_TZ') : new FallbackDateNumberFormatter('sw_TZ');

$dt = new DateTimeImmutable('2025-08-13 14:05:00');
echo $fmt->formatDate($dt, 'long', 'Africa/Dar_es_Salaam'), PHP_EOL;
echo $fmt->formatTime($dt, 'short', 'Africa/Dar_es_Salaam'), PHP_EOL;
echo $fmt->formatDateTime($dt, 'long', 'short', 'Africa/Dar_es_Salaam'), PHP_EOL;
echo $fmt->formatCurrency(1250000, 'TZS'), PHP_EOL;
echo $fmt->formatNumber(12345.678, 1), PHP_EOL;
