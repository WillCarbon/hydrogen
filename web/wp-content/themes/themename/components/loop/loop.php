<?php
/**
 * The loop
 */

    if ( have_posts() ) {
?>

    <div class="c-card-list o-wrapper-parent">
        <div class="c-card-list__wrap o-wrapper-centre">
            <?php
                while(have_posts()) : the_post();

                    get_template_part( 'components/loop/card', get_post_type() );

                endwhile;
                wp_reset_postdata();
            ?>
        </div>
    </div>

<?php

        get_template_part( 'components/loop/pagination');

    } else {

        get_template_part( 'components/loop/empty' );

    }
