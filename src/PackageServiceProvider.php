<?php


namespace LaravelBulmaAuthPreset\Package;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\PresetCommand;

class PackageServiceProvider extends ServiceProvider{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot() {
		PresetCommand::macro('admin-one', function ($command) {
			AdminOnePreset::install();

			$this->copyFiles($command, 'app');
			$this->copyFiles($command, 'app/Http/Controllers');
			$this->copyFiles($command, 'app/Http/Requests');
			$this->copyFiles($command, 'app/Processors');
			$this->copyFiles($command, 'database/factories');
			$this->copyFiles($command, 'database/migrations');
			$this->copyFiles($command, 'database/seeds');
			$this->copyFiles($command, 'resources/images');
			$this->copyFiles($command, 'resources/js');
			$this->copyFiles($command, 'resources/js/components');
			$this->copyFiles($command, 'resources/js/components/Charts');
			$this->copyFiles($command, 'resources/js/views');
			$this->copyFiles($command, 'resources/js/views/Clients');
			$this->copyFiles($command, 'resources/sass');
			$this->copyFiles($command, 'resources/sass/libs');
			$this->copyFiles($command, 'resources/views/auth');
			$this->copyFiles($command, 'resources/views/auth/passwords');
			$this->copyFiles($command, 'resources/views/components');
			$this->copyFiles($command, 'resources/views/layouts');
			$this->copyFiles($command, 'routes');

			$this->copyFile($command, '.editorconfig');
			$this->copyFile($command, 'webpack.mix.js');

			$command->info('Bulma scaffolding installed successfully.');
			$command->comment('Please run "npm install && npm run dev" to compile your fresh scaffolding.');
		});
	}

	protected function copyFiles($command, $subDirectory = '', $only = null) {
		$filesystem = new Filesystem;
		$filesystem->makeDirectory(base_path($subDirectory), 0755, true, true);

		$resFiles = $filesystem->files(__DIR__.'/stubs/' . $subDirectory);

		foreach ( $resFiles as $res_file ) {
			if (!empty($only)) {
				if (array_search($res_file->getFilename(), $only) === false) {
					continue;
				}
			}

			$filename = $subDirectory . '/' . $res_file->getFilename();

			$filesystem->copy($res_file->getRealPath(), base_path($filename));
		}
	}

	protected function copyFile($command, $file) {
		$filesystem = new Filesystem;
		$filesystem->copy(__DIR__ . '/stubs/' . $file, base_path($file));
	}
}
