<?php


namespace AdminOneLaravelDashboard\Package;

use Illuminate\Support\Arr;

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
			'@mdi/font' => '^4.9.95',
			'buefy' => '^0.9.4',
			'bulma' => '^0.9.2',
			'chart.js' => '^2.9.4',
			'dayjs' => '^1.10.4',
			'sass-loader' => '^11.0.1',
			'sass' => '^1.32.7',
			'numeral' => '^2.0.6',
			'vue-chartjs' => '^3.5.0',
			'vue-router' => '^3.5.1',
			'vuex' => '^3.6.2',
			'vue' => '^2.6.12'
       ] + Arr::except($packages, ['bootstrap','jquery','popper.js']);
	}
}
