const Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build')
    .setPublicPath('/build')
    .setManifestKeyPrefix('')
    .splitEntryChunks()
    .cleanupOutputBeforeBuild()
    .addStyleEntry('css/main', './public/assets/scss/main.scss')
    .addEntry('js/upload-validation', './public/assets/js/upload-validation.js')
    .addEntry('js/preload', './public/assets/js/libraries/preload.js')
    .addEntry('js/menu-toggle', './public/assets/js/menu-toggle.js')
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .enableReactPreset()
    .enableSassLoader()
    .enablePostCssLoader()
    .enableSingleRuntimeChunk()
;

module.exports = Encore.getWebpackConfig();
