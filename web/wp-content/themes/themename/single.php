<?php
/**
 * Single post
 */

get_header(); the_post();

$page = new Carbonite\Mediator\Page();

// Post markup here

get_sidebar();

get_footer();
