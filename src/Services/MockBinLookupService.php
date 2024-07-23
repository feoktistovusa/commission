<?php

namespace Services;

use Interfaces\BinLookupServiceInterface;

class MockBinLookupService implements BinLookupServiceInterface
{
    public function getCountryCode(string $bin): string
    {
        return 'DE';
    }
}
