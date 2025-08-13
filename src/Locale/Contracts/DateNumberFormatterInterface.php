<?php declare(strict_types=1);
namespace Laque\SwahiliLocale\Locale\Contracts;
interface DateNumberFormatterInterface{
public function formatDate(\DateTimeInterface $dt,string $style='medium',?string $tz=null):string;
public function formatTime(\DateTimeInterface $dt,string $style='short',?string $tz=null):string;
public function formatDateTime(\DateTimeInterface $dt,string $dateStyle='medium',string $timeStyle='short',?string $tz=null):string;
public function formatNumber(float|int $n,int $precision=2):string;
public function formatCurrency(float|int $amount,string $currency='TZS'):string;
}
