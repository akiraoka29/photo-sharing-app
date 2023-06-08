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

// Set Module Auto Load
const moduleAutoLoad = {
    jquery: ['$', 'window.jQuery', 'jQuery'],
    bootstrap: ['Bootstrap', 'window.Bootstrap'],
    '@popperjs/core': ['Popper', 'window.Popper'],
    './modal': ['js/module/modal.js']
}

mix.js('resources/js/main.js', 'public/js');
mix.js('resources/js/purecounter/purecounter_vanilla.js', 'public/js/purecounter');
mix.js('resources/js/module/modal.js', 'public/js/module')
    .js('resources/js/module/photo.js', 'public/js/module')
    .autoload(moduleAutoLoad);

mix.postCss('resources/css/main.css', 'public/css');