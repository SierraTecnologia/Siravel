<?php

namespace Siravel;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SiravelProvider extends ServiceProvider
{
    /**
     * Alias the services in the boot.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/Publishes/resources/tools' => base_path('resources/tools'),
            __DIR__.'/Publishes/app/Services' => app_path('Services'),
            __DIR__.'/Publishes/public/js' => base_path('public/js'),
            __DIR__.'/Publishes/public/css' => base_path('public/css'),
            __DIR__.'/Publishes/public/img' => base_path('public/img'),
            __DIR__.'/Publishes/config' => base_path('config'),
            __DIR__.'/Publishes/routes' => base_path('routes'),
            __DIR__.'/Publishes/app/Controllers' => app_path('Http/Controllers/Siravel'),
        ]);

        $this->publishes([
            __DIR__.'/Views' => base_path('resources/views/vendor/siravel'),
        ], 'SierraTecnologia Siravel');
    }

    /**
     * Register the services.
     */
    public function register()
    {
        $this->setProviders();

        // View namespace
        $this->loadViewsFrom(__DIR__.'/Views', 'siravel');

        if (is_dir(base_path('resources/siravel'))) {
            $this->app->view->addNamespace('siravel-frontend', base_path('resources/siravel'));
        } else {
            $this->app->view->addNamespace('siravel-frontend', __DIR__.'/Publishes/resources/siravel');
        }

        $this->loadMigrationsFrom(__DIR__.'/Migrations');

        // Configs
        $this->app->config->set('siravel.modules.siravel', include(__DIR__.'/config.php'));

        /*
        |--------------------------------------------------------------------------
        | Register the Commands
        |--------------------------------------------------------------------------
        */

        $this->commands([]);
    }

    protected function setProviders()
    {
        $this->app->register(\Siravel\Providers\SiravelEventServiceProvider::class);
        $this->app->register(\Siravel\Providers\SiravelServiceProvider::class);
        $this->app->register(\Siravel\Providers\SiravelRouteProvider::class);
        /**
         * Dependencias
         */
        $this->app->register(\Siravel\Providers\HorizonProvider::class);
        $this->app->register(\Siravel\Providers\TelescopeProvider::class);
        $this->app->register(\Siravel\Providers\FacilitadorProvider::class);
        
        /**
         * Serviços
         */
        $this->app->register(\Cmgmyr\Messenger\MessengerServiceProvider::class);




        /**
         * Logs Views
         */
        $this->app->register(\Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider::class);

    }
}
