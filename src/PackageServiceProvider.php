<?php


namespace AdminOneLaravelDashboard\Package;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Illuminate\Filesystem\Filesystem;

class PackageServiceProvider extends ServiceProvider{
    /**
     * Register the package services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                JbCommand::class
            ]);
        }
    }

    /**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot() {
        //
	}
}
