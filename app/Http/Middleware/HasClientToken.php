<?php

namespace App\Http\Middleware;

use App\Facades\ClientToken;
use Closure;
use Illuminate\Http\Request;

class HasClientToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(isset(getallheaders()['Client-Token']) && ClientToken::isTokenValid(getallheaders()['Client-Token'])) {
            $request->attributes->add(['device' => ClientToken::getDevice(getallheaders()['Client-Token'])]);
            $request->attributes->add(['clientToken' => ClientToken::getClientToken(getallheaders()['Client-Token'])]);
            return $next($request);
        }else{
            return response()->json(['status' => false,'error' => "Unauthorized"], 401);
        }
    }
}
