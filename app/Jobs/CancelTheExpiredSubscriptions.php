<?php

namespace App\Jobs;

use App\Events\SubscriptionCanceled;
use App\Facades\Purchase;
use App\Models\Subscription;
use App\Services\PurchaseService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class CancelTheExpiredSubscriptions implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        dispatch(function () {
            foreach (Subscription::where('status',1)->get() as $subscription) {
                $verification = Purchase::checkSubscription($subscription);
                if (Carbon::create($verification['info']['expiration_date'])->addHours(6)->format('Y-m-d H:i:s') < Carbon::now()->format('Y-m-d H:i:s')) {
                    $subscription->update(['status' => Subscription::CANCELED_STATUS]);
                    SubscriptionCanceled::dispatch($subscription);
                }
            }
        });
    }
}
