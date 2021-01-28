<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api'], function () {
    Route::apiResource('register', 'RegisterController')->only('store');

    Route::group(['middleware' => 'hasClientToken'], function () {
        Route::post('purchase', 'PurchaseController@new');
        Route::get('check-subscription', 'SubscriptionController@status');
    });

    Route::get('report', 'ReportController@index');


});
