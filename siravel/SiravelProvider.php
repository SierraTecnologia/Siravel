<?php

namespace Siravel;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;

class SiravelProvider extends ServiceProvider
{
    public static $providers = [
    
        \Siravel\Providers\SiravelEventServiceProvider::class,
        \Siravel\Providers\SiravelRouteProvider::class,
        
        /**
         * SitecLibs
         */
        \Finder\FinderProvider::class,
        \Gamer\GamerProvider::class,
        \Facilitador\FacilitadorProvider::class,
        
        /**
         * Serviços
         */
        \Cmgmyr\Messenger\MessengerServiceProvider::class,

    ];

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
            __DIR__.'../resources/views' => base_path('resources/views/vendor/siravel'),
        ], 'SierraTecnologia Siravel');
        /*
        |--------------------------------------------------------------------------
        | Blade Directives
        |--------------------------------------------------------------------------
        */
        /**
        Blade::directive('menu', function ($expression) {
            return "<?php echo Cms::menu($expression); ?>";
        });

        Blade::directive('features', function () {
            return '<?php echo Cms::moduleLinks(); ?>';
        });

        Blade::directive('widget', function ($expression) {
            return "<?php echo Cms::widget($expression); ?>";
        });

        Blade::directive('image', function ($expression) {
            return "<?php echo Cms::image($expression); ?>";
        });

        Blade::directive('image_link', function ($expression) {
            return "<?php echo Cms::imageLink($expression); ?>";
        });

        Blade::directive('images', function ($expression) {
            return "<?php echo Cms::images($expression); ?>";
        });

        Blade::directive('edit', function ($expression) {
            return "<?php echo Cms::editBtn($expression); ?>";
        });

        Blade::directive('markdown', function ($expression) {
            return "<?php echo Markdown::convertToHtml($expression); ?>";
        }); */
    }

    /**
     * Register the services.
     */
    public function register()
    {
        $this->setDependencesAlias();
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

    protected function setDependencesAlias()
    {

        // $loader = AliasLoader::getInstance();

        // // @todo Resolver
        // $loader->alias('FileService', \Facilitador\Services\Midia\FileService::class);
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

    private function setProviders()
    {
        (new Collection(self::$providers))->map(function ($provider) {
            $this->app->register($provider);
        });
    }

}
