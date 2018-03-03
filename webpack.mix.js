let mix = require('laravel-mix');

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

//Admin files
mix.js('resources/assets/js/Admin/app.js', 'public/js/Admin')
    .sass('resources/assets/sass/Admin/app.scss', 'public/css/Admin');
    //.extract(['vue', 'jquery', 'bootstrap', 'axios', 'lodash']);

//user files
mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');
