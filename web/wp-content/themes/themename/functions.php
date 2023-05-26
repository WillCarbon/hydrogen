<?php

/**
 * Theme Settings
 */
define('CARBONARA_FILE',        __FILE__);
define('CARBONARA_URL',         get_stylesheet_directory_uri());
define('CARBONARA_DIR',         get_stylesheet_directory());
define('CARBONARA_ITERATION',   '2.0');


/**
 * ACF Settings
 */
include( CARBONARA_DIR .'/lib/Theme/ACF.php');

/**
 * Load Theme Classes
 */
include( CARBONARA_DIR .'/lib/Theme/Activation.php');
include( CARBONARA_DIR .'/lib/Theme/Gutenberg.php');
include( CARBONARA_DIR .'/lib/Theme/Images.php');
include( CARBONARA_DIR .'/lib/Theme/Setup.php');
include( CARBONARA_DIR .'/lib/Theme/Scripts.php');
include( CARBONARA_DIR .'/lib/Theme/Styles.php');
include( CARBONARA_DIR .'/lib/Theme/TinyMCE.php');

/**
 * Load Post Types
 */
include( CARBONARA_DIR .'/lib/PostType/ExamplePostType.php');

/**
 * Load REST Routes
 *
 * You need to update REST_NAMESPACE in REST\REST.php
 */
#include( CARBONARA_DIR .'/lib/REST/REST.php');
#include( CARBONARA_DIR .'/lib/REST/RESTActionInterface.php');
#include( CARBONARA_DIR .'/lib/REST/ExampleAction.php');

/**
 * Custom Functions
 */

add_filter( 'carbonberg/blocks/text-image/text/type', 'editorType' );

function editorType() {
    return 'wysiwyg';
}
