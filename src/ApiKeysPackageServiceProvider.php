<?php

namespace Muneebkh2\ApiKeys;

use Illuminate\Support\ServiceProvider;
use Muneebkh2\ApiKeys\Middleware\AuthMiddleware;
use Muneebkh2\ApiKeys\Console\Commands\GenerateApiKey;

class ApiKeysPackageServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateApiKey::class
            ]);
        }

        $this->app['router']
            ->aliasMiddleware('auth', AuthMiddleware::class);

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
