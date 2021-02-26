<?php

    // Check we have modules
    if( !have_rows('modules') )
        return;

    // Loop through modules
    while ( have_rows('modules') ): the_row();

        get_template_part('components/modules/module', get_row_layout());

    endwhile;
