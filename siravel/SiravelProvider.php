<?php

namespace Siravel;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;

class SiravelProvider extends ServiceProvider
{
    public static $aliasProviders = [

    ];

    public static $providers = [
        \Siravel\Providers\SiravelRouteProvider::class,
        
        /**
         * SitecLibs
         */
        \Casa\CasaProvider::class,
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
            $this->getPublishesPath('resources/tools') => base_path('resources/tools'),
            $this->getPublishesPath('app/Services') => app_path('Services'),
            $this->getPublishesPath('public/js') => base_path('public/js'),
            $this->getPublishesPath('public/css') => base_path('public/css'),
            $this->getPublishesPath('public/img') => base_path('public/img'),
            $this->getPublishesPath('config') => base_path('config'),
            $this->getPublishesPath('routes') => base_path('routes'),
            $this->getPublishesPath('app/Controllers') => app_path('Http/Controllers/Siravel'),
        ]);

        $this->publishes([
            $this->getResourcesPath('views') => base_path('resources/views/vendor/siravel'),
        ], 'siravel');

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
        // Register external packages
        $this->setProviders();
        $this->loadMigrationsFrom(__DIR__.'/Migrations');

        // View namespace
        $viewsPath = $this->getResourcesPath('views');
        $this->loadViewsFrom($viewsPath, 'siravel');
        $this->publishes([
            $viewsPath => base_path('resources/views/vendor/siravel'),
        ], 'views');

        if (is_dir(base_path('resources/siravel'))) {
            $this->app->view->addNamespace('siravel-frontend', base_path('resources/siravel'));
        } else {
            $this->app->view->addNamespace('siravel-frontend', $this->getResourcesPath('siravel'));
        }


        // Configs
        $this->app->config->set('siravel.modules.siravel', include(__DIR__.'/config.php'));

        /*
        |--------------------------------------------------------------------------
        | Register the Commands
        |--------------------------------------------------------------------------
        */

        $this->commands([]);
    }

    /**
     * Configs Paths
     */
    private function getResourcesPath($folder)
    {
        return __DIR__.'/../resources/'.$folder;
    }

    private function getPublishesPath($folder)
    {
        return __DIR__.'/../publishes/'.$folder;
    }

    private function getDistPath($folder)
    {
        return __DIR__.'/../dist/'.$folder;
    }

    /**
     * Load Alias and Providers
     */
    private function setProviders()
    {
        $this->setDependencesAlias();
        (new Collection(self::$providers))->map(function ($provider) {
            $this->app->register($provider);
        });
    }
    private function setDependencesAlias()
    {
        $loader = AliasLoader::getInstance();
        (new Collection(self::$aliasProviders))->map(function ($class, $alias) use ($loader) {
            $loader->alias($alias, $class);
        });
    }

}
