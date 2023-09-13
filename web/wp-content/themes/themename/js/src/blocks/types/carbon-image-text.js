import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';

registerBlockType( 'carbon/image-text', {
    apiVersion: 2,
    title: 'Image & Text',
    category: 'media',
    icon: 'align-pull-left',
    edit: () => {
        const
            template = [
                [ 'core/media-text', {
                    mediaPosition: 'right',
                }, [
                    [ 'core/heading', {
                        placeholder: 'Lorem ipsum dolor sit amet...',
                    } ],
                    [ 'core/paragraph', {
                        placeholder: 'Et leo duis ut diam quam nulla porttitor. Justo eget magna fermentum iaculis eu non diam phasellus. Cras sed felis eget velit aliquet sagittis. Porttitor massa id neque aliquam vestibulum morbi blandit cursus risus...',
                    } ],
                ],
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
