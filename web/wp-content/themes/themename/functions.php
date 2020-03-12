<?php
/**
 * Custom Functions
 *
 * (None of this works without auto-loader present)
 */

/**
 * Register ACF
 */
(new Carbonite\ACF\Register());

/**
 * Register Theme
 */
(new Carbonite\Theme\Register());

/**
 * Register Post Types
 */
(new Carbonite\Post\Register());

/**
 * Register REST Routes
 *
 * You need to update REST_NAMESPACE in REST\REST.php
 */
(new Carbonite\REST\Register());

/**
 * Register Gravity Forms
 */
(new Carbonite\GravityForms\Register());
