// webpack.mix.js

let mix = require('laravel-mix');

mix.setPublicPath('public')
.sass('resources/assets/scss/app.scss', 'css/style.css')
.sass('resources/assets/js/app.js', 'css/script.js')

mix.webpackConfig({ stats: { children: true, }, });
