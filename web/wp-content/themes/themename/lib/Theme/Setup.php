<?php
if (!class_exists('CarbonaraSetup')):

    /**
     * Class CarbonaraSetup
     */
    class CarbonaraSetup
    {

        /**
         * CarbonaraSetup constructor.
         */
        public function __construct()
        {
            if (!isset($GLOBALS['content_width'])) {
                $GLOBALS['content_width'] = 584;
            }

            add_action('init',              [$this, 'disableGutenberg']);
            add_action('after_setup_theme', [$this, 'themeSupport']);
            add_filter('upload_mimes',      [$this, 'uploadMimeTypes']);
            add_action('init',              [$this, 'registerMenus']);

            add_filter('excerpt_length',    [$this, 'excerptLength']);
            add_filter('excerpt_more',      [$this, 'excerptMore']);

            add_action('template_redirect', [$this, 'prettySearchUrl']);
        }

        /**
         * Disable WordPress v5 Gutenberg editor
         */
        public function disableGutenberg()
        {
            add_filter('use_block_editor_for_post', '__return_false', 10);
        }

        /**
         * Set up theme support
         */
        public function themeSupport()
        {
            add_theme_support('menus');
            add_theme_support('widgets');
            add_theme_support('post-thumbnails');
            add_theme_support('automatic-feed-links');
            add_theme_support('html5', [
                'search-form',
                'comment-list',
                'comment-form'
            ]);
        }

        public function uploadMimeTypes($types) {
            $types['svg'] = 'image/svg+xml';
            return $types;
        }

        public function registerMenus()
        {
            register_nav_menus([
                'header-menu' => 'Main Menu',
                'footer-menu' => 'Footer Menu'
            ]);
        }

        public function excerptLength()
        {
            return 40;
        }

        public function excerptMore($more)
        {
            return '…<a href="' . get_permalink() . '">' . 'Read more' . '</a>';
        }

        public function moveYoast()
        {
            return 'low';
        }

        public function prettySearchUrl()
        {
            if(is_search() && !empty($_GET['s'])) {
                wp_redirect(get_search_link());
                exit();
            }
        }
    }
    (new CarbonaraSetup());

endif;
