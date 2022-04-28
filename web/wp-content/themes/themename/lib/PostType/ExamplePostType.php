<?php
namespace Carbonara\PostType;

use Carbon\PostType\BasePostType;
use Carbon\PostType\PostTypeInterface;

/**
 * Class ExamplePostType
 *
 * @package Carbonara\PostType
 */
class ExamplePostType extends BasePostType implements PostTypeInterface
{
    const POST_TYPE = 'example';

    const TAXONOMY  = 'example_cat';

    /**
     * ExamplePostType constructor.
     */
    public function __construct()
    {
        add_action('init', [$this, 'register']);

        /** Uncomment to set a custom page count */
        // add_action('pre_get_posts', [$this, 'setPostsPerPage']);

        /** Uncomment to redirect non-frontend post types and taxonomies */
        // add_action('pre_get_posts', [$this, 'getRedirect']);
    }

    /**
     * Register post type
     */
    public function register()
    {
        $this->addPostType(self::POST_TYPE, 'Examples', 'Example', [
            'rewrite'       => [
                'slug'          => 'examples',
                'with_front'    => false
            ],
            'has_archive'   => 'examples',
            'supports'      => [ 'title', 'editor', 'author', 'thumbnail' ]
        ]);

        $this->addTaxonomy(self::TAXONOMY, self::POST_TYPE, 'Categories', 'Category', [
            'hierarchical'      => true,
            'rewrite'           => [
                'slug'              => 'example-cat',
                'with_front'        => false
            ]
        ]);
    }


    /**
     * Set archives Posts Per Page
     *
     * @param \WP_Query     $query
     * @return void
     */
    public function setPostsPerPage($query){
        if($query->is_main_query()) {
            if ($query->is_post_type_archive(self::POST_TYPE) && $query->is_tax(self::TAXONOMY)) {
                $query->set('posts_per_page', 12);
            }
        }
    }


    /**
     * Redirect single pages to archive
     */
    public function getRedirect()
    {
        /** Redirect unused post type */
        if (is_singular(self::POST_TYPE)) {
            wp_redirect(get_post_type_archive_link(self::POST_TYPE), 301);
            exit();
        }

        /** Redirect unused taxonomy */
        if (is_tax(self::TAXONOMY)) {
            wp_redirect(get_post_type_archive_link(self::POST_TYPE), 301);
            exit();
        }
    }

}
(new ExamplePostType());
