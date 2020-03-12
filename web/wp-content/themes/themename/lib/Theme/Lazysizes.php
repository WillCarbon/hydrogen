<?php
namespace Carbonite\Theme;

class Lazysizes
{

    /**
     * Lazysizes constructor.
     */
    public function __construct()
    {
        if (is_admin())
            return ;

        add_filter('wp_get_attachment_image_attributes', [$this, 'lazyImageAttributes']);
    }

    /**
     * Adds lazysizes attributes to WP generated image tags
     *
     * @param  array $attr
     * @return array $attr Modified image attributes
     */
    public function lazyImageAttributes($attr)
    {
        // Allowed Attributes
        $allowed = [
            'alt',
            'class',
            'title',
            'width',
            'height'
        ];

        // Add lazyload class
        $attr['class'] = (!empty($attr['class'])) ? $attr['class'] . ' lazyload' : 'lazyload';

        // Add data attributes to tag
        foreach ($attr as $key => $val) {
            if (!in_array($key, $allowed) && substr($key, 0, 4) !== 'data') {
                $attr['data-' . $key] = $val;
                unset($attr[$key]);
            }
        }

        if (!isset($attr['src'])) {
            $attr['src'] = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
        }

        return $attr;
    }

}
