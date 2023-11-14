<?php
namespace CarbonPress\Theme;

/**
 * Class Setup
 *
 * @package CarbonPress\Theme
 */
class Setup
{

    /**
     * Setup constructor.
     */
    public function __construct()
    {
        add_action('init',              [$this, 'register_menus']);
        add_action('after_setup_theme', [$this, 'theme_support']);

        add_filter('excerpt_length',    [$this, 'excerpt_length']);
        add_filter('excerpt_more',      [$this, 'excerpt_more']);
    }


    /**
     * Setup Men Locations
     */
    public function register_menus()
    {
        register_nav_menus([
            'header-menu' => 'Main Menu',
            'footer-menu' => 'Footer Menu'
        ]);
    }


    /**
     * Set up theme support
     */
    public function theme_support()
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
        add_theme_support( 'disable-custom-font-sizes' );
        add_theme_support( 'editor-styles' );
        remove_theme_support( 'core-block-patterns' );
        remove_theme_support( 'block-templates' ); 
    }


    /**
     * @return int
     */
    public function excerpt_length()
    {
        return 40;
    }


    /**
     * @param $more
     * @return string
     */
    public function excerpt_more($more)
    {
        return '…<a href="' . get_permalink() . '">' . 'Read more' . '</a>';
    }

}
(new Setup());