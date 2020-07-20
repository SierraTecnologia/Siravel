<?php

namespace Siravel\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Siravel\Services\System\BusinessService;
use Siravel\Http\Middleware\Business as BusinessMiddleware;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Schema;

class SiravelBusinessProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        Schema::defaultStringLength(191);
        $router->pushMiddlewareToGroup('web', BusinessMiddleware::class);
    }

    /**
     * Register the services.
     */
    public function register()
    {


        // BUsiness
        $loader = AliasLoader::getInstance();
        $loader->alias('Business', \Siravel\Facades\BusinessServiceFacade::class);
        $this->app->singleton('business', function () {
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
