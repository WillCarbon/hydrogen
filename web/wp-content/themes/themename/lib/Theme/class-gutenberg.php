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
        // Lock the homepage blocks
        add_filter( 'allowed_block_types_all', [$this, 'set_block_types'], 20, 2);

        // Lock the homepage blocks
        add_filter( 'block_categories_all', [$this, 'add_block_categories'], 20, 2);

        /**
         * Post type specific setups are controlled in the CPT register file
         */
    }


    /**
     * Choose block types
     *
     * To find the list of all the core blocks that can be filtered, see:
     * @link https://developer.wordpress.org/block-editor/reference-guides/core-blocks/
     *
     * @param bool|string[] $allowed_block_types
     * @param \WP_Block_Editor_Context $editor_context
     * @return array
     */
    public function set_block_types( mixed $allowed_block_types, \WP_Block_Editor_Context $editor_context )
    : array
    {
        /**
         * Post type specific setups are controlled in the CPT register file
         */

        return array(
            // 'core/paragraph',
            'carbonberg/accordion',
            'carbonberg/image',
            'carbonberg/text-image',
            // 'carbonpress/example-image',
            // 'carbonpress/example-text',
            'gravityforms/form',
        );
    }


    /**
     * Add block categories
     *
     * @param array $block_categories
     * @param \WP_Block_Editor_Context $block_editor_context
     * @return array
     */
    public function add_block_categories( array $block_categories, \WP_Block_Editor_Context $block_editor_context )
    : array
    {
        array_unshift($block_categories, array(
            'slug'  => 'carbonpress',
            'title' => 'Project Name'
        ));

        return $block_categories;
    }

}
(new Gutenberg());
