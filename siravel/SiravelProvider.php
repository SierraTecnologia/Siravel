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
        $this->app->register(\Siravel\Providers\HorizonServiceProvider::class);
        $this->app->register(\Siravel\Providers\TelescopeServiceProvider::class);
        $this->app->register(\Facilitador\FacilitadorProvider::class);
        $this->app->register(\Locaravel\LocaravelProvider::class);

        $this->app->register(\Laravel\Passport\PassportServiceProvider::class);
        
        /**
         * Serviços
         */
        $this->app->register(\Cmgmyr\Messenger\MessengerServiceProvider::class);


        /**
         * Admin
         */
        $this->app->register(\Laravel\Tinker\TinkerServiceProvider::class);


        /**
         * Logs Views
         */
        $this->app->register(\Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider::class);

    }
}
