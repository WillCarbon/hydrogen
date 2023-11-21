import { unregisterBlockVariation } from '@wordpress/blocks';
// eslint-disable-next-line import/default
import domReady from '@wordpress/dom-ready';

domReady( function() {
    unregisterBlockVariation( 'core/columns', 'one-column-full' );
    unregisterBlockVariation( 'core/columns', 'two-columns-one-third-two-thirds' );
    unregisterBlockVariation( 'core/columns', 'two-columns-two-thirds-one-third' );
    unregisterBlockVariation( 'core/columns', 'three-columns-wider-center' );
} );
