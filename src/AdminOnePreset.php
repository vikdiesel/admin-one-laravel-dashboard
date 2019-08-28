<?php


namespace LaravelBulmaAuthPreset\Package;

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
			'@mdi/font' => '^3.9.97',
			'buefy' => '^0.8.2',
			'bulma' => '^0.7.5',
			'chart.js' => '^2.8.0',
			'laravel-mix-alias' => '^1.0.2',
			'moment' => '^2.24.0',
			'numeral' => '^2.0.6',
			'vue-chartjs' => '^3.4.2',
			'vue-router' => '3.1.2',
			'vuex' => '^3.0.1'
       ] + Arr::except($packages, ['bootstrap','jquery','popper.js']);
	}
}
