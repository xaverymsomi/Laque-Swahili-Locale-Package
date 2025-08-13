<?php declare(strict_types=1);
namespace Laque\SwahiliLocale\Locale\Terms;
use Laque\SwahiliLocale\Locale\Contracts\TerminologyInterface;
final class Terminology implements TerminologyInterface{
private array $dict=[];
public function __construct(private LoaderInterface $loader,array $locales=['sw_TZ','en_US']){foreach($locales as $loc){$this->dict[$loc]=$loader->load($loc);}foreach($this->dict as $loc=>$map){$norm=[];foreach($map as $k=>$v){$norm[$this->normalizeKey($k)]=$v;}$this->dict[$loc]=$norm;}}
public function translate(string $key,string $from='sw_TZ',string $to='en_US'): ?string{$k=$this->normalizeKey($key);$src=$this->dict[$from]??[];return $src[$k]??null;}
public function has(string $key,string $locale):bool{$k=$this->normalizeKey($key);return isset(($this->dict[$locale]??[])[$k]);}
private function normalizeKey(string $s):string{$s=mb_strtolower($s);$s=preg_replace('/\s+/u',' ',trim($s))??$s;return $s;}
}
