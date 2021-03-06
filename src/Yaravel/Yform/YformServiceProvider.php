<?php namespace Yaravel\Yform;

use Illuminate\Support\ServiceProvider;

class YformServiceProvider extends ServiceProvider {

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
		$this->app->register('Yaravel\Yform\YformServiceProvider');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('Yform', function()
		{
			return new \Yaravel\Yform\Yform;
		});
		$this->app->bind('Yerrors', function()
		{
			return new \Yaravel\Yform\Yerrors;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['yform', 'yerrors'];
	}

}