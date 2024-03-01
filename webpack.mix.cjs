const mix = require('laravel-mix');

// Compile CSS with Tailwind CSS
mix.postCss('resources/css/app.css', 'public/css', [
    require('tailwindcss'),
]);

// Compile JavaScript (if needed)
// mix.js('resources/js/app.js', 'public/js');

// BrowserSync for live reloading
mix.browserSync('127.0.0.1:8000');
