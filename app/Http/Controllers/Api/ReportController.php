<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return response([
            'basisOfOperatingSystem' => Subscription::select(['os', DB::raw('count(id) as quantity')])->groupBy('os')->get(),
            'basisOfApp' => Subscription::select(['appid', DB::raw('count(id) as quantity')])->groupBy('appid')->get(),
            'basisOfDay' => Subscription::get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->created_at)->format('y-m-d');
            }),
        ]);
    }
}
