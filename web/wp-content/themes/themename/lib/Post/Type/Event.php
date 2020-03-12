<?php

namespace Carbonite\Post\Type;

use Carbonite\Post\PostType;
use Carbonite\Post\PostTypeInterface;

class Event extends PostType implements PostTypeInterface
{

    /**
     * Event constructor.
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
        $this->addPostType('event', 'Events', 'Event', [
            'rewrite'       => [
                'slug'          => 'events',
                'with_front'    => false
            ],
            'has_archive'   => 'events',
            'supports'      => [ 'title', 'editor', 'author', 'thumbnail' ]
        ]);

        $this->addTaxonomy('event_cat', 'event', 'Categories', 'Category', [
            'hierarchical'      => true,
            'rewrite'           => [
                'slug'              => 'events',
                'with_front'        => false
            ]
        ]);
    }
}
