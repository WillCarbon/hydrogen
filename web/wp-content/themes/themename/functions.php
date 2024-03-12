<?php

/**
 * Theme Settings
 */
define('CARBONPRESS_FILE',      __FILE__);
define('CARBONPRESS_URL',       get_stylesheet_directory_uri());
define('CARBONPRESS_DIR',       get_stylesheet_directory());
define('CARBONPRESS_TXTDOMAIN', 'carbonpress');
define('CARBONPRESS_ITERATION', '3.0');


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
include CARBONPRESS_DIR .'/lib/Theme/class-localise.php';
include CARBONPRESS_DIR .'/lib/Theme/class-setup.php';
include CARBONPRESS_DIR .'/lib/Theme/class-scripts.php';
include CARBONPRESS_DIR .'/lib/Theme/class-styles.php';
include CARBONPRESS_DIR .'/lib/Theme/class-tinymce.php';

/**
 * Load Custom Post Types
 */
include CARBONPRESS_DIR .'/lib/PostType/class-example-posttype.php';

/**
 * Load Custom Blocks
 */
//include CARBONPRESS_DIR .'/blocks/example-block/register.php';

/**
 * Load REST Routes
 *
 * You need to update REST_NAMESPACE in REST\REST.php
 */
//include( CARBONPRESS_DIR .'/lib/REST/class-rest.php');
//include( CARBONPRESS_DIR .'/lib/REST/class-exampleaction.php');

/**
 * Custom Functions
 */
include( CARBONPRESS_DIR .'/lib/Custom/class-carbon-overwrite.php');
#include( CARBONPRESS_DIR .'/lib/Custom/class-custom-example.php');

add_filter('carbon/walker/accessibility', '__return_true');
