<?php declare(strict_types=1);
namespace Laque\SwahiliLocale\Locale\Contracts;
interface TerminologyInterface{
public function translate(string $key,string $from='sw_TZ',string $to='en_US'): ?string;
public function has(string $key,string $locale):bool;
}
