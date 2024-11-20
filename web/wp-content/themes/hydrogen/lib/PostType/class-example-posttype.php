<?php
namespace CarbonPress\PostType;

use Carbon\Helpers\PostType;
use WP_Query;

/**
 * Class ExamplePostType
 *
 * @package CarbonPress\PostType
 */
class ExamplePostType
{
    const POST_TYPE = 'example';

    const TAXONOMY  = 'example_cat';


    /**
     * ExamplePostType constructor.
     */
    public function __construct()
    {
        add_action('init', [$this, 'register']);

        /** Uncomment to set post-type specific Block list */
        // add_filter( 'allowed_block_types_all', [$this, 'set_block_types'], 30, 2);

        /** Set the template lock for all posts under this post type */
        //add_action( 'init', [$this, 'set_template_lock'], 20 );

        /** Uncomment to set a custom page count */
        // add_action('pre_get_posts', [$this, 'set_posts_per_page']);

        /** Uncomment to redirect non-frontend post types and taxonomies */
        // add_action('template_redirect', [$this, 'get_redirect']);
    }

    /**
     * Register post type
     */
    public function register()
    : void
    {
        // Ensure that Carbon Neutral is installed and activated
        if ( !class_exists('Carbon\Helpers\PostType') )
            return;

        PostType::addTaxonomy(self::TAXONOMY, self::POST_TYPE, 'Categories', 'Category', [
            'hierarchical'      => true,
            'show_in_rest'      => true,
            'rewrite'           => [
                'slug'              => 'example/cat',
                'with_front'        => false,
            ],
        ]);

        PostType::addPostType(self::POST_TYPE, 'Examples', 'Example', [
            'rewrite'       => [
                'slug'          => 'examples',
                'with_front'    => false
            ],
            'has_archive'   => 'examples',
            'show_in_rest'  => true,
            'supports'      => [ 'title', 'editor', 'thumbnail' ]
        ]);
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
            if ($query->is_post_type_archive(self::POST_TYPE) || $query->is_tax(self::TAXONOMY)) {
                $query->set('posts_per_page', 12);
            }
        }
    }


    /**
     * Redirect single pages to archive
     */
    public function get_redirect()
    : void
    {
        /** Example: Redirect unused post type */
        /* if (is_singular(self::POST_TYPE)) {
            wp_redirect(get_post_type_archive_link(self::POST_TYPE), 301);
            exit();
        } */

        /** Example: Redirect unused taxonomy */
        /* if (is_tax(self::TAXONOMY)) {
            wp_redirect(get_post_type_archive_link(self::POST_TYPE), 301);
            exit();
        } */
    }

}
(new ExamplePostType());
