var Encore = require('@symfony/webpack-encore');

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if you JavaScript imports CSS.
     */
    .addEntry('app', [
        './node_modules/assets/vendor/jquery/dist/jquery.min.js',
        './node_modules/assets/vendor/jquery-ui/jquery-ui.min.js',
        './node_modules/assets/vendor/slimScroll/jquery.slimscroll.min.js',
        './node_modules/assets/vendor/bootstrap/dist/js/bootstrap.min.js',
        './node_modules/assets/vendor/metisMenu/dist/metisMenu.min.js',
        './node_modules/assets/vendor/iCheck/icheck.min.js',
        './node_modules/assets/vendor/sparkline/index.js',
        './node_modules/assets/vendor/datatables/media/js/jquery.dataTables.min.js',
        './node_modules/assets/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js',
        './assets/vendor/pdfmake/build/pdfmake.min.js',
        './node_modules/assets/vendor/datatables.net-buttons/js/buttons.html5.min.js',
        './node_modules/assets/vendor/datatables.net-buttons/js/buttons.print.min.js',
        './node_modules/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js',
        './node_modules/assets/vendor/datatables.net-buttons-bs/js/buttons.bootstrap.min.js',
        './node_modules/assets/scripts/homer.js',
        './node_modules/assets/js/app.js'

    ])

    .addStyleEntry('css/app', [
        './node_modules/assets/styles/style.css'
    ])



    // enables Sass/SCSS support
    //.enableSassLoader()

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you're having problems with a jQuery plugin
    //.autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
