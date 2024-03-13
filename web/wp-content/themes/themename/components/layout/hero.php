<?php

    $hero = [];

    if (is_home() && !is_front_page()) {

        $news_id    = get_option('page_for_posts');

        $hero       = get_field('hero', $news_id);
        if ( empty($hero['title']) ) {
            $hero['title']  = __('Latest News', 'carbonpress');
        }

    } elseif ( is_404() ) {

        $hero['title']  = __('Page Not Found', 'carbonpress');

    } elseif ( is_search() ) {

        $hero['title']  = __('Search Results', 'carbonpress');

    } elseif ( is_category() || is_tag() ) {

        $hero['title']      = single_term_title( '', false );
        $hero['subtitle']   = term_description();

    } elseif ( is_archive() ) {

        $hero['title']  = post_type_archive_title( '', false );

    } else {

        $hero       = get_field('hero');
        if ( empty($hero['title']) ) {
            $hero['title']  = get_the_title();
        }
        if ( empty($hero['image']) ) {
            $hero['image']  = get_post_thumbnail_id();
        }
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

            <?php if (isset($hero['subtitle']) && !empty($hero['subtitle'])): $hx++; ?>
            <p class="c-hero__subtitle o-h2 o-fadein o-fadein--1 o-fadein--delay-<?php echo $hx; ?>">
                <?php echo esc_html($hero['subtitle']); ?>
            </p>
            <?php endif; ?>

            <?php if (isset($hero['button']['url']) && !empty($hero['button']['url'])): $hx++; ?>
            <p class="c-hero__cta o-fadein o-fadein--1 o-fadein--delay-<?php echo $hx; ?>">
                <a class="c-button" href="<?php echo esc_url($hero['button']['url']); ?>"<?php if (!empty($hero['button']['target'])) { ' target="'. esc_attr($hero['button']['target']) .'"'; } ?>>
                    <?php echo esc_html($hero['button']['title']); ?>
                </a>
            </p>
            <?php endif; ?>
        </div>
    </div>
</div>
