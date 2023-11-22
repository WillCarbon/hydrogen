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
        add_filter( 'allowed_block_types_all',      [$this, 'set_block_types'], 20);
        add_filter( 'block_categories_all',         [$this, 'add_block_categories'], 20);
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
            'carbonberg/example',
            'core/paragraph'
        );
    }

    /**
     * Add block categories
     */
    public function add_block_categories( $block_categories )
    {
        $block_categories[] = array(
            'slug'  => 'example',
            'title' => 'Example'
        );

        return $block_categories;
    }
}
(new Gutenberg());
