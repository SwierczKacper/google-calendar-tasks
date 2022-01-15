const mix = require('laravel-mix');

if (mix.inProduction()) {
    mix.version();
}

mix.disableNotifications();
mix.setPublicPath('public/assets'); //dest output directory

const user = mix;
user.setResourceRoot('../'); //paths for urls in css

user.js('resources/js/app.js', 'public/assets/js').postCss('resources/css/app.css', 'public/assets/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);

user.sourceMaps();

