<?php

namespace Services;

use Interfaces\ExchangeRateServiceInterface;

class ExchangeRateService implements ExchangeRateServiceInterface
{
    private string $apiUrl;

    public function __construct(string $apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }

    public function getRate(string $currency): float
    {
        $rateData = @json_decode(file_get_contents($this->apiUrl), true);
        if (!isset($rateData['rates'][$currency])) {
            throw new \Exception('Error fetching exchange rates.');
        }
        return $rateData['rates'][$currency];
    }
}
