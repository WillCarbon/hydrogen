import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';

registerBlockType( 'carbon/image', {
    apiVersion: 2,
    title: 'Image & Text',
    category: 'media',
    icon: 'align-pull-left',
    edit: () => {
        const
            template = [
                [ 'core/image', {
                    lock: {
                        move: false,
                        remove: true,
                    },
                },
                ],
            ];

        return (
            <div {...useBlockProps()}>
                <InnerBlocks
                    orientation="horizontal"
                    template={template}
                    templateLock="all"
                />
            </div>
        );
    },
    save: () => {
        return (
            <div {...useBlockProps.save()}>
                <InnerBlocks.Content />
            </div>
        );
    },
} );
