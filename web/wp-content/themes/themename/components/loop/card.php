<?php
    global $cx;

    if (!$cx && $cx!==0) {
        $cx = 0;
    } elseif ($cx<7) {
        $cx++;
    }
?>

    <article class="c-card-item o-fadein o-fadein--1<?php if ($cx>0) { echo ' o-fadein--delay-'. $cx; } ?>">
        <div class="c-card-item__image">
            <?php
                echo get_the_post_thumbnail(get_post(), 'card');
            ?>
        </div>
        <div class="c-card-item__details">

            <h3><?php the_title(); ?></h3>

            <?php the_excerpt(); ?>

            <a href="<?php echo get_permalink(); ?>">Read more</a>

        </div>
    </article>
