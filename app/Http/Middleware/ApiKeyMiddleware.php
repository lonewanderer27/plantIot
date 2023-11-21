<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-KEY');

        if ($apiKey && $apiKey === config('app.x_api_key')) {
            // The API key is valid, continue with the request
            return $next($request);
        }
        
        // Invalid API key, return an error response
        return response()->json([
            'error' => true,
            'success' => false,
            'message' => 'Invalid API key'
        ], 401);
    }
}
