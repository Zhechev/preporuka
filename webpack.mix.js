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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

// mix.combine([
//             'resources/js/jquery-3.4.1.min.js',
//             'resources/js/chosen.min.js',
//             'resources/js/slick.min.js',
//             'resources/js/rangeslider.min.js',
//             'resources/js/magnific-popup.min.js',
//             'resources/js/jquery-ui.min.js',
//             'resources/js/bootstrap-select.min.js',
//             'resources/js/mmenu.js',
//             'resources/js/tooltips.min.js',
//             'resources/js/jquery_custom.js',
//             'resources/js/typed.js',
//             'resources/js/datedropper.js',
//             'resources/js/daterangepicker.js',
//             'resources/js/isotope.min.js',
//             'resources/js/jquery.countdown.min.js',
//             'resources/js/jquery-migrate-3.3.2.min.js',
//             'resources/js/moment.min.js',
//             'resources/js/perfect-scrollbar.min.js',
//             'resources/js/dropzone.js',
//             // 'resources/js/show_venue.js',
//             'resources/js/venues.js',
//             'resources/js/custom.js',
//             ],
//         'public/js/all.js');

mix.combine([
    'resources/css/icons.css',
    'resources/css/bootstrap-grid.css',
    'resources/css/stylesheet.css',
    'resources/css/mmenu.css',
    'resources/css/revolutionslider.css',
    'resources/css/style.css',
    'resources/css/custom.css',
], 'public/css/all.css')
