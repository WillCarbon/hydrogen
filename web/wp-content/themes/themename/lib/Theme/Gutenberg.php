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
            'core/video',
            'core/paragraph',
            'core/file',
            'carbonberg/accordion',
            'carbonberg/image',
            'carbonberg/text-image'
        );
    }
}
(new Gutenberg());