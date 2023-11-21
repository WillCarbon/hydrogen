import { unregisterBlockStyle } from '@wordpress/blocks';
// eslint-disable-next-line import/default
import domReady from '@wordpress/dom-ready';

domReady( function() {
    unregisterBlockStyle( 'core/image', 'rounded' );
} );
