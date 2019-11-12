<?php


namespace AdminOneLaravelDashboard\Package;

use Illuminate\Support\Arr;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\Presets\Preset;


class AdminOnePreset extends Preset
{
	public static function install()
	{
		static::updatePackages();
		static::removeNodeModules();
	}

	/**
	 * Update the given package array.
	 *
	 * @param  array  $packages
	 * @return array
	 */
	protected static function updatePackageArray(array $packages)
	{
		return [
			'@mdi/font' => '^4.5.95',
			'buefy' => '^0.8.6',
			'bulma' => '^0.7.5',
			'chart.js' => '^2.9.2',
			'laravel-mix-alias' => '^1.0.2',
			'moment' => '^2.24.0',
			'numeral' => '^2.0.6',
			'vue-chartjs' => '^3.5.0',
			'vue-router' => '3.1.3',
			'vuex' => '^3.1.2',
			'vue' => '^2.6.10'
       ] + Arr::except($packages, ['bootstrap','jquery','popper.js']);
	}
}
