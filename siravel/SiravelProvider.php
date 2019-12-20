<?php

namespace Siravel;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Support\ClassesHelpers\Traits\Models\ConsoleTools;

use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class SiravelProvider extends ServiceProvider
{
    use ConsoleTools;

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
    public function boot(Dispatcher $events)
    {

        $this->publishes([
            $this->getPublishesPath('app/Controllers') => app_path('Http/Controllers/Siravel'),
            $this->getPublishesPath('app/Services') => app_path('Services'),
        ], ['app',  'sitec', 'sitec-app', 'siravel', 'siravel-app']);

        $this->publishes([
            $this->getPublishesPath('config') => base_path('config'),
        ], ['config',  'sitec', 'sitec-config', 'siravel', 'siravel-config']);

        $this->publishes([
            $this->getPublishesPath('routes') => base_path('routes'),
        ], ['routes',  'sitec', 'sitec-routes', 'siravel', 'siravel-routes']);

        $this->publishes([
            $this->getPublishesPath('public/js') => base_path('public/js'),
            $this->getPublishesPath('public/css') => base_path('public/css'),
            $this->getPublishesPath('public/img') => base_path('public/img'),
        ], ['public',  'sitec', 'sitec-public', 'siravel', 'siravel-public']);

        $this->publishes([
            $this->getPublishesPath('resources/tools') => base_path('resources/tools'),
        ], ['tools',  'sitec', 'sitec-tools', 'siravel', 'siravel-tools']);

        $this->publishes([
            $this->getResourcesPath('views') => base_path('resources/views/vendor/siravel'),
        ], ['views',  'sitec', 'sitec-views', 'siravel', 'siravel-views']);


        /**
         * AdminlteMenu
         */

        
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            /**
             * Pacotes
             */
            $event->menu->add('Siravel');
            $event->menu->add([
                'text'        => 'Dash',
                'url'         => route('siravel.sitec.dash'),
                'icon'        => 'dashboard',
                'icon_color'  => 'blue',
                'label_color' => 'success',
                // 'access' => \App\Models\Role::$ADMIN
            ]);
            $event->menu->add([
                'text'        => 'Profile',
                'url'         => route('siravel.sitec.profile'),
                'icon'        => 'dashboard',
                'icon_color'  => 'blue',
                'label_color' => 'success',
                // 'access' => \App\Models\Role::$ADMIN
            ]);
            $event->menu->add([
                'text'        => 'Actors',
                'url'         => route('siravel.components.actors.profile'),
                'icon'        => 'dashboard',
                'icon_color'  => 'blue',
                'label_color' => 'success',
                // 'access' => \App\Models\Role::$ADMIN
            ]);
            $event->menu->add([
                'text'    => 'Bots',
                'icon'    => 'cog',
                'nivel' => \App\Models\Role::$GOOD,
                'submenu' => [
                    [
                        'text'        => 'Runners',
                        'url'         => 'runners',
                        'icon'        => 'industry',
                        'icon_color'  => 'red',
                        'label_color' => 'success',
                        'nivel' => \App\Models\Role::$GOOD,
                    ],
                    [
                        'text'        => 'Actions',
                        'url'         => route('siravel.actions.index'),
                        'icon'        => 'coffee',
                        'icon_color'  => 'red',
                        'label_color' => 'success',
                        'nivel' => \App\Models\Role::$GOOD,
                    ],
                ]
            ]);
        });
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
        // Register commands
        $this->registerCommandFolders([
            base_path('vendor/sierratecnologia/tools/siravel/Console/Commands') => '\Siravel\Console\Commands',
        ]);
    }

}
