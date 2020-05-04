const mix = require('laravel-mix');

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

mix.setPublicPath('public');
mix.js('resources/js/app.js', 'js');
mix.sass('resources/sass/app.scss', 'css');


mix.scripts([
    'public/vendor/jquery/jquery.min.js',
    'public/vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
    'resources/js/global.js',
    'node_modules/axios/dist/axios.min.js'
 ], 'public/js/scripts.js');
