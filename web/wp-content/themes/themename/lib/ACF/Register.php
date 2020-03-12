<?php

namespace Carbonite\ACF;

/**
 * Class Register
 * @package Carbonite\ACF
 */
class Register
{

    /**
     * Register constructor.
     */
    public function __construct()
    {
        (new Config());
        (new Options());

        // Block editing for the live website
        add_filter('acf/settings/capability', [$this, 'check_editable'], 1);
    }

    /**
     * Block editing for the live website
     *
     * @param $capability
     * @return string
     */
    public function check_editable($capability)
    {
        return (WP_DEBUG)? 'administrator' : 'block-edits';
    }

}
