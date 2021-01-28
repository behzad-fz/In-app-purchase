<?php

namespace App\Http\Controllers\Api;

use App\Events\SubscriptionStarted;
use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest;
use App\Services\PurchaseService;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    use ResponseAPI;
    private $purchaseService;

    public function __construct(PurchaseService $purchaseService)
    {
        $this->purchaseService = $purchaseService;
    }

    public function new(PurchaseRequest $request)
    {
        if ($request->get('clientToken')->subscriptions()->count()) {
            return $this->error('You Already Subscribed', 406);
        }

        $subscription = $this->purchaseService->verifyReceipt($request);
        SubscriptionStarted::dispatch($subscription,$request);
        return $subscription;
    }
}
