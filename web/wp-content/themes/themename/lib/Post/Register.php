<?php

namespace Carbonite\Post;

use Carbonite\Post\Type\Event;

/**
 * Register all post types
 *
 * Class Register
 * @package Carbonite\Post
 */
class Register
{
    /**
     * Register constructor.
     *
     * Register or de register your post type from here.
     */
    public function __construct()
    {
        #(new Event());
    }

}
