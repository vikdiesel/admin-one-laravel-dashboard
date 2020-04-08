<?php


namespace AdminOneLaravelDashboard\Package;

use Illuminate\Support\ServiceProvider;

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
