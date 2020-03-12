<?php
/**
 * Blog archive
 */

get_header();

$page = new Carbonite\Mediator\Page('blog');

get_template_part('loop');

get_sidebar();

get_footer();
