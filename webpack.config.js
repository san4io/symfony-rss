// webpack.config.js
var Encore = require('@symfony/webpack-encore');
var webpack = require('webpack');

Encore
// directory where all compiled assets will be stored
    .setOutputPath('web/build/')

    // what's the public path to this directory (relative to your project's document root dir)
    .setPublicPath('/build')

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    // will output as web/build/app.js
    .addEntry('app', './assets/js/main.js')

    // will output as web/build/global.css
    .addStyleEntry('global', './assets/css/global.scss')

    // allow sass/scss files to be processed
    .enableSassLoader()

    // allow legacy applications to use $/jQuery as a global variable
    .autoProvidejQuery()

    .addPlugin(new webpack.ProvidePlugin({
        $: 'jquery',
        jQuery: 'jquery',
        'window.jQuery': 'jquery',
        Popper: ['popper.js', 'default'],
        // In case you imported plugins individually, you must also require them here:
        Util: "exports-loader?Util!bootstrap/js/dist/util",
        Dropdown: "exports-loader?Dropdown!bootstrap/js/dist/dropdown"
    }))

    .enableSourceMaps(!Encore.isProduction())

// create hashed filenames (e.g. app.abc123.css)
    .enableVersioning()
;

// export the final configuration
module.exports = Encore.getWebpackConfig();