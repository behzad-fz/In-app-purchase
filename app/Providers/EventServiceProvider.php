<?php

namespace App\Providers;

use App\Events\SubscriptionCanceled;
use App\Events\SubscriptionRenewed;
use App\Events\SubscriptionStarted;
use App\Listeners\ReportCancelingSubscription;
use App\Listeners\ReportRenewingSubscription;
use App\Listeners\ReportStartingNewSubscription;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SubscriptionStarted::class => [
            ReportStartingNewSubscription::class
        ],
        SubscriptionCanceled::class => [
            ReportCancelingSubscription::class
        ],
        SubscriptionRenewed::class => [
            ReportRenewingSubscription::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
