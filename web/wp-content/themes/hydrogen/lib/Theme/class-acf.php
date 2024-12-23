<?php
namespace CarbonPress\Theme;

/**
 * Class ACF
 *
 * @package CarbonPress\Theme
 */
class ACF
{

    /**
     * ACF constructor.
     */
    public function __construct()
    {
        // add_filter('carbon/acf/option_pages', [$this, 'optionPages']);
    }

    /**
     * Add / Remove ACF Option Pages
     *
     * @param array $pages
     * @return array
     */
    public function optionPages( $pages )
    {

        // Example Settings
        $pages['example-settings'] = [
            'page_title'    => 'Example Settings',
            'menu_title'    => 'Example Settings',
            'menu_slug'     => 'example-settings',
            'capability'    => 'manage_options',
            'parent_slug'   => 'edit.php?post_type=example',
            'redirect'      => false
        ];

        return $pages;
    }

}
(new ACF());
