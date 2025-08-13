<?php declare(strict_types=1);
namespace Laque\SwahiliLocale\Locale\DateNumber;
use Laque\SwahiliLocale\Locale\Contracts\DateNumberFormatterInterface;
final class IntlDateNumberFormatter implements DateNumberFormatterInterface{
public function __construct(private string $locale='sw_TZ'){}
private function style(string $s):int{return match($s){'full'=>\IntlDateFormatter::FULL,'long'=>\IntlDateFormatter::LONG,'short'=>\IntlDateFormatter::SHORT,default=>\IntlDateFormatter::MEDIUM};}
public function formatDate(\DateTimeInterface $dt,string $style='medium',?string $tz=null):string{$fmt=new \IntlDateFormatter($this->locale,$this->style($style),\IntlDateFormatter::NONE,$tz);return (string)$fmt->format($dt);}
public function formatTime(\DateTimeInterface $dt,string $style='short',?string $tz=null):string{$fmt=new \IntlDateFormatter($this->locale,\IntlDateFormatter::NONE,$this->style($style),$tz);return (string)$fmt->format($dt);}
public function formatDateTime(\DateTimeInterface $dt,string $dateStyle='medium',string $timeStyle='short',?string $tz=null):string{$fmt=new \IntlDateFormatter($this->locale,$this->style($dateStyle),$this->style($timeStyle),$tz);return (string)$fmt->format($dt);}
public function formatNumber(float|int $n,int $precision=2):string{$fmt=new \NumberFormatter($this->locale,\NumberFormatter::DECIMAL);$fmt->setAttribute(\NumberFormatter::FRACTION_DIGITS,$precision);return (string)$fmt->format($n);}
public function formatCurrency(float|int $amount,string $currency='TZS'):string{$fmt=new \NumberFormatter($this->locale,\NumberFormatter::CURRENCY);return (string)$fmt->formatCurrency((float)$amount,$currency);}
}
