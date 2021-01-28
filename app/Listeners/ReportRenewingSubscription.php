<?php

namespace App\Listeners;

use App\Events\SubscriptionRenewed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class ReportRenewingSubscription
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SubscriptionRenewed  $event
     * @return void
     */
    public function handle(SubscriptionRenewed $event)
    {
        Http::post('mock-api/report-events',[
            'AppID' => $event->subscription->appid,
            'deviceID' => $event->subscription->uid,
            'eventInfo' => "new subscription renewed.",
        ]);
    }
}
