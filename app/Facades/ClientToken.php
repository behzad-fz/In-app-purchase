<?php

namespace App\Facades;

use App\Services\ClientTokenService;
use Illuminate\Support\Facades\Facade;

class ClientToken extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ClientTokenService::class;
    }
}
