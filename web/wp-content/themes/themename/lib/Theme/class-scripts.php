<?php
namespace CarbonPress\Theme;

use Carbon\Helpers\Theme;

/**
 * Class Scripts
 *
 * @package CarbonPress\Theme
 */
class Scripts
{

    /**
     * Scripts constructor.
     */
    public function __construct()
    {
        // Add Javascript files
        add_action('wp_enqueue_scripts', [$this, 'register_scripts'], 99);

        // Remove JavaScript files
        add_action('wp_enqueue_scripts', [$this, 'deregister_scripts'], 90);

        // Uncomment line below to use custom version of jQuery
        #add_action('wp_enqueue_scripts', [$this, 'replace_jquery'], 5);
    }

    /**
     * Add Javascript files
     */
    public function register_scripts()
    : void
    {
        // Dont run on Dashboard
        if (is_admin()) return;

        /** Uncomment to add Modernizr */
        /* wp_enqueue_script(
            'modernizr',
            Theme::getJs('modernizr'),
            false,
            Theme::getVersion(),
        ); */

        wp_enqueue_script(
            'main',
            Theme::getJs('main'),
            false,
            Theme::getVersion(),
            [
                //'strategy' => 'async',
                'in_footer' => true,
            ]
        );
    }

    /**
     * Remove JavaScript files
     */
    public function deregister_scripts()
    : void
    {
        // Dont run on Dashboard
        if (is_admin()) return;

        wp_deregister_script('l10n');
    }

    /**
     * Replace WordPress jQuery
     */
    public function replace_jquery()
    : void
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
