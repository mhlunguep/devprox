// webpack.mix.js

let mix = require('laravel-mix');

mix.setPublicPath('public')
.sass('resources/assets/scss/app.scss', 'css/style.css')
.js('resources/assets/js/app.js', 'js/script.js')

mix.webpackConfig({ stats: { children: true, }, });
