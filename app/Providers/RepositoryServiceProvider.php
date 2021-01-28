<?php

namespace App\Providers;

use App\Models\Device;
use App\Models\Subscription;
use App\Repositories\DeviceRepository;
use App\Repositories\SubscriptionRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(DeviceRepository::class, function($app) {
            return new DeviceRepository($app->make(Device::class));
        });

        $this->app->bind(SubscriptionRepository::class, function($app) {
            return new SubscriptionRepository($app->make(Subscription::class));
        });
    }
}
