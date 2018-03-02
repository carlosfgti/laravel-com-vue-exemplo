let mix = require('laravel-mix');

mix.js('resources/assets/js/admin/app.js', 'public/js/admin.js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.js('resources/assets/js/frontend/app.js', 'public/js/site.js');
