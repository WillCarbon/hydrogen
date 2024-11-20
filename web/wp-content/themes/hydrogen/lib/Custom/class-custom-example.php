<?php
namespace CarbonPress\Custom;

/**
 * Class CustomExample
 *
 * @package CarbonPress\Theme
 */
class CustomExample
{

    /**
     * CustomExample constructor.
     */
    public function __construct()
    {
        add_filter('pre_get_query', [$this, 'custom_query']);
    }


    /**
     * Example Function
     * Replace with your own overwrite
     *
     * @param \WP_Query $query
     * @return void
     */
    public function custom_query( \WP_Query $query )
    : void
    {
        if(!is_admin() && $query->is_main_query()) {
            $query->set('posts_per_page', 12);
        }
    }

}
(new CustomExample());
