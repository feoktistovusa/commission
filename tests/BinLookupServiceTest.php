<?php

use PHPUnit\Framework\TestCase;
use Services\BinLookupService;

class BinLookupServiceTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testGetCountryCode()
    {
        $service = $this->createMock(BinLookupService::class);
        $service->method('getCountryCode')->willReturn('DE');

        $this->assertEquals('DE', $service->getCountryCode('45717360'));
    }
}
