<?php

namespace Interfaces;

interface ExchangeRateServiceInterface
{
    public function getRate(string $currency): float;
}
