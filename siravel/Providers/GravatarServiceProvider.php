<?php

namespace Siravel\Providers;

use Illuminate\Support\ServiceProvider;

class GravatarServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {

		$this->app->bind('GravatarService', 'Siravel\Services\GravatarService');

	}

}