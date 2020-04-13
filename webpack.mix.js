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
    'public/vendor/bootstrap/js/bootstrap.bundle.min.js',
    'public/vendor/bootstrap/js/bootstrap.min.js',
    // 'public/vendor/popper/popper.js',
//     'public/vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js',
//     'resources/assets/popperJs/umd/popper.min.js',
//     'resources/assets/bootstrap/bootstrap.min.js',
//     'resources/assets/select2/select2.min.js',
//     'resources/assets/select2/i18n/pl.js',
//     'resources/assets/datatables/pdfmake.min.js',
//     'resources/assets/datatables/vfs_fonts.js',
//     'resources/assets/datatables/datatables.min.js',
//     'resources/assets/sweetalert/sweetalert2@8.js',
//     'public/vendor/adminlte/dist/js/adminlte.min.js',
//     'resources/js/app.js',
//     'resources/assets/jqueryUI/jquery-ui.min.js',
//     'resources/assets/daterangepicker/moment.min.js',
//     'resources/assets/daterangepicker/daterangepicker.js',
//     'resources/js/daterangepicker_mod.js',
 ], 'public/js/scripts.js');
