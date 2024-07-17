<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apikey = $request->header('API_KEY');

        if($apikey!=='helloatg') {
            return response()->json([
                'status' => 0,
                'message' => 'Invalid Api Key',
            ],401);
        }
        return $next($request);
    }
}
