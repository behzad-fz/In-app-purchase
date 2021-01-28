<?php

namespace App\Facades;

use App\Services\PurchaseService;
use Illuminate\Support\Facades\Facade;

class Purchase extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PurchaseService::class;
    }
}
