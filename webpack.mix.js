const cssImport = require('postcss-import');
const cssNesting = require('postcss-nesting');
const mix = require('laravel-mix');
const path = require('path');
const tailwindcss = require('tailwindcss');
const glob = require('glob-all');
const PurgecssPlugin = require('purgecss-webpack-plugin');

class TailwindExtractor {
    static extract (content) {
        return content.match(/[A-Za-z0-9-_:/]+/g) || [];
    }
}

mix.js('resources/js/main.js', 'public/js')
    .postCss('resources/css/main.css', 'public/css', [
        cssImport(),
        cssNesting(),
        tailwindcss('tailwind.config.js'),
    ])
    .webpackConfig({
        output: { chunkFilename: 'js/[name].js?id=[chunkhash]' },
        resolve: {
            alias: {
                'vue$': 'vue/dist/vue.runtime.js',
                '@': path.resolve('resources/js'),
                JS: path.resolve(__dirname, 'resources/js'),
                Utils: path.resolve(__dirname, 'resources/js/Utils'),
                Pages: path.resolve(__dirname, 'resources/js/Pages'),
                Shared: path.resolve(__dirname, 'resources/js/Shared'),
                Libraries: path.resolve(__dirname, 'resources/js/lib'),
                Models: path.resolve(__dirname, 'resources/js/models'),
                Config: path.resolve(__dirname, 'resources/js/config'),
                Events: path.resolve(__dirname, 'resources/js/events'),
                Mixins: path.resolve(__dirname, 'resources/js/mixins'),
            },
        },
    })
    .babelConfig({
        plugins: ['@babel/plugin-syntax-dynamic-import'],
    })
    .version()
    .sourceMaps();

if (mix.inProduction()) {
    mix.webpackConfig({
        plugins: [
            new PurgecssPlugin({

                // Specify the locations of any files you want to scan for class names.
                paths: glob.sync([
                    path.join(__dirname, 'resources/views/**/*.blade.php'),
                    path.join(__dirname, 'resources/js/**/*.vue')
                ]),
                whitelistPatterns: [/^attachment/, /^v--/, /^nprogress/, /^spinner/, /^peg/, /^bar/],
                extractors: [
                    {
                        extractor: TailwindExtractor,

                        // Specify the file extensions to include when scanning for
                        // class names.
                        extensions: ['html', 'js', 'php', 'vue'],
                    },
                ],
            }),
        ],
    });
}
