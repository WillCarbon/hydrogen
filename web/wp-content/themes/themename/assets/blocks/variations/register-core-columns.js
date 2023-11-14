import { registerBlockVariation } from '@wordpress/blocks';
import { SVG, Path } from '@wordpress/primitives';
import domReady from '@wordpress/dom-ready';

const columns4ColumnsIcon = (
    <SVG
        width="48"
        height="48"
        viewBox="0 0 48 48"
        xmlns="http://www.w3.org/2000/svg"
    >
        <Path d="M40.4142 12.5858C40.7893 12.9609 41 13.4695 41 14V34C41 34.5305 40.7893 35.0391 40.4142 35.4142C40.0392 35.7893 39.5304 36 39 36H9C8.46957 36 7.96086 35.7893 7.58578 35.4142C7.21071 35.0391 7 34.5305 7 34V14C7 13.4695 7.21071 12.9609 7.58578 12.5858C7.96086 12.2107 8.46957 12 9 12H39C39.5304 12 40.0392 12.2107 40.4142 12.5858ZM25 34H30.5V14H25V34ZM23 34V14H17.5V34H23ZM32.5 14V34H39V14H32.5ZM9 34H15.5V14H9V34Z" />
    </SVG>
);

domReady( function() {
    registerBlockVariation(
        'core/columns',
        {
            name: 'four-columns-equal',
            title: '25 / 25 / 25 / 25',
            scope: 'block',
            attributes: {
                backgroundColor: 'alpha',
                className: 'four-columns-equal',
            },
            icon: columns4ColumnsIcon,
            innerBlocks: [
                [
                    'core/column',
                    {
                        width: 25,
                    },
                ],
                [
                    'core/column',
                    {
                        width: 25,
                    },
                ],
                [
                    'core/column',
                    {
                        width: 25,
                    },
                ],
                [
                    'core/column',
                    {
                        width: 25,
                    },
                ],
            ],
        }
    );
} );
