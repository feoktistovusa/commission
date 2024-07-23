<?php

use PHPUnit\Framework\TestCase;
use Services\ExchangeRateService;

class ExchangeRateServiceTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testGetRate()
    {
        $service = $this->createMock(ExchangeRateService::class);
        $service->method('getRate')->willReturn(0.85);

        $this->assertEquals(0.85, $service->getRate('USD'));
    }
}
