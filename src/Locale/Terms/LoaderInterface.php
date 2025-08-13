<?php declare(strict_types=1);
namespace Laque\SwahiliLocale\Locale\Terms;
interface LoaderInterface{/** @return array<string,string> */public function load(string $locale):array;}
