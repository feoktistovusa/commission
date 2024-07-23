<?php

namespace Interfaces;

interface BinLookupServiceInterface
{
    public function getCountryCode(string $bin): string;
}
