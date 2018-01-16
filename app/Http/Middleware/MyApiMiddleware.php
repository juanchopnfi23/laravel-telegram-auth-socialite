<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class MyApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->input('api_token')) {

            if ( User::where('api_token', $request->input('api_token'))->first() ) {
                return $next($request);
            }
            
        }

        if ($request->header('api_token')) {

            if ( User::where('api_token', $request->header('api_token'))->first() ) {
                return $next($request);
            }

        }
    
        return response()->json(['ERROR' => 'Unauthorized.'], 401);
    }
}
