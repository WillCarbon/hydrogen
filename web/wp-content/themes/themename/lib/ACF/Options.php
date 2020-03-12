<?php

namespace Carbonite\ACF;

/**
 * Class Options
 * @package Carbonite\ACF
 */
class Options
{

    /**
     * Options constructor.
     */
    public function __construct()
    {
        // Add the option page
        add_action('init', [$this, 'options_page']);

        // Set Google Maps Key, if it exists
        add_action('init', [$this, 'google_maps_key']);
    }

    /**
     * Add the option page
     */
    public function options_page()
    {
        if (!function_exists('acf_add_options_page'))
            return;

        acf_add_options_page([
            'page_title'    => 'Website Settings',
            'menu_title'    => 'Website Settings',
            'menu_slug'     => 'web-settings',
            'capability'    => 'manage_options',
            'redirect'      => false
        ]);

        acf_add_options_page([
            'page_title'    => 'Contact Details',
            'menu_title'    => 'Contact Details',
            'menu_slug'     => 'web-contact',
            'parent_slug'   => 'web-settings',
            'capability'    => 'manage_options',
            'redirect'      => false
        ]);

        acf_add_options_page([
            'page_title'    => 'Tracking Codes',
            'menu_title'    => 'Tracking Codes',
            'menu_slug'     => 'tracking-codes',
            'parent_slug'   => 'web-settings',
            'capability'    => 'manage_options',
            'redirect'      => false
        ]);
    }

    /**
     * Set Google Maps Key
     */
    function google_maps_key()
    {
        if (!function_exists('acf_update_setting'))
            return;

        if (!defined('GMAPS_KEY') || empty(GMAPS_KEY))
            return;

        acf_update_setting('google_api_key', GMAPS_KEY);
    }
}
