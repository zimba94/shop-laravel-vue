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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');

mix.styles([
        'resources/assets/template/css/animate.min.css',
        'resources/assets/template/css/bootstrap-3.1.1.min.css',
        'resources/assets/template/css/flexslider.css',
        'resources/assets/template/css/popuo-box.css',
        'resources/assets/template/css/simple-line-icons.min.css',
        'resources/assets/template/css/style.css'
    ], 'public/css/template.css')
    .scripts([
        'resources/assets/template/js/jquery.min.js',
        'resources/assets/template/js/bootstrap.min.js',
        'resources/assets/template/js/imagezoom.js',
        'resources/assets/template/js/jquery.flexslider.js',
        'resources/assets/template/js/jquery.magnific-popup.js',
        'resources/assets/template/js/memenu.js',
        'resources/assets/template/js/responsiveslides.js',
        'resources/assets/template/js/simpleCart.js',
        'resources/assets/template/js/wow.min.js',
        'resources/assets/template/js/sweetalert2.all.min.js'
    ], 'public/js/template.js')
    .js(['resources/js/app.js'], 'public/js/app.js');