<?php
/**
 * Page
 */

get_header(); the_post();

$page = new Carbonite\Mediator\Page();

// Page markup here

get_sidebar();

get_footer();
