<?php

namespace Siravel\Providers;

use App;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use App\Services\BlogService;
use App\Services\CryptoService;
use App\Services\EventService;
use App\Services\ModuleService;
use App\Services\Negocios\PageService;
use App\Services\CmsService;

class CmsServiceProvider extends ServiceProvider
{
    /**
     * Register the services.
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();

        $loader->alias('FileService', \SierraTecnologia\Facilitador\Services\Midia\FileService::class);
        $loader->alias('BusinessService', \App\Facades\BusinessServiceFacade::class);
        $loader->alias('CmsService', \App\Facades\CmsServiceFacade::class);
        $loader->alias('PageService', \App\Facades\PageServiceFacade::class);
        $loader->alias('EventService', \App\Facades\EventServiceFacade::class);
        $loader->alias('ModuleService', \App\Facades\ModuleServiceFacade::class);
        $loader->alias('BlogService', \App\Facades\BlogServiceFacade::class);

        $this->app->bind('FileService', function ($app) {
            return new FileService();
        });

        $this->app->bind('BusinessService', function ($app) {
            return new BusinessService();
        });
        
        $this->app->bind('CmsService', function ($app) {
            return new CmsService();
        });

        $this->app->bind('PageService', function ($app) {
            return new PageService();
        });

        $this->app->bind('EventService', function ($app) {
            return App::make(EventService::class);
        });

        $this->app->bind('ModuleService', function ($app) {
            return new ModuleService();
        });

        $this->app->bind('BlogService', function ($app) {
            return new BlogService();
        });
    }
}
