<?php
require __DIR__ . '/../vendor/autoload.php';

use Laque\SwahiliLocale\Locale\Inflection\SwahiliInflector;

$infl = new SwahiliInflector(['mtumiaji'=>'watumiaji', 'akaunti'=>'akaunti']);
echo $infl->pluralizeNoun('kifurushi', 3), PHP_EOL; // vifurushi
echo $infl->pluralizeNoun('mtumiaji', 5), PHP_EOL; // watumiaji
echo $infl->pluralizeNoun('jina', 2), PHP_EOL; // majina

echo $infl->conjugateVerb('hifadhi'), PHP_EOL; // imehifadhiwa
echo $infl->conjugateVerb('tuma'), PHP_EOL;     // imetumwa
echo $infl->conjugateVerb('shindwa', 'past'), PHP_EOL; // ilishindwa
