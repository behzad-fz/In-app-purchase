<?php

namespace App\Services;

use App\Interfaces\ApplicationStoreInterface;
use App\Models\Subscription;
use App\Repositories\SubscriptionRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class AppleStoreService implements ApplicationStoreInterface
{
    private $request;
    private $subscriptionModel;

    public function __construct($request, $subscriptionModel)
    {
        $this->request = $request;
        $this->subscriptionModel = $subscriptionModel;
    }

    public function verify()
    {
        $response =  Http::get('mock-api/https://sandbox.itunes.apple.com/verifyReceipt',[
            'receipt' => $this->request->receipt
        ]) ;

        if ($response->json()['response']) {
            $this->subscriptionModel->create([
                'uid'   => $this->request->get('device')->uid,
                'appid' => $this->request->get('device')->appid,
               'product_id' => $response->json()['info']['adam_id'],
               'client_token_id'    => $this->request->get('clientToken')->id,
               'os'    => $this->request->get('device')->os,
               'receipt'    => $this->request->receipt,
               'purchase_date'  => Carbon::create($response->json()['info']['original_purchase_date'])->addHours(6)->format('Y-m-d H:i:s'),
                'expiry_date'   => Carbon::create($response->json()['info']['expiration_date'])->addHours(6)->format('Y-m-d H:i:s'),
                'status'    => Subscription::ACTIVE_STATUS,
            ]);
        }

        return $response->json();
    }

    public function check($receipt)
    {
        Http::fake([
            // Stub a JSON response for GitHub endpoints...
            'mock-api/https://sandbox.itunes.apple.com/check*' => Http::response([
                'response' => (is_numeric($receipt) && $receipt % 2 != 0) ? true : false ,
                'info' => (is_numeric($receipt) && $receipt % 2 != 0) ? [
                    'adam_id' => 1,
                    'app_item_id' => 1,
                    'application_version' => 1,
                    'bundle_id' => 1,
                    'download_id' => 1,
                    'expiration_date' => Carbon::now('-6 UTC')->addMonths(1)->format('Y-m-d H:i:s'),
                    'expiration_date_ms' => 1,
                    'expiration_date_pst' => 1,
                    'in_app' => [
                        'cancellation_date' => 1,
                        'cancellation_date_ms' => 1,
                        'cancellation_date_pst' => 1,
                        'cancellation_reason' => 1,
                        'expires_date' => 1,
                        'expires_date_ms' => 1,
                        'expires_date_pst' => 1,
                        'is_in_intro_offer_period' => 1,
                    ],
                    'original_purchase_date' => Carbon::now('-6 UTC')->format('Y-m-d H:i:s'),
                ] : null ,
            ], 200),


        ]);

        if (is_numeric($receipt) && $receipt % 6 != 0) {
            $response = Http::retry(3, 100)->get('mock-api/https://sandbox.itunes.apple.com/check');
        } else {
            $response =  Http::get('mock-api/https://sandbox.itunes.apple.com/check') ;
        }

        return $response->json();
    }
}
