<?php
/**
 * The loop
 */
if ( have_posts() ) {

    while(have_posts()) : the_post();

        get_template_part( 'components/loop/card', get_post_type() );

    endwhile;

} else {

    get_template_part( 'components/loop/empty' );

}
