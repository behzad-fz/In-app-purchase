<?php

namespace App\Factories;

use App\Exceptions\StoreNotFoundException;
use App\Services\AppleStoreService;
use App\Services\GooglePlayStoreService;

class AppStoreFactory
{
    public function initialize($os)
    {
        if ($os === 'ios') {
            return app()->make(AppleStoreService::class);
        } elseif ($os === 'android') {
            return app()->make(GooglePlayStoreService::class);
        }

        throw new StoreNotFoundException("Unsupported Application Store");
    }
}
