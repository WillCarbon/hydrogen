<?php

namespace Carbonite\Mediator;

class Mediator
{
    /*
     * Example for single fields
     */
    public static function getHero()
    {
        return [
            'hero_text'  => get_field('hero_text'),
            'hero_image' => get_field('hero_image'),
            'link_title' => get_field('link_title'),
            'hero_link'  => get_field('hero_link')
        ];
    }

    /*
     * Get custom fields for a post or page
     */
    public static function getCustomFields()
    {
        global $post;
        if (!empty($output = get_fields($post->ID))) {
            return $output;
        }
        return [];
    }
}
