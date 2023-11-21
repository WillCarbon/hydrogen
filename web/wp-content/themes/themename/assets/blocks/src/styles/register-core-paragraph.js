import { registerBlockStyle } from '@wordpress/blocks';
// eslint-disable-next-line import/default
import domReady from '@wordpress/dom-ready';

domReady( function() {
    registerBlockStyle( 'core/paragraph', {
        name: 'lead-paragraph',
        label: 'Lead paragraph',
    } );
} );
