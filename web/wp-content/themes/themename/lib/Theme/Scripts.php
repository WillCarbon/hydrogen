<?php

/**
 * Class CarbonScripts
 */
class CarbonScripts
{
    private $dir;
    private $dirJs;
    private $vendor;
    private $version;

    /**
     * CarbonScripts constructor.
     */
    public function __construct()
    {
        $this->dir       = get_stylesheet_directory_uri();
        $this->dirJs     = $this->dir . '/js/dist';
        $this->vendor    = $this->dir . '/vendor';

        $this->version = (defined('SITE_VERSION'))? SITE_VERSION : null;

        // Add Javascript files
        add_action('wp_enqueue_scripts', [$this, 'registerScripts'], 99);

        // Remove JavaScript files
        add_action('wp_enqueue_scripts', [$this, 'deregisterScripts'], 90);

        // Uncomment line below to use custom version of jQuery
        #add_action('wp_enqueue_scripts', [$this, 'replaceJquery'], 5);
    }

    /**
     * Add Javascript files
     */
    public function registerScripts()
    {
        // Dont run on Dashboard
        if (is_admin()) return;

        wp_enqueue_script(
            'main',
            $this->dirJs.'/main.js',
            false,
            $this->version,
            true
        );
    }

    /**
     * Remove JavaScript files
     */
    public function deregisterScripts()
    {
        // Dont run on Dashboard
        if (is_admin()) return;

        wp_deregister_script('l10n');
    }


    /**
     * Replace WordPress jQuery
     */
    public function replaceJquery()
    {
        // Dont run on Dashboard
        if (is_admin()) return;

        // Remove WordPress version
        wp_deregister_script('jquery');

        // Load version from Node
        wp_enqueue_script(
            'jquery',
            $this->vendor.'/jquery/dist/jquery.min.js',
            false,
            '3.4.1',
            false
        );
    }

}
(new CarbonScripts());
