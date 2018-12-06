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

// theadmin
mix
   .sass('resources/views/theadmin/sass/app.scss', 'public/theadmin/css')
   .scripts('resources/views/theadmin/js/src/assets/**/*.js','public/theadmin/js/app.js')
   .js('resources/views/theadmin/js/script.js','public/theadmin/js/script.js');
   