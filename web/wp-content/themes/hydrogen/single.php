<?php
/**
 * Single post
 */

get_header(); the_post();

    get_template_part('components/layout/hero');

    get_template_part('components/modules/content');

    get_sidebar();

get_footer();
