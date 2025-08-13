<?php declare(strict_types=1);
namespace Laque\SwahiliLocale\Support;
use Laque\SwahiliLocale\Locale\Contracts\LocaleDetectorInterface;
final class SimpleLocaleDetector implements LocaleDetectorInterface{
public function __construct(private array $supported=['sw_TZ','en_US'],private string $default='sw_TZ'){}
public function detect(array $hints=[]):string{$explicit=$hints['lang']??$hints['locale']??null;if(is_string($explicit)){return Locale::negotiate([str_replace('-','_',$explicit)],$this->supported,$this->default);}if(isset($hints['accept_language'])&&is_string($hints['accept_language'])){$candidates=Locale::parseAcceptLanguage($hints['accept_language']);return Locale::negotiate($candidates,$this->supported,$this->default);}return $this->default;}
}
