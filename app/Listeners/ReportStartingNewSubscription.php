<?php

namespace App\Listeners;

use App\Events\SubscriptionStarted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ReportStartingNewSubscription
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
     * @param  SubscriptionStarted  $event
     * @return void
     */
    public function handle(SubscriptionStarted $event)
    {
        Http::post('mock-api/report-events',[
            'AppID' => $event->request->get('device')->appid,
            'deviceID' => $event->request->get('device')->uid,
            'eventInfo' => "new subscription started.",
        ]);
    }
}
