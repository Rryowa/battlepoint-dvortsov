<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class LogRequestDetails
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        Log::info('Request Details', [
            'method' => $request->method(),
            'uri' => $request->fullUrl(),
            'ip' => $request->ip(),
            'response_status' => $response->getStatusCode(),
        ]);

        return $response;
    }
}
