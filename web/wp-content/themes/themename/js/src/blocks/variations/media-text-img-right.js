import { registerBlockVariation } from '@wordpress/blocks';

registerBlockVariation(
    'core/media-text',
    {
        name: 'media-text-img-right',
        title: 'Media & Text (Image right)',
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
        isDefault: true,
    }
);
