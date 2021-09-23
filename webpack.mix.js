const mix = require("laravel-mix");

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

//  mix.js('resources/js/app.js', 'public/js')
//  .autoload({
//      "jquery": ['$', 'jquery', 'jQuery', 'window.jquery'],
//      "popper.js": ["Popper.js"]
//  }).sourceMaps()
//  .extract()
//  .js('resources/js/admin.js', 'public/js')
//  .js('resources/js/main.js', 'public/js')
//  .postCss('resources/css/admin.css', 'public/css')
//  .postCss('resources/css/main.css', 'public/css')
//  .postCss('resources/css/app.css', 'public/css');
mix.styles(
    [
        "public/assets/front/css/bootstrap.min.css",
        "public/assets/front/fontawesome/css/all.css",
        "public/assets/front/css/owl.carousel.min.css",
        "public/assets/front/css/owl.theme.default.min.css",
        "public/assets/front/css/metisMenu.min.css",
        "public/assets/front/css/jquery.jConveyorTicker.min.css",
        "public/assets/front/css/style.css",
        "public/assets/front/css/aos.css",
        "public/assets/front/css/responsive.css",
    ],
    "public/assets/front/css/front.css"
);