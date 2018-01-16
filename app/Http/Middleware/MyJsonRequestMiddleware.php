<?php

namespace App\Http\Middleware;

use Closure;

class MyJsonRequestMiddleware
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
        if ( !$request->isJson() ) {
      
            return response()->json(['ERROR' => '415 - UNSUPPORTED MEDIA TYPE'], 415);
        }
        
        return $next($request);
    }
}
