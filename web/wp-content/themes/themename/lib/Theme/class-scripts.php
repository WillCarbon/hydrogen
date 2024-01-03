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
        // @TODO: Replace in Carbon Neutral
        #add_filter('carbon/theme/js/path', [$this, 'temp_path'], 10, 5);

        // Add Blocks Javascript files
        // add_action('enqueue_block_editor_assets', [$this, 'register_blocks_scripts'], 1);

        // Add Javascript files
        add_action('wp_enqueue_scripts', [$this, 'register_scripts'], 99);

        // Remove JavaScript files
        add_action('wp_enqueue_scripts', [$this, 'deregister_scripts'], 90);

        // Apply Async to scripts
        #add_filter('carbon/scripts/async', [$this, 'async_scripts']);

        // Apply Async to scripts
        #add_filter('carbon/scripts/defer', [$this, 'defer_scripts']);

        // Uncomment line below to use custom version of jQuery
        #add_action('wp_enqueue_scripts', [$this, 'replace_jquery'], 5);
    }

    /**
     * @TODO: Replace in Carbon Neutral
     */
    public function temp_path( $path, $subdir, $name, $ext, $type )
    {
        $path = get_template_directory_uri() . '/assets/js/dist/';
        return $path;
    }

    /**
     * Add Blocks Javascript files
     */
    public function register_blocks_scripts()
    {
        wp_enqueue_script(
            'blocks',
            Theme::getJs('blocks'),
            ['lodash', 'wp-blocks', 'wp-dom-ready', 'wp-edit-post'],
            Theme::getVersion(),
            true
        );
    }

    /**
     * Add Javascript files
     */
    public function register_scripts()
    {
        // Dont run on Dashboard
        if (is_admin()) return;

        wp_enqueue_script(
            'main',
            Theme::getJs('main'),
            false,
            Theme::getVersion(),
            true
        );
    }

    /**
     * Remove JavaScript files
     */
    public function deregister_scripts()
    {
        // Dont run on Dashboard
        if (is_admin()) return;

        wp_deregister_script('l10n');
    }

    /**
     * @param array $list
     * @return array
     */
    public function async_scripts( $list )
    {
        $list[] = 'main';

        return $list;
    }

    /**
     * @param array $list
     * @return array
     */
    public function defer_scripts( $list )
    {
        $list[] = 'main';

        return $list;
    }

    /**
     * Replace WordPress jQuery
     */
    public function replace_jquery()
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
