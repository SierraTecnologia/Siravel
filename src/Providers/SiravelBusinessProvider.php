<?php

namespace Siravel\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Siravel\Services\System\BusinessService;

class SiravelBusinessProvider extends ServiceProvider
{
    /**
     * Register the services.
     */
    public function register()
    {

        // BUsiness
        $loader = AliasLoader::getInstance();
        $loader->alias('BusinessService', \Siravel\Facades\BusinessServiceFacade::class);
        $this->app->singleton(BusinessService::class, function () {
            return new BusinessService();
        });
        $this->app['events']->listen(
            'eloquent.*',
            'Siravel\Observers\BusinessCallbacks'
        );
        $this->app['events']->listen(
            'siravel::model.*',
            'Siravel\Observers\BusinessCallbacks'
        );
    }
}
