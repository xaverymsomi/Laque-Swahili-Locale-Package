<?php declare(strict_types=1);
namespace Laque\SwahiliLocale\Locale\Contracts;
interface InflectorInterface{
public function pluralizeNoun(string $noun,int $count=2):string;
public function conjugateVerb(string $verb,string $tense='present',string $person='impersonal',string $nounClass='default'):string;
}
