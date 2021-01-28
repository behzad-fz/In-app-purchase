<?php

use Carbon\Carbon;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

Http::fake([

    // Apple apis
    'https://sandbox.itunes.apple.com/verifyReceipt*' => Http::response([
        'response' => (is_numeric(request()->receipt) && request()->receipt % 2 != 0) ? true : false ,
        'info' => (is_numeric(request()->receipt) && request()->receipt % 2 != 0) ? [
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

    // Google apis
    'https://sandbox.google.com/verifyReceipt*' => Http::response([
        'response' => (is_numeric(request()->receipt) && request()->receipt % 2 != 0) ? true : false ,
        'info' => (is_numeric(request()->receipt) && request()->receipt % 2 != 0) ? [
            'adam_id' => 1,
            'app_item_id' => 1,
            'application_version' => 1,
            'bundle_id' => 1,
            'download_id' => 1,
            'expiration_date' => Carbon::now('UTC')->addMonths(1)->format('Y-m-d H:i:s'),
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
            'original_purchase_date' => Carbon::now('UTC')->format('Y-m-d H:i:s'),
        ] : null ,
    ], 200),

    // Event reporting apis
    'report-events*' => Http::response([
        'response' => 'OK'
    ], 201),
]);

