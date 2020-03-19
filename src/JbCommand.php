<?php

namespace AdminOneLaravelDashboard\Package;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class JbCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jb:admin-one-preset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install JustBoil Admin One dashboard preset';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        AdminOnePreset::install();

        $this->copyFiles('app');
        $this->copyFiles('app/Http/Controllers');
        $this->copyFiles('app/Http/Requests');
        $this->copyFiles('app/Processors');
        $this->copyFiles('database/factories');
        $this->copyFiles('database/migrations');
        $this->copyFiles('database/seeds');
        $this->copyFiles('resources/images');
        $this->copyFiles('resources/js');
        $this->copyFiles('resources/js/components');
        $this->copyFiles('resources/js/components/Charts');
        $this->copyFiles('resources/js/views');
        $this->copyFiles('resources/js/views/Clients');
        $this->copyFiles('resources/sass');
        $this->copyFiles('resources/sass/libs');
        $this->copyFiles('resources/views');
        $this->copyFiles('resources/views/auth');
        $this->copyFiles('resources/views/auth/passwords');
        $this->copyFiles('resources/views/components');
        $this->copyFiles('resources/views/layouts');
        $this->copyFiles('routes');

        $this->copyFile('.editorconfig');
        $this->copyFile('webpack.mix.js');

        $this->info('Admin One installed successfully.');
        $this->comment('Please run "npm install && npm run dev" to compile your fresh scaffolding.');
    }

    protected function copyFiles($subDirectory = '', $only = null) {
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
                $this->info('File [' . $subDirectory . '/' . $targetFilename . '] already exists');
                $this->info('Feel free to overwrite on new installs');

                if ( $this->confirm( 'Overwrite?' ) ) {
                    $filesystem->copy($res_file->getRealPath(), $targetFullPath);
                } else {
                    $this->line('Skipped');
                }
            } else {
                $filesystem->copy($res_file->getRealPath(), $targetFullPath);
            }
        }
    }

    protected function copyFile($file) {
        $filesystem = new Filesystem;
        $targetFullPath = base_path($file);

        if ($filesystem->exists($targetFullPath)) {
            $this->info('File [' . $file . '] already exists');
            $this->info('Feel free to overwrite on new installs');

            if ( $this->confirm( 'Overwrite?' ) ) {
                $filesystem->copy(__DIR__ . '/stubs/' . $file, $targetFullPath);
            } else {
                $this->line('Skipped');
            }
        } else {
            $filesystem->copy(__DIR__ . '/stubs/' . $file, $targetFullPath);
        }
    }
}
