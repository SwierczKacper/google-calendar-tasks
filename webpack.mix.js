const mix = require('laravel-mix');
const tailwindcss = require("tailwindcss");
const autoprefixer = require("autoprefixer");

mix.disableNotifications();
mix.setPublicPath('public/assets'); //dest output directory

const user = mix;
user.setResourceRoot('../'); //paths for urls in css

user.js('resources/js/app.js', 'public/assets/js');

user.sass('resources/scss/app.scss', 'public/assets/css').options({
    postCss: [ tailwindcss('./tailwind.config.js'), autoprefixer() ],
});

user.version().sourceMaps();

