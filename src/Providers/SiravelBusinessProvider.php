<?php

namespace Siravel\Providers;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Siravel\Http\Middleware\Business as BusinessMiddleware;
use Siravel\Listeners\NoTenantIdentified;
use Siravel\Listeners\TenantRoutes;
use Siravel\Services\System\BusinessService;
use Tenancy\Affects\Filesystems\Events\ConfigureDisk;
use Tenancy\Identification\Events\NothingIdentified;

class SiravelBusinessProvider extends ServiceProvider
{
    protected $listen = [
        // Registered::class => [
        //     SendEmailVerificationNotification::class,
        // ],
        
        NoTenantIdentified::class => [
            NothingIdentified::class,
        ],
        ConfigureRoutes::class => [
            TenantRoutes::class,
        ],
        ConfigureRoutes::class => [
            TenantRoutes::class,
        ]
    ];
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
    }

    /**
     * Register the services.
     */
    public function register()
    {


        // BUsiness
        $loader = AliasLoader::getInstance();
        $loader->alias('Business', \Siravel\Facades\BusinessServiceFacade::class);
        $this->app->singleton(
            'business', function () {
                return new BusinessService();
            }
        );
        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware(BusinessMiddleware::class);

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
