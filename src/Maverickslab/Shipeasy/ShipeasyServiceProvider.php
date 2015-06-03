<?php namespace Maverickslab\Shipeasy;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class ShipeasyServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		// publish configuration files
		$this->publishes([
			__DIR__."/../../config/config.php" => config_path('shippingeasy.php'),
		]);

		//Set up an alias
		AliasLoader::getInstance()->alias('Shipeasy', 'Maverickslab\Shipeasy\Shipeasy');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}

}
