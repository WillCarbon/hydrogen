import { registerBlockStyle } from '@wordpress/blocks';
import domReady from '@wordpress/dom-ready';

domReady( function() {
    registerBlockStyle( 'carbonberg/text', {
        name: 'centered',
        label: 'Centered',
    } );
} );
