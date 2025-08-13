<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Laque\SwahiliLocale\Locale\Terms\Terminology;
use Laque\SwahiliLocale\Locale\Terms\PhpFileLoader;
final class TerminologyTest extends TestCase{
public function testTranslate():void{$loader=new PhpFileLoader(__DIR__.'/resources/terms');$terms=new Terminology($loader,['sw_TZ','en_US']);$this->assertSame('Full Name',$terms->translate('Jina Kamili','sw_TZ','en_US'));$this->assertSame('Namba ya Simu',$terms->translate('Phone Number','en_US','sw_TZ'));$this->assertTrue($terms->has('barua    pepe','sw_TZ'));$this->assertNull($terms->translate('Unknown Key','sw_TZ','en_US'));}
}
