<?php
namespace Carbonite\Theme;

/**
 * Class Styles
 * @package Carbonite\Theme
 */
class Styles
{
    private $dir;
    private $dirCss;
    private $vendor;
    private $version;

    /**
     * Styles constructor.
     */
    public function __construct()
    {
        // Set file paths
        $this->dir       = get_stylesheet_directory_uri();
        $this->dirCss    = $this->dir . '/styles/dist';
        $this->vendor    = $this->dir . '/vendor';

        $this->version = (defined('SITE_VERSION'))? SITE_VERSION : null;

        // Remove Stylesheets
        add_action('wp_enqueue_scripts', [$this, 'deregister_styles'], 98);

        // Add Stylesheets
        add_action('wp_enqueue_scripts', [$this, 'register_styles'], 99);
    }

    /**
     * Remove Stylesheets
     */
    public function deregister_styles()
    {
        if (is_admin())
            return;

        // Remove default WordPress stylesheet
        wp_dequeue_style('wp-block-library');
    }

    /**
     * Add Stylesheets
     */
    public function register_styles()
    {
        if (is_admin())
            return;

        wp_enqueue_style(
            'main',
            $this->dirCss . '/main.css',
            false,
            $this->version,
            'all'
        );
    }

}
