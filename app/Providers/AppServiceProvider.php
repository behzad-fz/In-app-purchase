<?php

namespace App\Providers;

use App\Factories\AppStoreFactory;
use App\Models\Device;
use App\Repositories\DeviceRepository;
use App\Repositories\SubscriptionRepository;
use App\Services\AppleStoreService;
use App\Services\ClientTokenService;
use App\Services\GooglePlayStoreService;
use App\Services\PurchaseService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ClientTokenService::class, function($app) {
            return new ClientTokenService($app->make(Device::class));
        });

        $this->app->bind(PurchaseService::class, function($app) {
            return new PurchaseService($app->make(AppStoreFactory::class));
        });

        $this->app->bind(AppleStoreService::class, function($app) {
            return new AppleStoreService(request(), $app->make(SubscriptionRepository::class));
        });

        $this->app->bind(GooglePlayStoreService::class, function($app) {
            return new GooglePlayStoreService(request(), $app->make(SubscriptionRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
