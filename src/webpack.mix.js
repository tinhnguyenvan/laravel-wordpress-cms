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
    "public/layout/classified/css/bootstrap.min.css",
    "public/layout/classified/css/normalize.css",
    "public/layout/classified/css/font-awesome.min.css",
    "public/layout/classified/css/icomoon.css",
    "public/layout/classified/css/transitions.css",
    "public/layout/classified/css/flags.css",
    "public/layout/classified/css/owl.carousel.css",
    "public/layout/classified/css/prettyPhoto.css",
    "public/layout/classified/css/jquery-ui.css",
    "public/layout/classified/css/scrollbar.css",
    "public/layout/classified/css/chartist.css",
    "public/layout/classified/css/main.css",
    "public/layout/classified/css/color.css",
    "public/layout/classified/css/responsive.css",
    "public/common/plugin/select2/css/select2.min.css",
    "public/common/plugin/select2/css/select2-bootstrap4.min.css",
], "public/layout/classified/vendor/app.css");

mix.scripts([
    "public/layout/classified/js/modernizr-2.8.3-respond-1.4.2.min.js",
    "public/layout/classified/js/jquery-library.js",
    "public/layout/classified/js/bootstrap.min.js",
    "public/layout/classified/js/clipboard.min.js",
    "public/layout/classified/js/jquery.flagstrap.min.js",
    "public/layout/classified/js/backgroundstretch.js",
    "public/layout/classified/js/owl.carousel.min.js",
    "public/layout/classified/js/jquery.vide.min.js",
    "public/layout/classified/js/jquery.collapse.js",
    "public/layout/classified/js/prettyPhoto.js",
    "public/layout/classified/js/jquery-ui.js",
    "public/layout/classified/js/countTo.js",
    "public/layout/classified/js/appear.js",
    "public/layout/classified/js/gmap3.js",
    "public/layout/classified/js/jquery-scrolltofixed-min.js",
    "public/layout/classified/js/main.js",
    "public/common/plugin/select2/js/select2.full.min.js",
], "public/layout/classified/vendor/app.js");
