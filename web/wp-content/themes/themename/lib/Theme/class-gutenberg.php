<?php
namespace CarbonPress\Theme;

/**
 * Class Setup
 *
 * @package CarbonPress\Theme
 */
class Gutenberg
{
    /**
     * Setup constructor.
     */
    public function __construct()
    {
        add_filter( 'allowed_block_types_all',      [$this, 'set_block_types'], 20) ;
    }

    /**
     * Choose block types
     */
    public function set_block_types()
    {
        return array(
            'carbonberg/text',
            'carbonberg/image',
            'carbonberg/text-image',
            'carbonberg/form',
            'carbonberg/accordion',
            'core/image'
        );
    }
}
(new Gutenberg());
