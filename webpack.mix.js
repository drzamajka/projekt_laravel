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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/gatunki.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/form.scss', 'public/css')
    .sass('resources/sass/gatunki.scss', 'public/css')
    .js('resources/js/gwiazdy.js', 'public/js')
    .sass('resources/sass/filmy.scss', 'public/css')
    .js('resources/js/filmy.js', 'public/js')
    .sass('resources/sass/gwiazdy.scss', 'public/css')
    .js('resources/js/film.js', 'public/js')
    .sass('resources/sass/film.scss', 'public/css')
    .copy('resources/views/vendor/datatables/i18n/pl.json', 'public/vendor/datatables/i18n')
    .copy('vendor/proengsoft/laravel-jsvalidation/resources/views', 'resources/views/vendor/jsvalidation')
    .copy('vendor/proengsoft/laravel-jsvalidation/public', 'resources/js/vendor/jsvalidation')
    .sourceMaps()
    .extract();
