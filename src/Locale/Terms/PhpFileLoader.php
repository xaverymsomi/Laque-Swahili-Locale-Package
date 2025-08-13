<?php declare(strict_types=1);
namespace Laque\SwahiliLocale\Locale\Terms;
final class PhpFileLoader implements LoaderInterface{
public function __construct(private string $basePath){}
public function load(string $locale):array{$file=rtrim($this->basePath,'/\\').DIRECTORY_SEPARATOR.$locale.'.php';if(!is_file($file))return[];$arr=include $file;return is_array($arr)?$arr:[];}
}
