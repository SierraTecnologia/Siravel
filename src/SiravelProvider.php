<?php

namespace Siravel;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Muleta\Traits\Providers\ConsoleTools;
use Siravel\Services\BusinessService;

class SiravelProvider extends ServiceProvider
{
    use ConsoleTools;

    public $packageName = 'siravel';
    const pathVendor = 'sierratecnologia/siravel';

    public static $aliasProviders = [

    ];

    public static $providers = [
        \Siravel\Providers\HomeServiceProvider::class,
        \Siravel\Providers\FeatureServiceProvider::class,
        \Siravel\Providers\SiravelBusinessProvider::class,
        \Siravel\Providers\RiCaServiceProvider::class,
        \Siravel\Providers\SiravelEventProvider::class,
        \Siravel\Providers\SiravelRouteProvider::class,
        \Siravel\Providers\SiravelModuleProvider::class,

        \Porteiro\PorteiroProvider::class,
        \Facilitador\FacilitadorProvider::class,
        \Bancario\BancarioProvider::class,
        \Transmissor\TransmissorProvider::class,
        \Integrations\IntegrationsProvider::class,
        \Telefonica\TelefonicaProvider::class,
        \Templeiro\TempleiroProvider::class,

        \Tenancy\Affects\Broadcasts\Provider::class,
        \Tenancy\Affects\Cache\Provider::class,
        \Tenancy\Affects\Configs\Provider::class,
        \Tenancy\Affects\Connections\Provider::class,
        \Tenancy\Affects\Filesystems\Provider::class,
        \Tenancy\Affects\Logs\Provider::class,
        \Tenancy\Affects\Mails\Provider::class,
        \Tenancy\Affects\Models\Provider::class,
        \Tenancy\Affects\Routes\Provider::class,
        \Tenancy\Affects\URLs\Provider::class,
        \Tenancy\Affects\Views\Provider::class,

        \Tenancy\Hooks\Database\Provider::class,
        \Tenancy\Hooks\Migration\Provider::class,
        \Tenancy\Hooks\Hostname\Provider::class,

        \Tenancy\Database\Drivers\Mysql\Provider::class,
        \Tenancy\Database\Drivers\Sqlite\Provider::class
        
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
        //         // 'access' => \Porteiro\Models\Role::$ADMIN
        //     ],
        //     [
        //         'text'        => 'Profile',
        //         'route'       => 'siravel.sitec.profile',
        //         'icon'        => 'fas fa-fw fa-gavel',
        //         'icon_color'  => 'blue',
        //         'label_color' => 'success',
        //         // 'access' => \Porteiro\Models\Role::$ADMIN
        //     ],
        //     [
        //         'text'        => 'Actors',
        //         'route'       => 'siravel.components.actors.profile',
        //         'icon'        => 'fas fa-fw fa-gavel',
        //         'icon_color'  => 'blue',
        //         'label_color' => 'success',
        //         // 'access' => \Porteiro\Models\Role::$ADMIN
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
        //             // 'access' => \Porteiro\Models\Role::$ADMIN
        //         ],
        //         [
        //             'text'        => 'Profile',
        //             'route'       => 'facilitador.profile',
        //             'icon'        => 'fas fa-fw fa-industry',
        //             'icon_color'  => 'blue',
        //             'label_color' => 'success',
        //             // 'access' => \Porteiro\Models\Role::$ADMIN
        //         ],
        //         [
        //             'text'        => 'Logout',
        //             'route'       => 'facilitador.logout',
        //             'icon'        => 'fas fa-fw fa-industry',
        //             'icon_color'  => 'blue',
        //             'label_color' => 'success',
        //             // 'access' => \Porteiro\Models\Role::$ADMIN
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
            ],
            ['app',  'sitec', 'sitec-app', 'siravel', 'siravel-app']
        );

        $this->publishes(
            [
            $this->getPublishesPath('config') => base_path('config'),
            ],
            ['config',  'sitec', 'sitec-config', 'siravel', 'siravel-config']
        );

        $this->publishes(
            [
            $this->getPublishesPath('routes') => base_path('routes'),
            ],
            ['routes',  'sitec', 'sitec-routes', 'siravel', 'siravel-routes']
        );

        $this->publishes(
            [
            $this->getPublishesPath('public/js') => base_path('public/js'),
            $this->getPublishesPath('public/css') => base_path('public/css'),
            $this->getPublishesPath('public/img') => base_path('public/img'),
            ],
            ['public',  'sitec', 'sitec-public', 'siravel', 'siravel-public']
        );

        $this->publishes(
            [
            $this->getPublishesPath('resources/tools') => base_path('resources/tools'),
            ],
            ['tools',  'sitec', 'sitec-tools', 'siravel', 'siravel-tools']
        );

        $this->publishes(
            [
            $this->getResourcesPath('views') => base_path('resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'siravel'),
            ],
            ['views',  'sitec', 'sitec-views', 'siravel', 'siravel-views']
        );


        /**
         * Siravel; Routes
         */
        $this->loadRoutesForRiCa(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'routes');


        Config::set(
            'connections.connections.system',
            [
                'driver' => env('TENANCY_CONNECTION', 'mysql'),
                'host' => env('TENANCY_HOST', 'db'),
                'port' => env('TENANCY_PORT', '3306'),
                'database' => env('TENANCY_DATABASE', 'rica'),
                'username' => env('TENANCY_USERNAME', 'root'),
                'password' => env('TENANCY_PASSWORD', 'A123456'),
                'unix_socket' => env('DB_SOCKET', ''),
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'strict' => true,
                'engine' => null,
            ]
        );
    }

    /**
     * Register the services.
     */
    public function register()
    {
        // Register external packages
        $this->setProviders();
        
        // Register Migrations
        $this->loadMigrationsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'migrations');

        // View namespace
        $viewsPath = $this->getResourcesPath('views');
        $this->loadViewsFrom($viewsPath, 'siravel');
        $this->publishes(
            [
            $viewsPath => base_path('resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'siravel'),
            ],
            'views'
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
