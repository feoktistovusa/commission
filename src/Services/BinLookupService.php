<?php

namespace Services;

use Interfaces\BinLookupServiceInterface;

class BinLookupService implements BinLookupServiceInterface
{
    private string $apiUrl;

    public function __construct(string $apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }

    public function getCountryCode(string $bin): string
    {
        $binResults = file_get_contents($this->apiUrl . $bin);
        if (!$binResults) {
            throw new \Exception('Error fetching BIN data.');
        }
        $r = json_decode($binResults);
        return $r->country->alpha2;
    }
}
