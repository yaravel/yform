<?php namespace Yaravel\Dscloud;

use Illuminate\Support\ServiceProvider;

class DscloudServiceProvider extends ServiceProvider {

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
		$this->package('yaravel/dscloud');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app->bind('Dsform', function()
        {
            return new \Yaravel\Dscloud\Dsform;
        });
        $this->app->bind('Dsurl', function()
        {
            return new \Yaravel\Dscloud\Dsurl;
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('dscloud');
	}

}
