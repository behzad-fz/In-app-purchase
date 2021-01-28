<?php

namespace App\Listeners;

use App\Events\SubscriptionCanceled;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class ReportCancelingSubscription
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
     * @param  SubscriptionCanceled  $event
     * @return void
     */
    public function handle(SubscriptionCanceled $event)
    {
        Http::post('mock-api/report-events',[
            'AppID' => $event->subscription->appid,
            'deviceID' => $event->subscription->uid,
            'eventInfo' => "new subscription canceled.",
        ]);
    }
}
