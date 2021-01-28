<?php

namespace App\Services;

class PurchaseService
{
    private $storeFactory;

    public function __construct($storeFactory)
    {
        $this->storeFactory = $storeFactory;
    }

    public function verifyReceipt($request)
    {
        $operatingSystem = $request->get('device')->os;
        $store =  $this->storeFactory->initialize($operatingSystem);
        return $store->verify();
    }

    public function checkSubscription($subscription)
    {
        $operatingSystem = $subscription->os;
        $store =  $this->storeFactory->initialize($operatingSystem);
        return $store->check($subscription->receipt);
    }
}
