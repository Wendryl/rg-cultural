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
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

mix.styles('resources/css/*', 'public/css/app.css');
mix.js('resources/js/login', 'public/js');
mix.js('resources/js/register', 'public/js');
mix.js('resources/js/home', 'public/js')
  .postCss('resources/css/admin/main.css', 'public/css/admin');

mix.js('resources/js/complete-registration', 'public/js')
  .postCss('resources/css/admin/complete-registration.css', 'public/css/admin');
