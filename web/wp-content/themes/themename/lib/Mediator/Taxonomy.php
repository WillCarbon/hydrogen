<?php

namespace Carbonite\Mediator;

class Taxonomy
{
    /**
     * Retrieve the terms in a given taxonomy or list of taxonomies
     *
     * @param array|string $name taxonomy or list of taxonomies
     * @param boolean $hidden
     * @return array
     */
    public static function getTaxonomies($name, $hidden = false)
    {
        $taxStorage = [];
        if (!empty($output = get_terms(['taxonomy' => $name, 'hide_empty' => $hidden]))) {

            foreach ($output as $term) {
                $taxStorage[] = [
                    'id'    => $term->term_id,
                    'title' => $term->name,
                    'link'  => get_term_link($term, $name)
                ];
            }
        }
        return $taxStorage;
    }

    /**
     * Get all terms for a given taxonomy
     * It can also sort the output alphabetically if last argument is set as true
     *
     * @param $taxonomyName
     * @param $postType
     * @param bool $sort
     * @return array
     */
    public static function getTaxonomyTerms($taxonomyName, $postType, $sort = false)
    {
        $termStorage = [];
        foreach(get_posts(['post_type' => $postType, 'numberposts' => -1]) as $post) {

            $terms = wp_get_post_terms($post->ID, $taxonomyName);
            foreach ($terms as $term) {
                $termStorage[$term->name][] = [
                    'id'    => $post->ID,
                    'title' => $post->post_title,
                    'link'  => get_permalink($post->ID),
                ];
            }
        }

        // Sort the array alphabetically
        if ($sort) {
            foreach($termStorage as $k => $v) {
                uasort($termStorage[$k], function($a, $b) {
                    return strcmp($a['title'], $b['title']);
                });
                $termStorage[$k] = array_values($termStorage[$k]);
            }
        }

        return $termStorage;
    }

}
