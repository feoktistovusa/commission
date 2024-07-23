<?php

use Interfaces\BinLookupServiceInterface;
use Interfaces\ExchangeRateServiceInterface;

class CommissionCalculator
{
    private BinLookupServiceInterface $binLookupService;
    private ExchangeRateServiceInterface $exchangeRateService;

    public function __construct(BinLookupServiceInterface $binLookupService, ExchangeRateServiceInterface $exchangeRateService)
    {
        $this->binLookupService = $binLookupService;
        $this->exchangeRateService = $exchangeRateService;
    }

    public function calculate(string $bin, float $amount, string $currency): float
    {
        $countryCode = $this->binLookupService->getCountryCode($bin);
        $isEu = $this->isEu($countryCode);
        $rate = $currency == 'EUR' ? 1 : $this->exchangeRateService->getRate($currency);
        $amountFixed = $currency == 'EUR' ? $amount : $amount / $rate;
        $commission = $amountFixed * ($isEu ? 0.01 : 0.02);

        return ceil($commission * 100) / 100;
    }

    private function isEu(string $countryCode): bool
    {
        $euCountries = [
            'AT', 'BE', 'BG', 'CY', 'CZ', 'DE', 'DK', 'EE', 'ES', 'FI', 'FR',
            'GR', 'HR', 'HU', 'IE', 'IT', 'LT', 'LU', 'LV', 'MT', 'NL', 'PO',
            'PT', 'RO', 'SE', 'SI', 'SK'
        ];

        return in_array($countryCode, $euCountries);
    }
}
