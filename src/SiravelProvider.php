<?php

namespace Siravel;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Muleta\Traits\Providers\ConsoleTools;
use Siravel\Services\System\BusinessService;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class SiravelProvider extends ServiceProvider
{
    use ConsoleTools;

    public static $aliasProviders = [

    ];

    public static $providers = [
        \Siravel\Providers\HomeServiceProvider::class,
        \Siravel\Providers\SiravelBusinessProvider::class,
        \Siravel\Providers\SiravelServiceProvider::class,
        \Siravel\Providers\SiravelEventProvider::class,
        \Siravel\Providers\SiravelRouteProvider::class,
        \Siravel\Providers\SiravelModuleProvider::class,
        \Facilitador\FacilitadorProvider::class,
        \Transmissor\TransmissorProvider::class,
        \Integrations\IntegrationsProvider::class,
        \Telefonica\TelefonicaProvider::class,
    ];

    /**
     * Rotas do Menu
     */
    public static $menuItens = [
        // 'Siravel' => [
        //     [
        //         'text'        => 'Dash',
        //         'route'       => 'siravel.sitec.dash',
        //         'icon'        => 'fas fa-fw fa-gavel',
        //         'icon_color'  => 'blue',
        //         'label_color' => 'success',
        //         // 'access' => \Facilitador\Models\Role::$ADMIN
        //     ],
        //     [
        //         'text'        => 'Profile',
        //         'route'       => 'siravel.sitec.profile',
        //         'icon'        => 'fas fa-fw fa-gavel',
        //         'icon_color'  => 'blue',
        //         'label_color' => 'success',
        //         // 'access' => \Facilitador\Models\Role::$ADMIN
        //     ],
        //     [
        //         'text'        => 'Actors',
        //         'route'       => 'siravel.components.actors.profile',
        //         'icon'        => 'fas fa-fw fa-gavel',
        //         'icon_color'  => 'blue',
        //         'label_color' => 'success',
        //         // 'access' => \Facilitador\Models\Role::$ADMIN
        //     ],
        // ],
        // 'Painel|200' => [
        //     [
        //         'text' => 'User',
        //         'icon' => 'fas fa-fw fa-bomb',
        //         'icon_color' => "blue",
        //         'label_color' => "success",
        //     ],
        //     'User' => [
        //         [
        //             'text'        => 'Home',
        //             'url'       => '/',
        //             'icon'        => 'fas fa-fw fa-industry',
        //             'icon_color'  => 'blue',
        //             'label_color' => 'success',
        //             // 'access' => \Facilitador\Models\Role::$ADMIN
        //         ],
        //         [
        //             'text'        => 'Profile',
        //             'route'       => 'facilitador.profile',
        //             'icon'        => 'fas fa-fw fa-industry',
        //             'icon_color'  => 'blue',
        //             'label_color' => 'success',
        //             // 'access' => \Facilitador\Models\Role::$ADMIN
        //         ],
        //         [
        //             'text'        => 'Logout',
        //             'route'       => 'facilitador.logout',
        //             'icon'        => 'fas fa-fw fa-industry',
        //             'icon_color'  => 'blue',
        //             'label_color' => 'success',
        //             // 'access' => \Facilitador\Models\Role::$ADMIN
        //         ],
        //     ],
        // ],
    ];

    /**
     * Alias the services in the boot.
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $this->publishes(
            [
            $this->getPublishesPath('app/Controllers') => app_path('Http/Controllers/Siravel'),
            $this->getPublishesPath('app/Services') => app_path('Services'),
            ], ['app',  'sitec', 'sitec-app', 'siravel', 'siravel-app']
        );

        $this->publishes(
            [
            $this->getPublishesPath('config') => base_path('config'),
            ], ['config',  'sitec', 'sitec-config', 'siravel', 'siravel-config']
        );

        $this->publishes(
            [
            $this->getPublishesPath('routes') => base_path('routes'),
            ], ['routes',  'sitec', 'sitec-routes', 'siravel', 'siravel-routes']
        );

        $this->publishes(
            [
            $this->getPublishesPath('public/js') => base_path('public/js'),
            $this->getPublishesPath('public/css') => base_path('public/css'),
            $this->getPublishesPath('public/img') => base_path('public/img'),
            ], ['public',  'sitec', 'sitec-public', 'siravel', 'siravel-public']
        );

        $this->publishes(
            [
            $this->getPublishesPath('resources/tools') => base_path('resources/tools'),
            ], ['tools',  'sitec', 'sitec-tools', 'siravel', 'siravel-tools']
        );

        $this->publishes(
            [
            $this->getResourcesPath('views') => base_path('resources/views/vendor/siravel'),
            ], ['views',  'sitec', 'sitec-views', 'siravel', 'siravel-views']
        );

        /*
        |--------------------------------------------------------------------------
        | Blade Directives
        |--------------------------------------------------------------------------
        */
        Blade::directive('menu', function ($expression) {
            return "<?php echo Siravel::menu($expression); ?>";
        });

        Blade::directive('features', function () {
            return '<?php echo Siravel::moduleLinks(); ?>';
        });

        Blade::directive('widget', function ($expression) {
            return "<?php echo Siravel::widget($expression); ?>";
        });

        Blade::directive('image', function ($expression) {
            return "<?php echo Siravel::image($expression); ?>";
        });

        Blade::directive('image_link', function ($expression) {
            return "<?php echo Siravel::imageLink($expression); ?>";
        });

        Blade::directive('images', function ($expression) {
            return "<?php echo Siravel::images($expression); ?>";
        });

        Blade::directive('edit', function ($expression) {
            return "<?php echo Siravel::editBtn($expression); ?>";
        });

        Blade::directive('markdown', function ($expression) {
            return "<?php echo Markdown::convertToHtml($expression); ?>";
        }); 
        $theme = Config::get('siravel.frontend-theme');
        
        View::addLocation(base_path('resources/themes/'.$theme));
        View::addNamespace('siravel-frontend', base_path('resources/themes/'.$theme));

        /*
        |--------------------------------------------------------------------------
        | Blade Directives
        |--------------------------------------------------------------------------
        */

        Blade::directive('theme', function ($expression) {
            if (Str::startsWith($expression, '(')) {
                $expression = substr($expression, 1, -1);
            }

            $view = '"siravel-frontend::'.str_replace('"', '', str_replace("'", '', $expression)).'"';

            return "<?php echo \$__env->make($view, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>";
        });

        Blade::directive('themejs', function ($expression) use ($theme) {
            return "<?php echo Minify::javascript('/../resources/themes/$theme/assets/js/'.$expression); ?>";
        });

        Blade::directive('themecss', function ($expression) use ($theme) {
            return "<?php echo Minify::stylesheet('/../resources/themes/$theme/assets/css/'.$expression); ?>";
        });
    }

    /**
     * Register the services.
     */
    public function register()
    {
        // Register external packages
        $this->setProviders();
        
        // Register Migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // View namespace
        $viewsPath = $this->getResourcesPath('views');
        $this->loadViewsFrom($viewsPath, 'siravel');
        $this->publishes(
            [
            $viewsPath => base_path('resources/views/vendor/siravel'),
            ], 'views'
        );

        if (is_dir(base_path('resources/siravel'))) {
            $this->app->view->addNamespace('siravel-frontend', base_path('resources/siravel'));
        } else {
            $this->app->view->addNamespace('siravel-frontend', $this->getResourcesPath('siravel'));
        }


        

        // Configs
        $this->app->config->set('siravel.modules.siravel', include __DIR__.'/config.php');

        /*
        |--------------------------------------------------------------------------
        | Register the Commands
        |--------------------------------------------------------------------------
        */
        // Register commands
        $this->registerCommandFolders(
            [
            base_path('vendor/sierratecnologia/siravel/src/Console/Commands') => '\Siravel\Console\Commands',
            ]
        );
        
    }

}
