<?php
namespace Carbonara\Theme;

use Carbon\Helpers\Theme;

/**
 * Class Styles
 *
 * @package Carbonara\Theme
 */
class Styles
{

    /**
     * Styles constructor.
     */
    public function __construct()
    {
        // Remove Stylesheets
        add_action('wp_enqueue_scripts', [$this, 'deregisterStyles'], 98);

        // Add Stylesheets
        add_action('wp_enqueue_scripts', [$this, 'registerStyles'], 99);

        // Add Editor Stylesheet
        add_action( 'admin_init', [$this, 'addEditorStyle']);
    }

    /**
     * Add Stylesheets
     */
    public function registerStyles()
    {
        // Dont run on Dashboard
        if (is_admin()) return;

        wp_enqueue_style(
            'main',
            Theme::getUri() . '/build/css_main.css',
            // Theme::getCss('main', '.css'),
            false,
            Theme::getVersion(),
            'all'
        );
    }

    /**
     * Remove Stylesheets
     */
    public function deregisterStyles()
    {
        // Dont run on Dashboard
        if (is_admin()) return;

        // Remove default WordPress stylesheet
        wp_dequeue_style('wp-block-library');
    }

    /**
     * Registers an editor stylesheet for the theme.
     */
    public function addEditorStyle()
    {   
        add_editor_style( Theme::getUri() . '/build/css_editor.css' );

        // wp_enqueue_style(
        //     'admin_css', 
        //     Theme::getUri() . '/build/css_editor.css',
        //     // Theme::getCss('editor', '.css'), 
        //     false, 
        //     Theme::getVersion() 
        // );
    }

}
(new Styles());
