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
            main: path.resolve( process.cwd(), 'styles/src', 'main.scss' ),
            carbonblocks: path.resolve( process.cwd(), 'js/src', 'carbonblocks.js' ),
        },
    },
    plugins: [ ...defaultConfig.plugins ],
};
