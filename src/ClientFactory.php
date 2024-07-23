<?php

use Interfaces\BinLookupServiceInterface;
use Interfaces\ExchangeRateServiceInterface;
use Services\MockBinLookupService;
use Services\BinLookupService;
use Services\MockExchangeRateService;
use Services\ExchangeRateService;

class ClientFactory
{
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function createBinLookupService(): BinLookupServiceInterface
    {
        if (isset($this->config['use_mock_services']) && $this->config['use_mock_services']) {
            return new MockBinLookupService();
        }
        return new BinLookupService($this->config['bin_provider']['url']);
    }

    public function createExchangeRateService(): ExchangeRateServiceInterface
    {
        if (isset($this->config['use_mock_services']) && $this->config['use_mock_services']) {
            return new MockExchangeRateService();
        }
        return new ExchangeRateService($this->config['exchange_rate_provider']['url']);
    }
}
