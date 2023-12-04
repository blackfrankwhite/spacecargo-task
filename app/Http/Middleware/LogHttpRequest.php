<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class LogHttpRequest
{
    public function handle(Request $request, Closure $next)
    {
        $startTime = microtime(true);

        $response = $next($request);

        $endTime = microtime(true);

        $requestData = $request->all();
        if (isset($requestData['password'])) {
            $requestData['password'] = '*';
        }

        Log::create([
            'session_id' => session()->getId(),
            'user_ip' => $request->ip(),
            'request_method' => $request->method(),
            'api_address' => $request->path(),
            'parameters' => json_encode($requestData),
            'response_parameters' => $response->getContent(),
            'error_message' => $response->exception ? $response->exception->getMessage() : null,
            'request_time' => now(),
            'service_processing_time' => $endTime - $startTime
        ]);

        return $response;
    }
}

