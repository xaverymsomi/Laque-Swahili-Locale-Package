<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Laque\SwahiliLocale\Support\SimpleLocaleDetector;
final class LocaleDetectorTest extends TestCase{
public function testDetect():void{$detector=new SimpleLocaleDetector(['sw_TZ','en_US'],'sw_TZ');$this->assertSame('sw_TZ',$detector->detect(['lang'=>'sw']));$this->assertSame('en_US',$detector->detect(['accept_language'=>'en-US,en;q=0.8,sw;q=0.6']));$this->assertSame('sw_TZ',$detector->detect([]));}
}
