<?php

namespace Carbonite\Post;

/**
 * Class PostType
 * @package Carbonite\Post
 */
class PostType
{
    /**
     * Add a new taxonomy
     *
     * @param $slug
     * @param $postType
     * @param $plural
     * @param $singular
     * @param array $args
     * @param array $labels
     */
    public function addTaxonomy($slug, $postType, $plural, $singular, $args = [], $labels = [])
    {
        $default_labels = [
            'name'              => _x($plural, 'taxonomy general name'),
            'singular_name'     => _x($singular, 'taxonomy singular name' ),
            'search_items'      =>  __('Search '. $plural),
            'all_items'         => __('All '.$plural),
            'parent_item'       => __('Parent '.$singular),
            'parent_item_colon' => __('Parent '.$singular.':'),
            'edit_item'         => __('Edit '.$singular),
            'update_item'       => __('Update '.$singular),
            'add_new_item'      => __('Add New '.$singular),
            'new_item_name'     => __('New '.$singular.' Name'),
            'menu_name'         => __($plural)
        ];
        $labels = array_merge($default_labels, $labels);
        $args['labels'] = $labels;
        register_taxonomy($slug, $postType, $args);
    }

    /**
     * Add a new post type
     *
     * @param $slug
     * @param $plural
     * @param $singular
     * @param array $args
     * @param array $labels
     */
    public function addPostType($slug, $plural, $singular, $args = [], $labels = [])
    {
        $defaultArgs = [
            'public'            => true,
            'capability_type'   => 'post',
            'has_archive'       => true,
            'rewrite'           => true,
            'hierarchical'      => false,
            'menu_position'     => null,
            'supports'          => [ 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ]
        ];
        $defaultLabels = [
            'name'              => _x($plural, 'post type general name'),
            'singular_name'     => _x($singular, 'post type singular name'),
            'add_new'           => _x('Add New', $plural),
            'add_new_item'      => __('Add New ' . $singular),
            'edit_item'         => __('Edit ' . $singular),
            'new_item'          => __('New ' . $singular),
            'all_items'         => __('All ' . $plural),
            'view_item'         => __('View ' . $singular),
            'search_items'      => __('Search ' . $plural),
            'not_found'         => __('No ' . $plural . ' found'),
            'not_found_in_trash'=> __('No ' . $plural . ' found in Trash'),
            'parent_item_colon' => '',
            'menu_name' => $plural
        ];
        $args = array_merge($defaultArgs, $args);
        $labels = array_merge($defaultLabels, $labels);
        $args['labels'] = $labels;
        register_post_type($slug, $args);
    }
}