<?php
namespace CarbonPress\Theme;

use Carbon\Helpers\Theme;

/**
 * Class Styles
 *
 * @package CarbonPress\Theme
 */
class Styles
{

    /**
     * Styles constructor.
     */
    public function __construct()
    {
        // Add Enqueued Stylesheets
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles'], 98);

        // Add Registered Stylesheets
        add_action('wp_enqueue_scripts', [$this, 'register_styles'], 99);

        // Remove Stylesheets
        add_action('wp_enqueue_scripts', [$this, 'deregister_styles'], 98);

        // Add Editor Stylesheet
        add_action( 'admin_init', [$this, 'add_editor_style']);

        // Add Admin Stylesheet
        add_action( 'admin_init', [$this, 'add_admin_style']);
    }


    /**
     * Add Enqueued Stylesheets
     */
    public function enqueue_styles()
    : void
    {
        // Dont run on Dashboard
        if (is_admin()) return;

        wp_enqueue_style(
            'main',
            Theme::getCss('main'),
            false,
            Theme::getVersion(),
            'all'
        );
    }


    /**
     * Add Registered Stylesheets
     */
    public function register_styles()
    : void
    {
        /** Uncomment for your registered files */
        // wp_register_style(
        //     'cp-sliders',
        //     Theme::getCss('sliders'),
        //     false,
        //     Theme::getVersion(),
        //     'all'
        // );
    }


    /**
     * Remove Stylesheets
     */
    public function deregister_styles()
    : void
    {
        // Dont run on Dashboard
        if (is_admin()) return;

        // Remove default WordPress stylesheet
        // wp_dequeue_style('wp-block-library');
    }


    /**
     * Registers an editor stylesheet for the theme.
     */
    public function add_editor_style()
    : void
    {
        add_editor_style( Theme::getCss('editor') );
    }


    /**
     * Registers an admin stylesheet for the theme.
     */
    public function add_admin_style()
    : void
    {
        wp_enqueue_style(
            'cp-admin',
            Theme::getCss('admin'),
            false,
            Theme::getVersion(),
            'all'
        );

        //wp_enqueue_style(
        //    'cp-blocks',
        //    Theme::getCss('blocks'),
        //    false,
        //    Theme::getVersion(),
        //    'all'
        //);
    }

}
(new Styles());
