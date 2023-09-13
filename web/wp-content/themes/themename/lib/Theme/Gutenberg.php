<?php
namespace Carbonara\Theme;

/**
 * Class Setup
 *
 * @package Carbonara\Theme
 */
class Gutenberg
{
    /**
     * Setup constructor.
     */
    public function __construct()
    {
        add_filter('allowed_block_types_all',   [$this, 'setBlockTypes'], 20);
    }

    /**
     * Choose block types
     */
    public function setBlockTypes() {
        return array(
            
            'core/heading',
            'core/paragraph',
            'core/list',
            'core/list-item',
            'core/buttons',
            'core/image',
            // 'core/video',
            // 'core/file',
            
            // 'core/gallery',
            // 'core/quote',
            // 'core/columns',
            // 'core/column',
            'core/group',
            // 'core/media-text', 

            'carbon/image-text',
            'carbon/text'
            // 'carbonberg/accordion',
        );
    }
}
(new Gutenberg());