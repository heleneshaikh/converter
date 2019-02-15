module.exports = {
    plugins: {
        'postcss-preset-env': {
            browsers: 'last 2 versions', //set to key from package.json
            autoprefixer: {grid: true, flexbox: 'no-2009'},
            stage: 3,
            features: {
                'custom-media-queries':true,
                'custom-properties': true,
                'custom-selectors': true
            }
        }
    }
};