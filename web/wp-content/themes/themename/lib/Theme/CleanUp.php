<?php
if (!class_exists('CarbonaraCleanUp')):

    /**
     * Class CarbonaraCleanUp
     */
    class CarbonaraCleanUp
    {
        // @todo Move class to Carbon Neutral plugin

        /**
         * CarbonaraCleanUp constructor.
         */
        public function __construct()
        {
            #add_filter('post_class',               [$this, 'postClass'],        10,  2);

            #add_filter('page_css_class',           [$this, 'wpMenu'],           100, 3);

            #add_filter('nav_menu_link_attributes', [$this, 'navMenuItemClass'], 10,  3);

            add_filter('post_thumbnail_html',      [$this, 'widthHeightAttr'],  10);
            add_filter('image_send_to_editor',     [$this, 'widthHeightAttr'],  10);

            add_filter('the_content',              [$this, 'tidyContent']);

            add_filter('img_caption_shortcode',    [$this, 'tidyCaption'],      100, 3);
            add_filter('get_image_tag_class',      [$this, 'tidyImgClass'],     100, 1);
        }


        /**
         *
         *
         * @param $classes
         * @param $item
         * @param $args
         * @return array|string
         */
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


        /**
         * @param $classes
         * @param $extraClasses
         * @return array|string
         */
        public function postClass($classes, $extraClasses)
        {
            $allowedClasses = ['post'];
            $classes = array_intersect($classes, $allowedClasses);
            return is_array($classes) ? array_merge($classes, (array) $extraClasses) : '';
        }


        /**
         * @param $atts
         * @param $item
         * @param $args
         * @return mixed
         */
        public function navMenuItemClass($atts, $item, $args)
        {
            if (!empty($args->bem_block)) {
                $atts['class'] = $args->bem_block . '__link';
            }
            return $atts;
        }


        /**
         * @param $html
         * @return string|string[]|null
         */
        public function widthHeightAttr($html)
        {
            $html = preg_replace('/(width|height)="\d*"\s/', '', $html);
            return $html;
        }


        /**
         * @param $content
         * @return string|string[]|null
         */
        public function tidyContent($content)
        {
            return preg_replace('#<p[^>]*>(\s|&nbsp;|</?\s?br\s?/?>)*</?p>#i', '', $content);
        }


        /**
         * @param $output
         * @param $attr
         * @param $content
         * @return string
         */
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


        /**
         * @param $classes
         * @return string
         */
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

    }
    (new CarbonaraCleanUp());

endif;
