<?php
namespace Carbonite\Theme;

/**
 * Class Scripts
 * @package Carbonite\Theme
 */
class Scripts
{
    private $dir;
    private $dirJs;
    private $vendor;
    private $version;

    /**
     * Scripts constructor.
     */
    public function __construct()
    {
        $this->dir       = get_stylesheet_directory_uri();
        $this->dirJs     = $this->dir . '/js/dist';
        $this->vendor    = $this->dir . '/vendor';

        $this->version = (defined('SITE_VERSION'))? SITE_VERSION : null;

        // Uncomment line below to use custom version of jQuery
        #add_action('wp_enqueue_scripts', [$this, 'replaceJquery'], 5);

        // Remove JavaScript files
        add_action('wp_enqueue_scripts', [$this, 'deregister_scripts'], 90);

        // Add Javascript files
        add_action('wp_enqueue_scripts', [$this, 'register_scripts'], 99);

        // Load Lazy Sizes
        add_action('wp_enqueue_scripts', [$this, 'load_lazysizes'], 94);

        // Uncomment line below to load Google Maps
        #add_action('wp_enqueue_scripts', [$this, 'load_google_maps'], 96);

        add_filter('script_loader_tag' , [$this, 'add_script_attributes'],    10, 2);
        #add_filter('script_loader_tag' , [$this, 'remove_script_attributes'], 10, 2);
    }

    /**
     * Replace WordPress jQuery
     */
    public function replaceJquery()
    {
        if (is_admin())
            return;

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

    /**
     * Remove JavaScript files
     */
    public function deregister_scripts()
    {
        if (is_admin())
            return;

        wp_deregister_script('l10n');
    }

    /**
     * Add Javascript files
     */
    public function register_scripts()
    {
        if (is_admin())
            return;

        wp_enqueue_script(
            'main',
            $this->dirJs.'/main.js',
            false,
            $this->version,
            true
        );
    }

    /**
     * Load Lazy Sizes
     */
    public function load_lazysizes()
    {
        wp_enqueue_script(
            'unveilhooks',
            $this->vendor.'/lazysizes/plugins/unveilhooks/ls.unveilhooks.min.js',
            false,
            '5.1.0',
            true
        );

        wp_enqueue_script(
            'lazysizes',
            $this->vendor.'/lazysizes/lazysizes.min.js',
            ['unveilhooks'],
            '5.1.0',
            true
        );
    }

    /**
     * Load Google Maps
     */
    public function load_google_maps()
    {
        // Get API Key
        $key = (defined('GMAPS_KEY'))? GMAPS_KEY : '';

        // Stop if no key available
        if (empty($key))
            return;

        // Register script
        wp_enqueue_script(
            'google-maps',
            'https://maps.googleapis.com/maps/api/js?key='.$key,
            false,
            null,
            true
        );
    }


    /**
     * @param string $tag
     * @param string $handle
     * @return string
     */
    public function add_script_attributes($tag, $handle)
    {
        // async
        $asyncScripts = [
            'unveilhooks',
            'lazysizes',
            'wp-embed',
            'main'
        ];

        foreach($asyncScripts as $file) {
            if ($file == $handle) {
                $tag = str_replace(' src', ' async=\'async\' src', $tag);
            }
        }

        // defer
        $deferScripts = [];
        foreach($deferScripts as $file) {
            if ($file == $handle) {
                $tag = str_replace(' src', ' defer=\'defer\' src', $tag);
            }
        }

        return $tag;
    }

    /**
     * @param string $tag
     * @return string
     */
    public function remove_script_attributes($tag)
    {
        return str_replace(' type=\'text/javascript\'', '', $tag);
    }

}
