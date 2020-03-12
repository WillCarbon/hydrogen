<?php

use Carbon\PostType\BasePostType;
use Carbon\PostType\PostTypeInterface;

/**
 * Class ExamplePostType
 */
class ExamplePostType extends BasePostType implements PostTypeInterface
{

    /**
     * ExamplePostType constructor.
     */
    public function __construct()
    {
        add_action('init', [$this, 'register']);
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
}
(new ExamplePostType());
