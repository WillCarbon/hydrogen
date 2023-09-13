import { registerBlockVariation } from '@wordpress/blocks';

registerBlockVariation(
    'core/media-text',
    {
        name: 'media-text-img-left',
        title: 'Media & Text (Image left)',
        attributes: {
            align: 'wide',
            mediaPosition: 'left',
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
