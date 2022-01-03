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

mix.combine([
                'resources/js/jquery-2.2.0.min.js',
                'resources/js/jpanelmenu.min.js',
                'resources/js/chosen.min.js',
                'resources/js/slick.min.js',
                'resources/js/rangeslider.min.js',
                'resources/js/magnific-popup.min.js',
                'resources/js/waypoints.min.js',
                'resources/js/counterup.min.js',
                'resources/js/jquery-ui.min.js',
                'resources/js/tooltips.min.js',
                'resources/js/color_switcher.js',
                'resources/js/jquery.validate.min.js',
                'resources/js/jquery_custom.js',
                'resources/js/custom.js',
                'resources/js/venues.js',
                'resources/js/jquery.jpanelmenu.js',
                'resources/js/leaflet.js',
            ],
        'public/js/all.js');

mix.combine([
    'resources/css/icons.css',
    'resources/css/bootstrap-grid.css',
    'resources/css/stylesheet.css',
    'resources/css/revolutionslider.css',
    'resources/css/style.css',
    'resources/css/custom.css',
], 'public/css/all.css')
