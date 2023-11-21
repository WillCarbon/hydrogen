<?php
/**
 * Page
 */

get_header(); the_post();

    ?><!-- wp:template-part {"slug":"hero"} /--><?php

    get_template_part('components/layout/hero');

    get_template_part('components/modules/content');

get_footer();
