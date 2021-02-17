const mix = require('laravel-mix')
const path = require('path')

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
    '@': path.join(__dirname, 'resources/js')
  })
  .js('resources/js/app.js', 'public/js').vue()
  .sass('resources/sass/app.scss', 'public/css')
  .styles([
    'node_modules/@mdi/font/css/materialdesignicons.css'
  ], 'public/css/vendor.css')
  .copyDirectory('node_modules/@mdi/font/fonts', 'public/fonts')
  .copyDirectory('resources/images', 'public/images')
  .version()
