<?php
namespace Carbonara\Theme;

use Carbon\Helpers\Theme;

/**
 * Class Scripts
 *
 * @package Carbonara\Theme
 */
class Scripts
{

    /**
     * Scripts constructor.
     */
    public function __construct()
    {
        // Add Blocks Javascript files
        add_action('enqueue_block_editor_assets', [$this, 'registerBlocksScripts'], 1);
        
        // Add Javascript files
        add_action('wp_enqueue_scripts', [$this, 'registerScripts'], 99);

        // Remove JavaScript files
        add_action('wp_enqueue_scripts', [$this, 'deregisterScripts'], 90);
        
        // Apply Async to scripts
        #add_filter('carbon/scripts/async', [$this, 'asyncScripts']);

        // Apply Async to scripts
        #add_filter('carbon/scripts/defer', [$this, 'deferScripts']);

        // Uncomment line below to use custom version of jQuery
        #add_action('wp_enqueue_scripts', [$this, 'replaceJquery'], 5);
    }

    /**
     * Add Blocks Javascript files
     */
    public function registerBlocksScripts()
    {
        wp_enqueue_script(
            'blocks',
            Theme::getUri() . '/build/js_blocks.js',
            ['lodash', 'wp-blocks', 'wp-dom-ready', 'wp-edit-post'],
            Theme::getVersion(),
            true
        );
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
            Theme::getUri() . '/build/js_main.js',
            // Theme::getJs('main'),
            false,
            Theme::getVersion(),
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
     * @param array $list
     * @return array
     */
    public function asyncScripts( $list )
    {
        $list[] = 'main';

        return $list;
    }


    /**
     * @param array $list
     * @return array
     */
    public function deferScripts( $list )
    {
        $list[] = 'main';

        return $list;
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
            Theme::getVendor('jquery/dist/jquery.min.js'),
            false,
            '3.5.1',
            false
        );
    }

}
(new Scripts());
