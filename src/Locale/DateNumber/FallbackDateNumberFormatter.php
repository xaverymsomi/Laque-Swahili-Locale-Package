<?php
declare(strict_types=1);

namespace Laque\SwahiliLocale\Locale\DateNumber;

use Laque\SwahiliLocale\Locale\Contracts\DateNumberFormatterInterface;

final class FallbackDateNumberFormatter implements DateNumberFormatterInterface
{
    public function __construct(private string $locale = 'sw_TZ') {}

    public function formatDate(\DateTimeInterface $dt, string $style = 'medium', ?string $tz = null): string
    {
        $d = $this->withTz($dt, $tz);
        return match ($style) {
            'full'   => $this->weekday($d) . ', ' . $d->format('j') . ' ' . $this->month($d) . ' ' . $d->format('Y'),
            'long'   => $d->format('j') . ' ' . $this->month($d) . ' ' . $d->format('Y'),
            'short'  => $d->format('Y-m-d'),
            default  => $d->format('j') . ' ' . $this->monthShort($d) . ' ' . $d->format('Y'),
        };
    }

    public function formatTime(\DateTimeInterface $dt, string $style = 'short', ?string $tz = null): string
    {
        $d = $this->withTz($dt, $tz);
        return match ($style) {
            'full', 'long' => $d->format('H:i:s'),
            default        => $d->format('H:i'),
        };
    }

    public function formatDateTime(\DateTimeInterface $dt, string $dateStyle = 'medium', string $timeStyle = 'short', ?string $tz = null): string
    {
        return $this->formatDate($dt, $dateStyle, $tz) . ' ' . $this->formatTime($dt, $timeStyle, $tz);
    }

    public function formatNumber(float|int $n, int $precision = 2): string
    {
        // Tanzania typically uses dot as decimal and comma as thousands in many systems.
        return number_format((float) $n, $precision, '.', ',');
    }

    public function formatCurrency(float|int $amount, string $currency = 'TZS'): string
    {
        return $currency . ' ' . $this->formatNumber($amount, 0);
    }

    private function withTz(\DateTimeInterface $dt, ?string $tz): \DateTimeInterface
    {
        if (!$tz) return $dt;
        $tzObj = new \DateTimeZone($tz);
        return (new \DateTimeImmutable('@' . $dt->getTimestamp()))->setTimezone($tzObj);
    }

    private function month(\DateTimeInterface $dt): string
    {
        static $months = [
            1=>'Januari',2=>'Februari',3=>'Machi',4=>'Aprili',5=>'Mei',6=>'Juni',
            7=>'Julai',8=>'Agosti',9=>'Septemba',10=>'Oktoba',11=>'Novemba',12=>'Desemba'
        ];
        return $months[(int)$dt->format('n')] ?? $dt->format('F');
    }

    private function monthShort(\DateTimeInterface $dt): string
    {
        static $months = [
            1=>'Jan',2=>'Feb',3=>'Mac',4=>'Apr',5=>'Mei',6=>'Jun',
            7=>'Jul',8=>'Ago',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des'
        ];
        return $months[(int)$dt->format('n')] ?? $dt->format('M');
    }

    private function weekday(\DateTimeInterface $dt): string
    {
        static $days = [
            0=>'Jumapili',1=>'Jumatatu',2=>'Jumanne',3=>'Jumatano',4=>'Alhamisi',5=>'Ijumaa',6=>'Jumamosi'
        ];
        return $days[(int)$dt->format('w')] ?? $dt->format('l');
    }
}
