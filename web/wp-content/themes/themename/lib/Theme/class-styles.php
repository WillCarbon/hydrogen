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
        // @TODO: Replace in Carbon Neutral
        add_filter('carbon/theme/css/path', [$this, 'temp_path'], 10, 5);

        // Add Stylesheets
        add_action('wp_enqueue_scripts', [$this, 'register_styles'], 99);

        // Remove Stylesheets
        add_action('wp_enqueue_scripts', [$this, 'deregister_styles'], 98);

        // Add Editor Stylesheet
        add_action( 'admin_init', [$this, 'add_editor_style']);

        // @TODO: Add Admin Stylesheet
        // add_action( 'admin_init', [$this, 'add_admin_style']);
    }

    /**
     * @TODO: Replace in Carbon Neutral
     */
    public function temp_path( $path, $subdir, $name, $ext, $type )
    { 
        $path = get_template_directory_uri() . '/assets/css/dist/';
        return $path;
    }

    /**
     * Add Stylesheets
     */
    public function register_styles()
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
     * Remove Stylesheets
     */
    public function deregister_styles()
    {
        // Dont run on Dashboard
        if (is_admin()) return;

        // Remove default WordPress stylesheet
        wp_dequeue_style('wp-block-library');
    }

    /**
     * Registers an editor stylesheet for the theme.
     */
    public function add_editor_style()
    {   
        add_editor_style( Theme::getCss('editor') );
    }

    /**
     * Registers an admin stylesheet for the theme.
     * @TODO: Set up
     */
    public function add_admin_style()
    {   
        add_editor_style( Theme::getCss('admin') );
    }

}
(new Styles());
