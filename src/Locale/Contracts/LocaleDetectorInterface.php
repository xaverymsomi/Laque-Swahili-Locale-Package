<?php declare(strict_types=1);
namespace Laque\SwahiliLocale\Locale\Contracts;
interface LocaleDetectorInterface{
/** @param array<string,mixed> $hints */
public function detect(array $hints=[]):string; // returns 'sw_TZ', etc.
}
