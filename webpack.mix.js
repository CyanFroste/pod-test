const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js").vue();
mix.sass("resources/scss/main.scss", "public/css");
