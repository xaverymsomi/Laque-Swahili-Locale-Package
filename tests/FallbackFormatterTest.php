<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Laque\SwahiliLocale\Locale\DateNumber\FallbackDateNumberFormatter;

final class FallbackFormatterTest extends TestCase
{
    public function testDateMonthAndWeekdayAreSwahili(): void
    {
        $dt = new DateTimeImmutable('2025-08-13 10:00:00');
        $fmt = new FallbackDateNumberFormatter('sw_TZ');

        $full = $fmt->formatDate($dt, 'full', 'Africa/Dar_es_Salaam');
        $this->assertStringContainsString('Jumatano', $full);
        $this->assertStringContainsString('Agosti', $full);

        $long = $fmt->formatDate($dt, 'long', 'Africa/Dar_es_Salaam');
        $this->assertStringContainsString('Agosti', $long);
    }

    public function testNumberAndCurrencyFallbacks(): void
    {
        $fmt = new FallbackDateNumberFormatter('sw_TZ');
        $this->assertSame('12,345.7', $fmt->formatNumber(12345.678, 1));
        $this->assertSame('TZS 1,250,000', $fmt->formatCurrency(1250000, 'TZS'));
    }
}
