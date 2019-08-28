const mix = require('laravel-mix');

/* Laravel Mix Alias (allows to use vue-cli style paths in components `@/` */
require('laravel-mix-alias');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
  .alias({
    '@': '/resources/js',
    '@/components': '/resources/js/components',
  })
  .js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')
  .styles([
    'node_modules/@mdi/font/css/materialdesignicons.css',
  ], 'public/css/vendor.css')
  .copyDirectory('node_modules/@mdi/font/fonts', 'public/fonts')
  .copyDirectory('resources/images', 'public/images')
  .version();
