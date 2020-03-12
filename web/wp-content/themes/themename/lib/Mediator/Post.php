<?php

namespace Carbonite\Mediator;

class Post
{
    /**
     * A generic function to retrieve any post type with any custom fields
     *
     * @param $postType
     * @param int $limit
     * @param array $customFields
     * @return array
     */
    public static function getPosts($postType, $limit = -1, $customFields = [])
    {
        $args = [
            'post_type'         =>  $postType,
            'posts_per_page'    =>  $limit
        ];

        $postStorage = [];
        if (!empty($posts = get_posts($args))) {
            foreach ($posts as $post) {

                /**
                 * Get custom fields
                 */
                $fieldsStorage = [];
                if (!empty($customFields)) {
                    foreach($customFields as $cf) {
                        $fieldsStorage[$cf] = get_field($cf, $post->ID);
                    }
                }

                if(empty($image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID)))) {
                    $image = [
                        'image' =>  [
                            '0' => get_stylesheet_directory_uri() . '/img/default-image.png'
                        ]
                    ];
                }

                $postStorage[] = @array_merge([
                    'id'        =>  $post->ID,
                    'title'     =>  $post->post_title,
                    'content'   =>  $post->post_content,
                    'link'      =>  get_permalink($post->ID),
                    'image'     =>  $image,
                ], $fieldsStorage);
            }
        }
        return $postStorage;
    }

    /**
     * Retrieve a number of posts and their custom fields
     *
     * Usage:
     * Post::getPostsByID(); Return current post
     * Post::getPostsByID([52]);
     * Post::getPostsByID([45,24,33])
     * Post::getPostsByID([12,22], ['custom_field1, custom_fields2']);
     *
     *
     * @param array $posts
     * @param array $customFields
     * @return array
     */
    public static function getPostsByID(array $posts = [], $customFields = [])
    {
        $postStorage = [];

        if (empty($posts)) {
            $posts = [get_the_ID()];
        }

        if (!empty($posts = get_posts(['post__in' => $posts, 'post_type' => 'project']))) {
            foreach ($posts as $post) {

                /**
                 * Get custom fields
                 */
                $fieldsStorage = [];
                if (!empty($customFields)) {
                    foreach($customFields as $cf) {
                        $fieldsStorage[$cf] = get_field($cf, $post->ID);
                    }
                }

                if(empty($image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID)))) {
                    $image = [
                        'image' =>  [
                            '0' => get_stylesheet_directory_uri() . '/img/default-image.png'
                        ]
                    ];
                }

                $postStorage[] = @array_merge([
                    'id'        =>  $post->ID,
                    'title'     =>  $post->post_title,
                    'content'   =>  $post->post_content,
                    'link'      =>  get_permalink($post->ID),
                    'image'     =>  $image,
                ], $fieldsStorage);
            }
        }
        return $postStorage;
    }

    /**
     * Get related posts for the current post
     *
     * @return array of posts
     */
    public static function getRelatedPosts($postType = 'post')
    {
        $postID = get_the_ID();

        /**
         * If related news are selected we should use them, Otherwise it would be posts from same category
         */
        if (!empty($data = get_field('related_posts', $postID))) {
            return $data;
        }

        /**
         * Fetch three posts with similar taxonomy terms
         */
        $objectStorage = [];
        if (!empty($postTaxonomies = get_object_taxonomies($postType))) {
            foreach ($postTaxonomies as $tax) {
                $termStorage = [];
                if (!empty($postTerms = wp_get_post_terms($postID, $tax))) {
                    foreach ($postTerms as $term) {
                        $termStorage[] = $term->term_id;
                    }
                }
                $objectStorage[$tax] = $termStorage;
            }
        }

        if (!empty($objectStorage)) {
            $relatedArgs = [
                'post_type'         =>  $postType,
                'posts_per_page'    =>  3,
                'orderby'           =>  'rand',
                'post__not_in'      =>  [$postID],
                'tax_query'         =>  [
                    'relation' => 'OR'
                ]
            ];
            foreach ($objectStorage as $taxonomy => $terms) {
                $relatedArgs['tax_query'][] = [
                    'taxonomy' => $taxonomy,
                    'field'    => 'term_id',
                    'terms'    => $terms,
                ];
            }

            if (!empty($posts = get_posts($relatedArgs))) {
                return $posts;
            }
        }

        return [];
    }

    /**
     * Return post date in human readable format
     * @return string
     */
    public static function getPostDate()
    {
        return human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago';
    }

    /**
     * Return an array containing a post's categories
     *
     * @param  int   Post ID
     * @return array Array of post categories
     */
    public static function getPostCategories($id, $taxonomy = 'category')
    {
        $output = [];
        $terms = wp_get_post_terms($id, $taxonomy);
        foreach ($terms as $term) {
            $output[$term->term_id] = [
                'title'  => $term->name,
                'slug'   => $term->slug,
                'id'     => $term->term_id,
                'url'    => get_term_link($term)
            ];
        }
        return $output;
    }

    /**
     * Return an array containing a post's tags
     *
     * @param  int   Post ID
     * @return array Array of post categories
     */
    public static function getPostTags($id)
    {
        $output = [];
        $t = wp_get_post_tags($id);
        if (!empty($t)) {
            foreach ($t as $tag) {
                $output[$tag->term_id] = [
                    'title'  => $tag->name,
                    'slug'   => $tag->slug,
                    'id'     => $tag->term_id,
                    'url'    => get_term_link($tag)
                ];
            }
        }
        return $output;
    }

    /**
     * Return a single category for a post
     * Prioritises the displayed category on category archives
     *
     * @param  int   Post ID
     * @return array Single category details
     */
    public static function getSingleCategory($id)
    {
        $cats = self::getPostCategories($id);

        if (!is_sticky($id) && !empty($currentCat = get_query_var('cat'))) {
            if (array_key_exists($currentCat, $cats)) {
                return $cats[$currentCat];
            }
        }

        return $cats[key($cats)];
    }
}