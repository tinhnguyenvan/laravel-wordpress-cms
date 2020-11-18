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

// CONSOLE
mix.styles([
  "public/console/css/coreui-icons.min.css",
  "public/console/css/flag-icon.min.css",
  "public/console/css/font-awesome.min.css",
  "public/console/css/simple-line-icons.css",
  "public/console/css/pace.min.css",
  "public/console/css/style.css",
  "public/console/css/bootstrap-tagsinput.css",
  "public/console/css/toastr.min.css",
  "public/console/css/easy-autocomplete.min.css",
  "public/console/css/custom.css",
], 'public/console/vendor/vendor.css');
