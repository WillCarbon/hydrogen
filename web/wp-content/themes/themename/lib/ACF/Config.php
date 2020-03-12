<?php

namespace Carbonite\ACF;

/**
 * Class Config
 * @package Carbonite\ACF
 */
class Config
{

    /**
     * Config constructor.
     */
    public function __construct()
    {
        // Load the config files from config directory
        add_filter('acf/settings/load_json', [$this, 'load_config']);

        // Save the config files in to config directory
        add_filter('acf/settings/save_json', [$this, 'save_config']);
    }

    /**
     * Load the config files from config directory
     *
     * @param array $paths
     * @return array
     */
    public function load_config($paths)
    {
        unset($paths[0]);
        $paths[] = get_stylesheet_directory() . '/config';
        return $paths;
    }

    /**
     * Save the config files in to config directory
     *
     * @param string $path
     * @return string
     */
    public function save_config($path)
    {
        $path = get_stylesheet_directory() . '/config';
        return $path;
    }
}
