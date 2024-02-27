<?php

namespace Muneebkh2\ApiKeys\Middleware;

use Muneebkh2\ApiKeys\Models\ApiKey;

class AuthMiddleware
{
    public function handle($request, \Closure $next, ...$guards)
    {
        if ($request->is('api/*')) {
            if (self::hasApiToken($request)) {
                // dd("asew");
                return $next($request);
            } else {
                return response()->json(["message" => "Authentication Failed!"], 401);
            }
        }
    }

    private function hasApiToken($request)
    {
        // dd($request->header('api-token'));
        if ($request->header('api-token')) {
            // dd(ApiKey::getByKey($request->header('api-token')));
            return ApiKey::getByKey($request->header('api-token'));
        }
    }
}
