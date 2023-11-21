<?php

/**
 * Theme Settings
 */
define('CARBONPRESS_FILE',        __FILE__);
define('CARBONPRESS_URL',         get_stylesheet_directory_uri());
define('CARBONPRESS_DIR',         get_stylesheet_directory());
define('CARBONPRESS_ITERATION',   '3.0');


/**
 * ACF Settings
 */
include CARBONPRESS_DIR .'/lib/Theme/class-acf.php';

/**
 * Load Theme Classes
 */
include CARBONPRESS_DIR .'/lib/Theme/class-activation.php';
include CARBONPRESS_DIR .'/lib/Theme/class-gutenberg.php';
include CARBONPRESS_DIR .'/lib/Theme/class-images.php';
include CARBONPRESS_DIR .'/lib/Theme/class-setup.php';
include CARBONPRESS_DIR .'/lib/Theme/class-scripts.php';
include CARBONPRESS_DIR .'/lib/Theme/class-styles.php';
include CARBONPRESS_DIR .'/lib/Theme/class-tinymce.php';

/**
 * Load Post Types
 */
include CARBONPRESS_DIR .'/lib/PostType/class-example-posttype.php';

/**
 * Load Blocks
 */
include CARBONPRESS_DIR .'/lib/Blocks/class-example-block.php';

/**
 * Load REST Routes
 *
 * You need to update REST_NAMESPACE in REST\REST.php
 */
#include( CARBONPRESS_DIR .'/lib/REST/class-rest.php');
#include( CARBONPRESS_DIR .'/lib/REST/class-exampleaction.php');

/**
 * Custom Functions
 */

 function my_add_template_to_posts() {

    $post_type_object = get_post_type_object( 'post' );

    $post_type_object->template = array(
        array( 'core/image', array() ),
        array( 'core/image', array() ),
    );

    $post_type_object->template_lock = 'all';

}

add_action( 'init', 'my_add_template_to_posts' );
