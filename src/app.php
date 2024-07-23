<?php

require 'vendor/autoload.php';

$config = require 'config/config.php';
$clientFactory = new ClientFactory($config);

$binLookupService = $clientFactory->createBinLookupService();
$exchangeRateService = $clientFactory->createExchangeRateService();
$commissionCalculator = new CommissionCalculator($binLookupService, $exchangeRateService);

$inputFile = $argv[1];
foreach (explode("\n", file_get_contents($inputFile)) as $row) {
    if (empty($row)) break;

    $transaction = json_decode($row, true);
    $bin = $transaction['bin'];
    $amount = $transaction['amount'];
    $currency = $transaction['currency'];

    $commission = $commissionCalculator->calculate($bin, (float)$amount, $currency);

    echo $commission . "\n";
}
