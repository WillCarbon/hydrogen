<?php
    // Get hero fields
    $hero = [
        'title'     => get_field('title'),
        'subtitle'  => get_field('subtitle'),
        'button'    => get_carbon_button(get_field('button')),
        'image'     => get_field('image'),
    ];

    // Ensure we have a title
    if ( empty($hero['title']) ) {
        $hero['title']  = get_the_title();
    }

    // Fallback image
    if ( empty($hero['image']) ) {
        $hero['image']  = get_field('fallback_hero', 'options');
    }

    // Fade Delay
    $hx=0;
?>

<div class="c-hero o-wrapper-parent">
    <div class="c-hero__wrap o-wrapper-centre">

        <figure class="c-hero__image">
            <?php
                if ( !empty($hero['image']) ):
                    echo wp_get_attachment_image($hero['image'], 'hero');
                endif;
            ?>
        </figure>

        <div class="c-hero__content">
            <h1 class="c-hero__title o-fadein o-fadein--1">
                <?php echo esc_html($hero['title']); ?>
            </h1>

            <?php if (!empty($hero['subtitle'])): $hx++; ?>
                <p class="c-hero__subtitle o-h2 o-fadein o-fadein--1 o-fadein--delay-<?php echo $hx; ?>">
                    <?php echo esc_html($hero['subtitle']); ?>
                </p>
            <?php endif; ?>

            <?php if (!empty($hero['button']['url'])): $hx++; ?>
                <p class="c-hero__cta o-fadein o-fadein--1 o-fadein--delay-<?php echo $hx; ?>">
                    <a class="c-button" href="<?php echo $hero['button']['url']; ?>" target="<?php echo $hero['button']['target']; ?>">
                        <?php echo $hero['button']['title']; ?>
                    </a>
                </p>
            <?php endif; ?>
        </div>

    </div>
</div>
