<?php
require __DIR__ . '/../vendor/autoload.php';

use Laque\SwahiliLocale\Locale\Terms\Terminology;
use Laque\SwahiliLocale\Locale\Terms\PhpFileLoader;

$terms = new Terminology(new PhpFileLoader(__DIR__ . '/../resources/terms'));
echo $terms->translate('Jina Kamili', 'sw_TZ', 'en_US'), PHP_EOL;
echo $terms->translate('Phone Number', 'en_US', 'sw_TZ'), PHP_EOL;
echo ($terms->has('barua    pepe', 'sw_TZ') ? 'yes' : 'no'), PHP_EOL;
