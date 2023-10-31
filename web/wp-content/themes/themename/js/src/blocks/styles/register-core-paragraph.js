import { registerBlockStyle } from '@wordpress/blocks';
import domReady from '@wordpress/dom-ready';

domReady( function() {
    registerBlockStyle( 'core/paragraph', {
        name: 'lead-paragraph',
        label: 'Lead paragraph',
    } );
} );
