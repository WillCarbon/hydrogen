import { registerBlockStyle } from '@wordpress/blocks';
// eslint-disable-next-line import/default
import domReady from '@wordpress/dom-ready';

domReady( function() {
    registerBlockStyle( 'carbonberg/text', {
        name: 'centered',
        label: 'Centered',
    } );
} );
