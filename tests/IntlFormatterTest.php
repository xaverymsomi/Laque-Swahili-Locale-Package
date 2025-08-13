<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Laque\SwahiliLocale\Locale\DateNumber\IntlDateNumberFormatter;
use Laque\SwahiliLocale\Locale\DateNumber\FallbackDateNumberFormatter;
final class IntlFormatterTest extends TestCase{
public function testFormatters():void{$dt=new DateTimeImmutable('2025-08-13 10:00:00');if(class_exists(NumberFormatter::class)&&class_exists(IntlDateFormatter::class)){$fmt=new IntlDateNumberFormatter('sw_TZ');$s=$fmt->formatDateTime($dt,'long','short','Africa/Dar_es_Salaam');$this->assertNotSame('',$s);}else{$fmt=new FallbackDateNumberFormatter('sw_TZ');$s=$fmt->formatDateTime($dt,'long','short','Africa/Dar_es_Salaam');$this->assertNotSame('',$s);}}
}
