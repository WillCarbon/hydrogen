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

/**
 * Disable lock/unlock functionality on blocks
 */
function disableLockBlocks( $settings, $context ) {
	$settings['canLockBlocks'] = false;

	return $settings;
}

add_filter( 'block_editor_settings_all', 'disableLockBlocks', 10, 2 );

/**
 * Example post type block structure
 */
function block_template_example() {
    $post_type_object = get_post_type_object( 'example' );

    $post_type_object->template = array(
        array( 'core/media-text', array(
			'variation' => 'media-text-img-right'
		) ),
    );

    $post_type_object->template_lock = 'all';
}

add_action( 'init', 'block_template_example' );

/**
 * Page block structure
 */
function register_block_template() {
	$block_template = array(
        array('core/columns', array(),
			array('core/column', array('width' => 33.33), array(
				array('core/paragraph', array()),
			)),
			array('core/column', array('width' => 66.66), array(
				array('core/paragraph', array()),
			)),
		)
    );
	
    $post_type_object                = get_post_type_object( 'page' );
    $post_type_object->template      = $block_template;
    $post_type_object->template_lock = 'all';
}

// add_action( 'init', 'register_block_template' );