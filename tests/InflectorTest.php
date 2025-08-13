<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Laque\SwahiliLocale\Locale\Inflection\SwahiliInflector;
final class InflectorTest extends TestCase{
public function testPluralize():void{$inf=new SwahiliInflector(['mtumiaji'=>'watumiaji']);$this->assertSame('watumiaji',$inf->pluralizeNoun('mtumiaji',2));$this->assertSame('vifurushi',$inf->pluralizeNoun('kifurushi',3));$this->assertSame('majina',$inf->pluralizeNoun('jina',2));$this->assertSame('taarifa',$inf->pluralizeNoun('taarifa',5));}
public function testConjugate():void{$inf=new SwahiliInflector();$this->assertSame('imehifadhiwa',$inf->conjugateVerb('hifadhi'));$this->assertSame('imetumwa',$inf->conjugateVerb('tuma'));$this->assertSame('ilishindwa',$inf->conjugateVerb('shindwa','past'));$this->assertSame('itahifadhiwa',$inf->conjugateVerb('hifadhi','future'));}
}
