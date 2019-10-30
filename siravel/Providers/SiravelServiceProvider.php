<?php

namespace Siravel\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class SiravelServiceProvider extends ServiceProvider
{
    /**
     * Alias the services in the boot.
     */
    public function boot()
    {
    }

    /**
     * Register the services.
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();

        $loader->alias('TranslationCache', \RicardoSierra\Translation\Facades\TranslationCache::class);
        $loader->alias('Translation', \RicardoSierra\Translation\Facades\Translation::class);
        $this->app->register(\RicardoSierra\Translation\TranslationServiceProvider::class);



        
        // // @todo Resolver
        // $loader->alias('FileService', \SierraTecnologia\Facilitador\Services\Midia\FileService::class);
        // $loader->alias('BusinessService', \App\Facades\BusinessServiceFacade::class);
        // $loader->alias('EventService', \App\Facades\EventServiceFacade::class);

        // $this->app->bind('FileService', function ($app) {
        //     return new FileService();
        // });

        // $this->app->bind('BusinessService', function ($app) {
        //     return new BusinessService();
        // });

        // $this->app->bind('EventService', function ($app) {
        //     return App::make(EventService::class);
        // });
    }
}
