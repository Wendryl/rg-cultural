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
  .postCss('resources/css/user-dashboard/index.css', 'public/css/user-dashboard');;

mix.js('resources/js/user-dashboard/profile-setup', 'public/js/user-dashboard')
  .postCss('resources/css/user-dashboard/profile-setup.css', 'public/css/user-dashboard');

mix.js('resources/js/admin-dashboard/index', 'public/js/admin-dashboard')
  .postCss('resources/css/admin-dashboard/index.css', 'public/css/admin-dashboard');

mix.js('resources/js/admin-dashboard/new-user', 'public/js/admin-dashboard')
  .postCss('resources/css/admin-dashboard/new-user.css', 'public/css/admin-dashboard');

mix.js('resources/js/admin-dashboard/new-post', 'public/js/admin-dashboard');

mix.js('resources/js/admin-dashboard/edit-user', 'public/js/admin-dashboard');
