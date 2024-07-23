<?php

use PHPUnit\Framework\TestCase;
use Services\BinLookupService;
use Services\ExchangeRateService;

class CommissionCalculatorTest extends TestCase
{
    public function testCalculate()
    {
        $binLookupService = $this->createMock(BinLookupService::class);
        $binLookupService->method('getCountryCode')->willReturn('DE');

        $exchangeRateService = $this->createMock(ExchangeRateService::class);
        $exchangeRateService->method('getRate')->willReturn(0.85);

        $calculator = new CommissionCalculator($binLookupService, $exchangeRateService);

        $this->assertEquals(1.18, $calculator->calculate('45717360', 100, 'USD'));
    }
}
