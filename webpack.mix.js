const mix = require('laravel-mix');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/main.js', 'public/js');
mix.js('resources/js/purecounter/purecounter_vanilla.js', 'public/js/purecounter');
mix.js('resources/js/helper/modal.js', 'public/js/helper');
mix.js('resources/js/helper/photo.js', 'public/js/helper');

mix.postCss('resources/css/main.css', 'public/css');