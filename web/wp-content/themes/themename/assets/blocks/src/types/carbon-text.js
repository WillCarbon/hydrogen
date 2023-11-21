import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';

registerBlockType( 'carbon/text', {
    apiVersion: 2,
    title: 'Text',
    category: 'text',
    icon: 'text',
    edit: () => {
        const
            allowedBlocks = [
                'core/group',
                'core/paragraph',
                'core/heading',
                'core/list',
            ],
            template = [
                [ 'core/group', {}, [
                    [ 'core/heading', {
                        placeholder: 'Lorem ipsum dolor sit amet...',
                        lock: {
                            move: false,
                            remove: true,
                        },
                    } ],
                    [ 'core/paragraph', {
                        placeholder: 'Et leo duis ut diam quam nulla porttitor. Justo eget magna fermentum iaculis eu non diam phasellus. Cras sed felis eget velit aliquet sagittis. Porttitor massa id neque aliquam vestibulum morbi blandit cursus risus...',
                        lock: {
                            move: false,
                            remove: true,
                        },
                    } ],
                ],
                ],
            ];

        return (
            <div { ...useBlockProps }>
                <InnerBlocks
                    allowedBlocks={allowedBlocks}
                    orientation="horizontal"
                    template={template}
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
