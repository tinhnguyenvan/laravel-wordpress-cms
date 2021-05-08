const mix = require("laravel-mix");

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
    // common
    "public/common/plugin/select2/css/select2.min.css",
    "public/common/plugin/select2/css/select2-bootstrap4.min.css",
    "public/common/plugin/flatpickr/css/flatpickr.min.css",
    "public/common/plugin/summernote-0.8.18/summernote.css",
    // end common

    "public/console/css/custom.css",
], "public/console/vendor/app.css");

mix.scripts([
    "public/console/js/jquery.min.js",
    "public/console/js/coreui.min.js",
    "public/console/js/popper.min.js",
    "public/console/js/bootstrap.min.js",
    "public/console/js/jquery.easy-autocomplete.min.js",
    "public/console/js/bootstrap-tagsinput.js",
    "public/console/js/jquery-simple-tree-table.js",
    "public/console/js/pace.min.js",
    "public/console/js/perfect-scrollbar.min.js",

    // common
    "public/common/plugin/highcharts/highcharts.js",
    "public/common/plugin/highcharts/exporting.js",
    "public/common/plugin/select2/js/select2.full.min.js",
    "public/common/plugin/flatpickr/js/flatpickr.min.js",
    "public/common/plugin/summernote-0.8.18/summernote.js",
    //end common

    "public/console/js/jquery.pjax.js",
    "public/console/js/function.js",
    "public/console/js/clipboard.min.js",
    "public/console/js/jquery.cookie.js",
    "public/console/js/script.js",
], "public/console/vendor/app.js");
