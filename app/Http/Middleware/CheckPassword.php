<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Psr7\Message;

class CheckPassword
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
        if ($request -> api_password !== env('API_PASSWORD','M860cPZ7nzkUgVWh66rdj9Li')){
            return response()->json(['message' => 'Unauthenticated.']);
        }
        return $next($request); 
    }
}
