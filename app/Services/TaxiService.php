<?php

namespace App\Services;

use App\Models\TaxiConfiguration;

class TaxiService
{
    public function getTaxiConfiguration()
    {
        return TaxiConfiguration::first();
    }
}
