<?php

namespace Muneebkh2\ApiKeys\Middleware;

use Muneebkh2\ApiKeys\Models\ApiKey;

class AuthMiddleware
{
    public function handle($request, \Closure $next, ...$guards)
    {
        if ($request->is('api/*')) {
            if (self::hasApiToken($request)) {
                return $next($request);
            } else {
                return response()->json(["message" => "Authentication Failed!"], 401);
            }
        }
        return $next($request);
    }

    private function hasApiToken($request)
    {
        if ($request->header('api-token')) {
            return ApiKey::getByKey($request->header('api-token'));
        }
    }
}
