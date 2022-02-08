<?php

use Carbon\PostType\BasePostType;
use Carbon\PostType\PostTypeInterface;

/**
 * Class ExamplePostType
 */
class ExamplePostType extends BasePostType implements PostTypeInterface
{

    /**
     * Post type constructor.
     */
    public function __construct()
    {
        add_action('init', [$this, 'register']);

        /** uncomment to set a custom PostsPerPage for the archives */
        //add_action( 'pre_get_posts', [$this, 'setPostsPerPage']);

        /** uncomment to redirect unwanted pages to the post type archive */
        //add_action('wp', [$this, 'getRedirect']);
    }


    /**
     * Register post type
     */
    public function register()
    {
        $this->addPostType('example', 'Examples', 'Example', [
            'rewrite'       => [
                'slug'          => 'examples',
                'with_front'    => false
            ],
            'has_archive'   => 'examples',
            'supports'      => [ 'title', 'editor', 'author', 'thumbnail' ]
        ]);

        $this->addTaxonomy('example_cat', 'example', 'Categories', 'Category', [
            'hierarchical'      => true,
            'rewrite'           => [
                'slug'              => 'examples',
                'with_front'        => false
            ]
        ]);
    }


    /**
     * Set archives posts per page
     *
     * @param WP_Query $query
     * @return void
     */
    public function setPostsPerPage($query){
        if ( !is_admin() && $query->is_main_query() ):
            if ( is_post_type_archive('example') || is_tax('example_cat') ):
                $query->set('posts_per_page', 10);
            endif;
        endif;
    }


    /**
     * Redirect single post and taxonomy pages to archive
     */
    public function getRedirect()
    {
        if (is_singular('example') || is_tax('example_cat')) {
            wp_redirect(get_post_type_archive_link('example'));
        }
    }

}
(new ExamplePostType());
