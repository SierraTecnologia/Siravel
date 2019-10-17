<?php

namespace Siravel\Providers;

use Illuminate\Support\ServiceProvider;

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
	public function register() {

		$this->app->bind('GravatarService', 'Siravel\Services\GravatarService');

		/**
		 * Adicionei separado do de cima
		 */
        $this->app->singleton('gravatar', function ($app) {
            return new Gravatar($this->app['config']);
        });

	}

}