import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';

registerBlockType( 'carbon/hero', {
    apiVersion: 2,
    title: 'Hero',
    category: 'text',
    icon: 'text',
    edit: () => {
        const
            allowedBlocks = [
                'core/group',
                'core/paragraph',
                'core/heading',
            ],
            template = [
                [ 'core/group', {}, [
                    [ 'core/heading', {
                        placeholder: 'Lorem ipsum dolor sit amet...',
                        level: 4,
                        attributes: {
                            lock: {
                                move: true,
                                remove: false,
                            },
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
