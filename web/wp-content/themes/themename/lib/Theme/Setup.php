<?php
namespace Carbonara\Theme;

/**
 * Class Setup
 *
 * @package Carbonara\Theme
 */
class Setup
{

    /**
     * Setup constructor.
     */
    public function __construct()
    {
        if (!isset($GLOBALS['content_width'])) {
            $GLOBALS['content_width'] = 584;
        }

        add_action('init',              [$this, 'registerMenus']);

        // add_action('init',              [$this, 'disableGutenberg']);
        add_action('after_setup_theme', [$this, 'themeSupport']);

        add_filter('excerpt_length',    [$this, 'excerptLength']);
        add_filter('excerpt_more',      [$this, 'excerptMore']);
    }


    /**
     * Setup Men Locations
     */
    public function registerMenus()
    {
        register_nav_menus([
            'header-menu' => 'Main Menu',
            'footer-menu' => 'Footer Menu'
        ]);
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
        add_theme_support('core-block-patterns');
    }


    /**
     * @return int
     */
    public function excerptLength()
    {
        return 40;
    }


    /**
     * @param $more
     * @return string
     */
    public function excerptMore($more)
    {
        return '…<a href="' . get_permalink() . '">' . 'Read more' . '</a>';
    }

}
(new Setup());