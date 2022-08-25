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

mix.styles('resources/css/*', 'public/css/app.css')
  .postCss('resources/css/user-dashboard/index.css', 'public/css/user-dashboard');

mix.js('resources/js/user-dashboard/complete-registration', 'public/js')
  .postCss('resources/css/user-dashboard/complete-registration.css', 'public/css/user-dashboard')
  .postCss('resources/css/admin-dashboard/index.css', 'public/css/admin-dashboard');
