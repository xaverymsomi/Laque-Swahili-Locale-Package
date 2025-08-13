<?php declare(strict_types=1);
namespace Laque\SwahiliLocale\Locale\Terms;
final class ArrayLoader implements LoaderInterface{
public function __construct(private array $data){}
public function load(string $locale):array{return $this->data[$locale]??[];}
}
