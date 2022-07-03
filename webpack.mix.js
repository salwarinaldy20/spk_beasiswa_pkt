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

 mix.styles([
    'resources/assets/css/fontsbody.css',
    'resources/assets/css/radiobox.css',
    'resources/assets/plugins/global/plugins.bundle.css',
    'resources/assets/css/style.bundle.css',   

    'resources/assets/plugins/custom/datatable/datatable.css',

    'resources/assets/plugins/custom/animate-css/animate.min.css',  
    'resources/assets/plugins/custom/loading-animate/loading.min.css',
    'resources/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css',
    'resources/assets/plugins/custom/waitme/waitMe.min.css', 
    'resources/assets/plugins/custom/datetimematerial/css/bootstrap-material-datetimepicker.css', 
    ], 'public/css/pkgmgr.css')
    .copy('resources/assets/plugins/custom/jbvalidator/langjbvalidator.json', 'public/js/langjbvalidator.json')
    .copyDirectory('resources/assets/plugins/global/fonts', 'public/css/fonts')
    .copyDirectory('resources/assets/media', 'public/assets/media')
    .copyDirectory('resources/assets/css/fontsbody', 'public/css/fonts');





mix.scripts([
    //'resources/assets/plugins/custom/jquery/jquery.min.js',
    'resources/assets/plugins/global/plugins.bundle.js', 
    'resources/assets/js/scripts.bundle.js',
    'resources/assets/js/custom/widgets.js',

    'resources/assets/plugins/custom/datatable/datatablepdfmake.js', 
    'resources/assets/plugins/custom/datatable/pdfmakefonts.js', 
    'resources/assets/plugins/custom/datatable/datatable.js', 

    'resources/assets/plugins/custom/animate-css/animate.min.js',  
    'resources/assets/plugins/custom/simple-money-format/simple.money.format.js', 
    'resources/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js', 
    'resources/assets/plugins/custom/jbvalidator/jbvalidator.js', 
    'resources/assets/plugins/custom/lottie/lottie.js', 
    'resources/assets/plugins/custom/waitme/waitMe.min.js',  
    'resources/assets/plugins/custom/datetimematerial/js/bootstrap-material-datetimepicker.js', 
    'resources/js/libfunc.js', 
    ],
'public/js/pkgmgr.js').version();