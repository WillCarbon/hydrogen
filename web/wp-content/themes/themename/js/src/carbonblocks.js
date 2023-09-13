/* eslint-disable */
import { __ } from '@wordpress/i18n';
import domReady from '@wordpress/dom-ready';
import { registerBlockStyle, unregisterBlockStyle, unregisterBlockVariation } from '@wordpress/blocks';

import './blocks/types/carbon-image-text';
import './blocks/types/carbon-text';
// import './blocks/variations/media-text-img-left';
// import './blocks/variations/media-text-img-right';

domReady(() => {
    unregisterBlockStyle('core/image', 'rounded');
    unregisterBlockStyle('core/button', 'outline');

    unregisterBlockVariation('core/columns', 'one-column-full');
    unregisterBlockVariation('core/columns', 'two-columns-one-third-two-thirds');
    unregisterBlockVariation('core/columns', 'two-columns-two-thirds-one-third');
    unregisterBlockVariation('core/columns', 'three-columns-wider-center');
    
    registerBlockStyle( 'carbon/media-text', {
        name: 'img-right',
        label: 'Image to the right'
    } );
})

/* eslint-enable */
