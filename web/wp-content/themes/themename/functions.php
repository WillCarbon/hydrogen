<?php

/**
 * ACF Settings
 */
include('lib/ACF.php');

/**
 * Load Theme Classes
 */
include('lib/Theme/Activation.php');
include('lib/Theme/CleanUp.php');
include('lib/Theme/Images.php');
include('lib/Theme/LoadBem.php');
include('lib/Theme/Setup.php');
include('lib/Theme/Scripts.php');
include('lib/Theme/Styles.php');
include('lib/Theme/TinyMCE.php');
include('lib/Theme/TrackingCodes.php');

/**
 * Load Post Types
 */
#include('lib/PostType/ExamplePostType.php');

/**
 * Load REST Routes
 *
 * You need to update REST_NAMESPACE in REST\REST.php
 */
#include('lib/REST/REST.php');
#include('lib/REST/RESTActionInterface.php');
#include('lib/REST/ExampleAction.php');

/**
 * Custom Functions
 */

