import { unregisterBlockStyle } from '@wordpress/blocks';
import domReady from '@wordpress/dom-ready';

domReady( function() {
    unregisterBlockStyle( 'core/button', 'outline' );
} );
