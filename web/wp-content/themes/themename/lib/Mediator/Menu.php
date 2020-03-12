<?php

namespace Carbonite\Mediator;

class Menu
{
    protected static $menuStorage = [];

    public static function getMenu($menuLocation, $bemBlock)
    {
        global $post;
        $menuStorage = &self::$menuStorage;
        $outputItems = [];

        $args = [
            'theme_location' => $menuLocation,
            'bem_block' => $bemBlock
        ];
        $args = apply_filters('wp_nav_menu_args', $args);
        $args = (object) $args;

        /**
         * Get menu locations
         */
        if (empty($menuStorage['locations'])) {
            $menuStorage['locations'] = get_nav_menu_locations();
        }

        /**
         * If our location exists, grab the menu items
         */
        if (!empty($menuStorage['locations'][$menuLocation])) {
            /**
             * Grab the menu items if we don't have them stored
             */
            if (empty($menuStorage[$menuLocation]['items'])) {
                $menuStorage[$menuLocation]['items'] = wp_get_nav_menu_items($menuStorage['locations'][$menuLocation]);
            }

            /**
             * Add WordPress classes to each menu item
             */
            _wp_menu_item_classes_by_context($menuStorage[$menuLocation]['items']);

            /**
             * Loop through items and prepare them for output
             */
            foreach ($menuStorage[$menuLocation]['items'] as $item) {
                $item->classes = apply_filters('nav_menu_css_class', $item->classes, $item, $args);

                if ($item->menu_item_parent == 0) {
                    $outputItems[$item->ID] = [
                        'title'    => $item->title,
                        'url'      => $item->url,
                        'id'       => $item->object_id,
                        'current'  => $item->current,
                        'classes'  => $item->classes,
                        'children' => []
                    ];
                    continue;
                }

                $outputItems[$item->menu_item_parent]['children'][$item->ID] = [
                    'title' => $item->title,
                    'url'   => $item->url,
                    'order' => $item->menu_order,
                    'id'    => $item->object_id
                ];
            }

            uasort($menuStorage, function($a, $b) {
                $ao = (isset($a['order']))? $a['order'] : 0;
                $bo = (isset($b['order']))? $b['order'] : 0;
                return ($ao < $bo) ? -1 : 1;
            });

            return $outputItems;
        }

        return false;
    }

    public static function getPageAncestors($id = '')
    {
        if (!empty($id)) {
            $post = get_post($id);
        } else {
            global $post;
        }
        return [
            'post'      => $post->ID,
            'parent'    => $post->post_parent,
            'ancestors' => array_reverse($post->ancestors)
        ];
    }

    public static function getChildPages($parent = '')
    {
        if (empty($parent)) {
            $ancestors = self::getPageAncestors();

            switch (count($ancestors['ancestors'])) {
                case 2:
                    $parent = $ancestors['ancestors'][0];
                    break;
                case 1:
                    $parent = $ancestors['parent'];
                    break;
                default:
                    $parent = $ancestors['post'];
            }
        }

        $pages = get_pages([
            'parent'      => $parent,
            'sort_column' => 'menu_order'
        ]);

        return (!empty($pages)) ? $pages : false;
    }

    public static function getPageMenu($id = '')
    {
        global $post;
        if (!empty($pages = self::getChildPages($id))) {
            $menuStorage = [];

            foreach($pages as $page) {
                $menuStorage[$page->ID] = [
                    'title'     =>  $page->post_title,
                    'url'       =>  get_permalink($page->ID),
                    'active'    =>  Helpers::isActive($page->ID, $post->ID)
                ];

                if(!empty($children = self::getChildPages($page->ID))) {
                    $childStorage = [];
                    foreach($children as $child) {
                        $childStorage[$child->ID] = [
                            'title'     =>  $child->post_title,
                            'url'       =>  get_permalink($child->ID),
                            'active'    =>  ($child->ID == $post->ID)
                        ];
                    }
                    $menuStorage[$page->ID]['children'] = $childStorage;
                }
            }

            return $menuStorage;
        } else {
            return false;
        }
    }

    public static function getCategoryList($taxonomy = 'category', $hideEmpty = true)
    {
        $categoryStorage = [];
        foreach (get_categories(['taxonomy' => $taxonomy, 'hide_empty' => $hideEmpty]) as $cat) {
            if ($cat->category_parent == 0) {
                $categoryStorage[$cat->cat_ID] = [
                    'title' => $cat->name,
                    'id'    => $cat->cat_ID,
                    'url'   => get_category_link($cat->cat_ID),
                    'child' => []
                ];
                continue;
            }

            $categoryStorage[$cat->category_parent]['child'][$cat->cat_ID] = [
                'title' => $cat->name,
                'id'    => $cat->cat_ID,
                'link'  => get_category_link($cat->cat_ID),
            ];
        }
        return $categoryStorage;
    }
}
