<?php

namespace Siravel\Providers;

use App;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Siravel\Services\Gravatar;

class GravatarServiceProvider extends ServiceProvider
{

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->setupConfig();
    }
    /**
     * Setup the config.
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../Publishes/config/gravatar.php');
        $this->publishes([$source => config_path('gravatar.php')]);
        $this->mergeConfigFrom($source, 'gravatar');
	}
	
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
    public function register()
    {

        $loader = AliasLoader::getInstance();
        $loader->alias('Gravatar', \Siravel\Facades\Gravatar::class);
		$this->app->bind('Gravatar', 'Siravel\Facades\Gravatar');
		/**
		 * Adicionei separado do de cima
		 */
        $this->app->singleton('Gravatar', function ($app) {
            return new Gravatar($this->app['config']);
        });
	}

}