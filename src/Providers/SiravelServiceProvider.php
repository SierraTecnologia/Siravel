<?php

namespace Siravel\Providers;

use App;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Siravel\Services\BlogService;
use Siravel\Services\EventService;
use Siravel\Services\ModuleService;
use Siravel\Services\Negocios\PageService;
use Siravel\Services\SiravelService;

class SiravelServiceProvider extends ServiceProvider
{
    /**
     * Register the services.
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();

        $loader->alias('Siravel', \Siravel\Facades\SiravelServiceFacade::class);
        $loader->alias('SiravelService', \Siravel\Facades\SiravelServiceFacade::class);
        $loader->alias('PageService', \Siravel\Facades\PageServiceFacade::class);
        $loader->alias('EventService', \Siravel\Facades\EventServiceFacade::class);
        $loader->alias('ModuleService', \Siravel\Facades\ModuleServiceFacade::class);
        $loader->alias('BlogService', \Siravel\Facades\BlogServiceFacade::class);
        $loader->alias('FileService', \Stalker\Services\Midia\FileService::class);

        $this->app->bind('SiravelService', function ($app) {
            return new SiravelService();
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
