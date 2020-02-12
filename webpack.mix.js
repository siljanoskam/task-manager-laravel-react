const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, ±fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

/**
 * Compile SASS
 */
mix.sass('resources/sass/app.scss', 'public/css');

mix.react('resources/js/app.js', 'public/js');

if (mix.inProduction()) {
  mix.disableNotifications();
  mix.version();
  return;
}

mix.webpackConfig({
  devtool: 'source-map',
});
