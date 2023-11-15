<?php
/**
 * The loop
 */

    if ( have_posts() ) {
?>

    <div class="c-cards o-wrapper-parent">
        <div class="c-cards__wrap o-wrapper-centre">

            <div class="c-cards-list">
                <?php
                    while(have_posts()) : the_post();

                        get_template_part( 'components/loop/card', get_post_type() );

                    endwhile;
                    wp_reset_postdata();
                ?>
            </div>

        </div>
    </div>

<?php

        get_template_part( 'components/loop/pagination');

    } else {

        get_template_part( 'components/loop/empty' );

    }
