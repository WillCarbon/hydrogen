/**
 * External Dependencies
 */
const path = require( 'path' );

/**
 * WordPress Dependencies
 */
const defaultConfig = require( '@wordpress/scripts/config/webpack.config.js' );

module.exports = {
    ...defaultConfig,
    ...{
        entry: {
            css_main: path.resolve( process.cwd(), 'styles/src', 'main.scss' ),
            css_editor: path.resolve( process.cwd(), 'styles/src', 'editor.scss' ),
            js_main: path.resolve( process.cwd(), 'js/src', 'main.js' ),
            js_carbonblocks: path.resolve( process.cwd(), 'js/src', 'carbonblocks.js' ),
        },
        output: {
            filename: '[name].js',
            path: __dirname + '/build',
        },
    },
    plugins: [ ...defaultConfig.plugins ],
};
