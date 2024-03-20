<?php
namespace CarbonPress\PostType;

use Carbon\Helpers\PostType;
use WP_Query;

/**
 * Class PostPostType
 *
 * @package CarbonPress\PostType
 */
class PostPostType
{
    const POST_TYPE = 'post';


    /**
     * PostPostType constructor.
     */
    public function __construct()
    {
        /** Uncomment to change the behaviour of posts */
        //add_action( 'admin_menu', [$this, 'set_menu'] );
        //add_action( 'init', [$this, 'set_labels'] );

        /** Uncomment to set page specific block list */
        // add_filter( 'allowed_block_types_all', [$this, 'set_block_types'], 30, 2 );

        /** Set the template lock for all pages */
        //add_action( 'init', [$this, 'set_template_lock'], 20 );

        /** Uncomment to set a custom page count */
        // add_action( 'pre_get_posts', [$this, 'set_posts_per_page'] );

        /** Uncomment to redirect non-frontend post types and taxonomies */
        // add_action( 'template_redirect', [$this, 'get_redirect'] );
    }


    /**
     * Modify the menu name for posts
     *
     * @return void
     */
    public function set_menu()
    : void
    {
        global $menu, $submenu;
        $menu[5][0] = 'Articles';
        $submenu['edit.php'][5][0] = 'Articles';
        $submenu['edit.php'][10][0] = 'Add Articles';
    }

    /**
     * Modify the labels for posts
     */
    public function set_labels()
    : void
    {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;

        $labels->name               = 'Articles';
        $labels->singular_name      = 'Article';
        $labels->add_new            = 'Add Article';
        $labels->add_new_item       = 'Add Article';
        $labels->edit_item          = 'Edit Article';
        $labels->new_item           = 'Article';
        $labels->view_item          = 'View Article';
        $labels->search_items       = 'Search Articles';
        $labels->not_found          = 'No Articles found';
        $labels->not_found_in_trash = 'No Articles found in Trash';
        $labels->name_admin_bar     = 'Add Article';
    }


    /**
     * Set post-type specific Block list
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
            /* if (is_array('core/paragraph', $allowed_block_types)) {
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
     * Set post-type specific template
     *
     * @return void
     */
    public function set_template_lock()
    : void
    {
        if ( class_exists('CB_Post_Admin') && self::POST_TYPE === \CB_Post_Admin::get_post_type() ) :

            $page_type_object = get_post_type_object( self::POST_TYPE );
            $page_type_object->template = array(
                ['carbonberg/accordion', [] ],
                ['carbonberg/image', [] ],
                ['carbonberg/text-image', [] ],
                // ['carbonpress/example-image', [] ],
                // ['carbonpress/example-text', [] ],
            );

            $page_type_object->template_lock = 'all';

        endif;
    }


    /**
     * Set archives Posts Per Page
     *
     * @param WP_Query $query
     * @return void
     */
    public function set_posts_per_page( WP_Query $query )
    : void
    {
        if ( !is_admin() && $query->is_main_query() ) {
            if ( $query->is_post_type_archive(self::POST_TYPE) || $query->is_category() || $query->is_tag() ) {
                $query->set('posts_per_page', 12);
            }
        }
    }


    /**
     * Redirect single post or categories to archive
     */
    public function get_redirect()
    : void
    {
        /** Example: Redirect unused post type */
        // if ( is_singular(self::POST_TYPE) ) {
        //     wp_redirect( get_post_type_archive_link(self::POST_TYPE), 301);
        //     exit();
        // }

        /** Example: Redirect unused categories */
        // if ( is_category() ) {
        //     wp_redirect( get_post_type_archive_link(self::POST_TYPE), 301);
        //     exit();
        // }

        /** Example: Redirect unused tags */
        // if ( is_tag() ) {
        //     wp_redirect( get_post_type_archive_link(self::POST_TYPE), 301);
        //     exit();
        // }
    }

}
(new PostPostType());
