<?php

/**
 * Class CarbonCleanUp
 */
class CarbonCleanUp
{
    public function __construct()
    {
        add_action('init',                     [$this, 'wpHeader']);

        #add_filter('body_class',               [$this, 'bodyClasses'],      10,  2);
        add_filter('post_class',               [$this, 'postClass'],        10,  2);

        add_filter('nav_menu_css_class',       [$this, 'wpMenu'],           100, 3);
        add_filter('nav_menu_item_id',         [$this, 'wpMenu'],           100, 3);
        add_filter('page_css_class',           [$this, 'wpMenu'],           100, 3);

        add_action('widgets_init',             [$this, 'commentsStyle']);

        add_filter('wp_nav_menu_args',         [$this, 'navMenuId']);
        add_filter('nav_menu_link_attributes', [$this, 'navMenuItemClass'], 10,  3);

        add_filter('post_thumbnail_html',      [$this, 'widthHeightAttr'],  10);
        add_filter('image_send_to_editor',     [$this, 'widthHeightAttr'],  10);

        add_filter('the_content',              [$this, 'tidyContent']);

        add_filter('img_caption_shortcode',    [$this, 'tidyCaption'],      100, 3);
        add_filter('get_image_tag_class',      [$this, 'tidyImgClass'],     100, 1);

        add_filter('embed_oembed_html',        [$this, 'embedWrapper'],     10,  3);

        add_filter('wpseo_metabox_prio',       [$this, 'moveYoast']);
    }

    public function wpHeader()
    {
        if (!is_admin()) {
            $headItems = [
                ['rsd_link'],
                ['wp_generator'],
                ['feed_links', 2],
                ['index_rel_link'],
                ['wlwmanifest_link'],
                ['feed_links_extra', 3],
                ['start_post_rel_link', 10],
                ['parent_post_rel_link', 10],
                ['adjacent_posts_rel_link', 10],
                ['print_emoji_detection_script', 7],
                ['print_emoji_styles']
            ];

            foreach ($headItems as $item) {
                $label = $item[0];
                $priority = (isset($item[1])) ? $item[1] : 10;

                if ($label == 'print_emoji_detection_script' || $label == 'print_emoji_styles') {
                    remove_action('wp_print_styles', $label, $priority);
                    remove_action('wp_head', $label, $priority);
                } else {
                    remove_action('wp_head', $label, $priority);
                }
            }
        }
    }

    public function bodyClasses($classes, $extraClasses)
    {
        $allowedClasses = ['home'];
        $classes = array_intersect($classes, $allowedClasses);
        $classes = array_merge($classes, (array) $extraClasses);
        return $classes;
    }

    public function wpMenu($classes, $item, $args)
    {
        $block = isset($args->bem_block) ? $args->bem_block : $args->menu_class;
        $allowedClasses = [
            $block . '__item',
            $block . '__item--current',
            $block . '__item--ancestor',
            $block . '__item--has-children'
        ];
        return is_array($classes) ? array_intersect($classes, $allowedClasses) : '';
    }

    public function postClass($classes, $extraClasses)
    {
        $allowedClasses = ['post'];
        $classes = array_intersect($classes, $allowedClasses);
        return is_array($classes) ? array_merge($classes, (array) $extraClasses) : '';
    }

    public function commentsStyle()
    {
        $action = [
            $GLOBALS['wp_widget_factory']->widgets['WP_Widget_Recent_Comments'],
            'recent_comments_style'
        ];
        remove_action('wp_head', $action);
    }

    public function navMenuId($args)
    {
        if (!empty($args['bem_block'])) {
            $args['items_wrap'] = '<ul class="' . $args['bem_block'] . '">%3$s</ul>';
        } else {
            $args['items_wrap'] = '<ul>%3$s</ul>';
        }
        $args['container']  = false;
        return $args;
    }

    public function navMenuItemClass($atts, $item, $args)
    {
        if (!empty($args->bem_block)) {
            $atts['class'] = $args->bem_block . '__link';
        }
        return $atts;
    }

    public function widthHeightAttr($html)
    {
        $html = preg_replace('/(width|height)="\d*"\s/', '', $html);
        return $html;
    }

    public function tidyContent($content)
    {
        return preg_replace('#<p[^>]*>(\s|&nbsp;|</?\s?br\s?/?>)*</?p>#i', '', $content);
    }

    public function tidyCaption($output, $attr, $content)
    {
        $atts = shortcode_atts([
            'id'      => '',
            'align'   => 'alignnone',
            'width'   => '',
            'caption' => '',
            'class'   => '',
        ], $attr, 'caption');

        $class = trim('post-figure ' . $atts['align'] . ' ' . $atts['class']);

        return sprintf(
            '<figure class="%1$s">
                %2$s
                <figcaption class="post-figure__caption">%3$s</figcaption>
            </figure>',
            esc_attr($class),
            do_shortcode($content),
            $atts['caption']
        );
    }

    public function tidyImgClass($classes)
    {
        $classes = explode(' ', $classes);
        foreach ($classes as $i => $class) {
            if (strpos($class, 'wp-image-') !== false) {
                unset($classes[$i]);
            }
        }
        $classes = implode(' ', $classes);
        return 'post-img ' . $classes;
    }

    public function embedWrapper($html, $url, $attr)
    {
        $classes = ['post-embed'];
        if (strpos($url, 'youtu.be') !== false || strpos($url, 'youtube.com') !== false || strpos($url, 'vimeo') !== false) {
            $classes[] = 'post-embed--video';
        } else if (strpos($url, 'twitter.com') !== false) {
            $classes[] = 'post-embed--twitter';
        }
        $classes = implode(' ', $classes);
        return '<figure class="' . $classes . '">' . $html . '</figure>';
    }

    public function moveYoast()
    {
        return 'low';
    }
}
(new CarbonCleanUp());
