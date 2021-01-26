<?php
use Carbon\Helpers\Bem;

if (!class_exists('CarbonaraLoadBem')):

    /**
     * Class CarbonaraLoadBem
     */
    class CarbonaraLoadBem
    {

        /**
         * Bem constructor.
         */
        public function __construct()
        {
            if (!class_exists('Carbon\Helpers\Bem'))
                return;

            add_filter('nav_menu_css_class', [$this, 'nav_menu_css_class'], 30, 3);

            add_filter('page_css_class', [$this, 'page_css_class'], 30, 5);

            #add_filter('body_class', [$this, 'body_class'], 30, 1);

            add_filter('post_class', [$this, 'post_class'], 30, 1);
        }

        /**
         * @param $classes
         * @param $item
         * @param $args
         * @return array
         */
        public function nav_menu_css_class($classes, $item, $args)
        {

            $block   = isset($args->bem_block) ? $args->bem_block : $args->menu_class;
            $element = apply_filters('wpbem_nav_menu_element', 'item');

            $classes = array();

            $classes[] = Bem::bem($block, $element);
            $classes[] = Bem::bem($block, $element, $item->ID);
            $classes[] = Bem::bem($block, $element, $item->object);

            if($item->current) {
                $classes[] = Bem::bem($block, $element, 'current');
            }

            if($item->current_item_ancestor || in_array('current-page-ancestor', $item->classes)) {
                $classes[] = Bem::bem($block, $element, 'ancestor');
            }

            if($item->current_item_parent || in_array('current_page_parent', $item->classes)) {
                $classes[] = Bem::bem($block, $element, 'parent');
            }

            if(in_array('menu-item-has-children', $item->classes)) {
                $classes[] = Bem::bem($block, $element, 'has-children');
            }

            if(in_array('menu-item-home', $item->classes)) {
                $classes[] = Bem::bem($block, $element, 'home');
            }

            if (!empty($item->xfn)) {
                if ($item->xfn == get_query_var('post_type')) {
                    $classes[] = Bem::bem($block, $element, 'current');
                }
            }

            return $classes;
        }

        /**
         * @param $class
         * @param $page
         * @param $depth
         * @param $args
         * @param $current_page
         * @return array
         */
        public function page_css_class($class, $page, $depth, $args, $current_page)
        {

            $block   = isset($args['bem_block']) ? $args['bem_block'] : $args['menu_class'];
            $element = apply_filters('wpbem_page_menu_element', 'item');

            $classes = array();

            $classes[] = Bem::bem($block, $element);
            $classes[] = Bem::bem($block, $element, 'page-' . $page->ID);
            $classes[] = Bem::bem($block, $element, 'depth-' . $depth);

            if($current_page == $page->ID) {
                $classes[] = Bem::bem($block, $element, 'current');
            }

            if(in_array('page_item_has_children', $class)) {
                $classes[] = Bem::bem($block, $element, 'has-children');
            }

            return $classes;

        }

        /**
         * @param $classes
         * @return array
         */
        public function body_class($classes)
        {
            $block = apply_filters('wpbem_body_block', 'body');

            $classes = array_map(function($class) use($block) {
                return Bem::bm($block, $class);
            }, $classes);

            return $classes;
        }

        /**
         * @param $classes
         * @return array
         */
        public function post_class($classes)
        {
            $block = apply_filters('wpbem_post_block', 'post');

            $classes = array_map(function($class) use($block) {

                if('post' == $class) {
                    return $block;
                }

                if('post-' == substr($class, 0, 5)) {
                    $class = substr($class, 5);
                }

                return Bem::bm($block, $class);

            }, $classes);

            return $classes;
        }
    }
    (new CarbonaraLoadBem());

endif;
