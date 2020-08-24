<?php

namespace Siravel\Providers;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Siravel\Http\Middleware\Business as BusinessMiddleware;
use Siravel\Services\System\BusinessService;

class SiravelBusinessProvider extends ServiceProvider
{
    // /**
    //  * Indicates if loading of the provider is deferred.
    //  *
    //  * @var bool
    //  */
    // protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        Schema::defaultStringLength(191);
        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware(BusinessMiddleware::class);
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
