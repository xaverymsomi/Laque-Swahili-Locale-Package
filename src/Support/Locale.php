<?php declare(strict_types=1);
namespace Laque\SwahiliLocale\Support;
final class Locale{
/** @return string[] */public static function parseAcceptLanguage(string $header):array{$parts=array_map('trim',explode(',',$header));$scored=[];foreach($parts as $p){if($p==='')continue;$q=1.0;if(str_contains($p,';q=')){$tmp=explode(';q=',$p,2);$p=$tmp[0];$q=(float)$tmp[1];}$scored[]=['loc'=>str_replace('-','_',$p),'q'=>$q];}usort($scored,fn($a,$b)=>$b['q']<=>$a['q']);return array_values(array_unique(array_map(fn($x)=>$x['loc'],$scored)));}
/** @param string[] $supported */public static function negotiate(array $candidates,array $supported,string $default):string{foreach($candidates as $c){foreach($supported as $s){if(strcasecmp($c,$s)===0)return $s;if(strtolower(substr($c,0,2))===strtolower(substr($s,0,2)))return $s;}}return $default;}
}
