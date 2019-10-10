<?php

namespace Siravel\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use SiUtils\Helpers\StoreHelper;
use Siravel\Services\CartService;
use Siravel\Services\CustomerProfileService;
use Siravel\Services\LogisticService;
use Siravel\Services\ProductService;

class SiravelServiceProvider extends ServiceProvider
{
    /**
     * Alias the services in the boot.
     */
    public function boot()
    {
        $loader = AliasLoader::getInstance();

        $loader->alias('StoreHelper', StoreHelper::class);
    }

    /**
     * Register the services.
     */
    public function register()
    {
        $this->app->bind('ProductService', function ($app) {
            return app()->make(ProductService::class);
        });

        $this->app->bind('CartService', function ($app) {
            return app()->make(CartService::class);
        });

        $this->app->bind('LogisticService', function ($app) {
            return app()->make(LogisticService::class);
        });

        $this->app->bind('CustomerProfileService', function ($app) {
            return app()->make(CustomerProfileService::class);
        });
    }
}
