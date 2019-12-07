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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/bootstrap.js', 'public/js')
    .scripts([
        'resources/js/pages/home.js'
    ], 'public/js/all.js')
    .scripts([
        'resources/js/admin/admin.js'
    ], 'public/js/admin.js')
    .js('resources/js/admin/chart.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .styles([
        'resources/css/all.css',
        'resources/css/admin.css',
    ], 'public/css/custom.css')
