let mix = require('laravel-mix');

mix.js('resources/assets/js/project/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .browserSync('http://laravel-vue-example.local/');
