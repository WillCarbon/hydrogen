import { registerBlockVariation } from '@wordpress/blocks';
// eslint-disable-next-line import/default
import domReady from '@wordpress/dom-ready';

domReady( function() {
    registerBlockVariation(
        'core/media-text',
        {
            name: 'media-text-img-left',
            title: 'Media & Text (Image left)',
            scope: 'block',
            attributes: {
                align: 'wide',
                mediaPosition: 'left',
                backgroundColor: 'bravo',
            },
            innerBlocks: [
                [
                    'core/heading',
                    {
                        level: 2,
                        placeholder: 'Heading',
                    },
                ],
                [
                    'core/paragraph',
                    {
                        placeholder: 'Enter content here...',
                    },
                ],
            ],
        }
    );

    registerBlockVariation(
        'core/media-text',
        {
            name: 'media-text-img-right',
            title: 'Media & Text (Image right)',
            scope: 'block',
            attributes: {
                align: 'wide',
                mediaPosition: 'right',
            },
            innerBlocks: [
                [
                    'core/heading',
                    {
                        level: 2,
                        placeholder: 'Heading',
                    },
                ],
                [
                    'core/paragraph',
                    {
                        placeholder: 'Enter content here...',
                    },
                ],
            ],
        }
    );
} );
