<?php

namespace Services;

use Interfaces\ExchangeRateServiceInterface;

class MockExchangeRateService implements ExchangeRateServiceInterface
{
    public function getRate(string $currency): float
    {
        return 0.85;
    }
}
