<?php

namespace Muneebkh2\ApiKeys;

use Illuminate\Support\ServiceProvider;

class ApiKeysPackageServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
