<?php
namespace CarbonPress\PostType;

use Carbon\Helpers\PostType;
use WP_Query;

/**
 * Class PagePostType
 *
 * @package CarbonPress\PostType
 */
class PagePostType
{
    const POST_TYPE = 'page';

    /**
     * PagePostType constructor.
     */
    public function __construct()
    {
        /** Uncomment to change the behaviour of pages */
        //add_action( 'init', [$this, 'setup'] );

        /** Uncomment to set page specific block list */
        //add_filter( 'allowed_block_types_all', [$this, 'set_block_types'], 30, 2 );

        /** Set the template lock for all pages */
        //add_action( 'init', [$this, 'set_template_lock'], 20 );
    }


    /**
     * Modify the setup for pages
     */
    public function setup()
    : void
    {

    }


    /**
     * Set page specific Block list
     *
     * @param bool|array $allowed_block_types
     * @param \WP_Block_Editor_Context $editor_context
     * @return bool|array
     */
    public function set_block_types( mixed $allowed_block_types, \WP_Block_Editor_Context $editor_context )
    : mixed
    {
        if ( self::POST_TYPE === $editor_context->post->post_type ) {

            /** Example: Add additional Blocks to this post type */
            /* if ( !is_array('core/paragraph', $allowed_block_types) ) {
                $allowed_block_types = array_merge($allowed_block_types, array(
                    'core/image',
                    'core/paragraph',
                ));
            } */

            /** Example: Remove specific Block from this post type */
            /* if ( is_array('core/paragraph', $allowed_block_types) ) {
                unset($allowed_block_types['core/paragraph']);
            } */

            /** Example: Replace entire Block list */
            /* $allowed_block_types = array(
                'core/image',
                'core/paragraph',
            ); */
        }

        return $allowed_block_types;
    }


    /**
     * Set page specific template
     *
     * @return void
     */
    public function set_template_lock()
    : void
    {
        if ( class_exists('CB_Post_Admin') && self::POST_TYPE === \CB_Post_Admin::get_post_type() ) :

            /**
             * Set blocks for all pages
             */
            $page_type_object = get_post_type_object( self::POST_TYPE );
            $page_type_object->template = [
                ['carbonpress/hero', [
                    'lock' => [
                        'remove'    => true,
                        'move'      => true,
                    ]
                ]],
            ];
            $page_type_object->template_lock = null;


            /**
             * Set the template for the homepage
             */
            if ( !empty($_GET['post']) && get_option( 'page_on_front' ) === $_GET['post'] ) :
                $page_type_object = get_post_type_object( 'page' );
                $page_type_object->template = array(
                    ['carbonberg/accordion', [] ],
                    ['carbonberg/image', [] ],
                    ['carbonberg/text-image', [] ],
                    // ['carbonpress/example-image', [] ],
                    // ['carbonpress/example-text', [] ],
                );
                $page_type_object->template_lock = 'all';
            endif;


            /**
             * An example of setting a page template (e.g. for Contact Us)
             */
            if ( 'tpl-example.php' === \CB_Post_Admin::get_page_template() ) :
                $page_type_object = get_post_type_object( 'page' );
                $page_type_object->template = [
                    ['carbonberg/accordion', [] ],
                    ['carbonberg/image', [] ],
                    ['carbonberg/text-image', [] ],
                    // ['carbonpress/example-image', [] ],
                    // ['carbonpress/example-text', [] ],
                ];
                $page_type_object->template_lock = 'all';
            endif;

        endif;
    }

}
(new PagePostType());
