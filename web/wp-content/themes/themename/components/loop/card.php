<?php
    global $cx;

    if (!$cx && $cx!==0) {
        $cx = 0;
    } elseif ($cx<7) {
        $cx++;
    }
?>

    <article class="c-cards-item o-fadein o-fadein--1<?php if ($cx>0) { echo ' o-fadein--delay-'. $cx; } ?>">

        <div class="c-cards-item__image">
            <?php
                echo get_the_post_thumbnail(get_post(), 'card');
            ?>
        </div>

        <div class="c-cards-item__body">

            <h3>
                <a href="<?php echo get_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h3>

            <?php the_excerpt(); ?>

        </div>
    </article>
