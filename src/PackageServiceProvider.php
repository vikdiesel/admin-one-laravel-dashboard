<?php


namespace AdminOneLaravelDashboard\Package;

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
			$this->copyFiles($command, 'resources/views');
			$this->copyFiles($command, 'resources/views/auth');
			$this->copyFiles($command, 'resources/views/auth/passwords');
			$this->copyFiles($command, 'resources/views/components');
			$this->copyFiles($command, 'resources/views/layouts');
			$this->copyFiles($command, 'routes');

			$this->copyFile($command, '.editorconfig');
			$this->copyFile($command, 'webpack.mix.js');

			$command->info('Admin One installed successfully.');
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
			$targetFilename = $res_file->getFilename();
			$stubExtPos = strrpos($targetFilename, '.stub');

			if ($stubExtPos !== false) {
				$targetFilename = substr($targetFilename, 0, $stubExtPos) . '.php';
			}

			$targetFullPath = base_path($subDirectory . '/' . $targetFilename);

			if ($filesystem->exists($targetFullPath)) {
				$command->info('File [' . $subDirectory . '/' . $targetFilename . '] already exists');
				$command->info('Feel free to overwrite on new installs');

				if ( $command->confirm( 'Overwrite?' ) ) {
					$filesystem->copy($res_file->getRealPath(), $targetFullPath);
				} else {
					$command->line('Skipped');
				}
			} else {
				$filesystem->copy($res_file->getRealPath(), $targetFullPath);
			}
		}
	}

	protected function copyFile($command, $file) {
		$filesystem = new Filesystem;
		$targetFullPath = base_path($file);

		if ($filesystem->exists($targetFullPath)) {
			$command->info('File [' . $file . '] already exists');
			$command->info('Feel free to overwrite on new installs');

			if ( $command->confirm( 'Overwrite?' ) ) {
				$filesystem->copy(__DIR__ . '/stubs/' . $file, $targetFullPath);
			} else {
				$command->line('Skipped');
			}
		} else {
			$filesystem->copy(__DIR__ . '/stubs/' . $file, $targetFullPath);
		}
	}
}
