<?php

    $hero = [];

    if (is_home() && !is_front_page()) {

        $news_id    = get_option('page_for_posts');

        $hero       = get_field('hero', $news_id);
        if (!isset($hero['title']) || empty($hero['title'])) {
            $hero['title']  = 'Latest News';
        }

    } elseif ( is_404() ) {

        $hero['title']  = 'Page Not Found';

    } elseif ( is_search() ) {

        $hero['title']  = 'Search Results';

    } elseif ( is_category() || is_tag() ) {

        $hero['title']      = single_term_title( '', false );
        $hero['subtitle']   = term_description();

    } elseif ( is_archive() ) {

        $hero['title']  = post_type_archive_title( '', false );

    } else {

        $hero       = get_field('hero');
        if (!isset($hero['title']) || empty($hero['title'])) {
            $hero['title']  = get_the_title();
        }
    }

    // Fade Delay
    $hx=0;
?>

<div class="c-hero">
    <div class="c-hero__wrap">
        <h1 class="c-hero__title o-fadein o-fadein--1">
            <?php echo $hero['title']; ?>
        </h1>

        <?php if (isset($hero['subtitle']) && !empty($hero['subtitle'])): $hx++; ?>
        <p class="c-hero__subtitle o-h2 o-fadein o-fadein--1 o-fadein--delay-<?php echo $hx; ?>">
            <?php echo $hero['subtitle']; ?>
        </p>
        <?php endif; ?>

        <?php if (isset($hero['button']['url']) && !empty($hero['button']['url'])): $hx++; ?>
        <p class="c-hero__cta o-fadein o-fadein--1 o-fadein--delay-<?php echo $hx; ?>">
            <a class="c-button" href="<?php echo esc_url($hero['button']['url']); ?>"<?php if (!empty($hero['button']['target'])) { ' target="'. esc_attr($hero['button']['target']) .'"'; } ?>>
                <?php echo $hero['button']['title']; ?>
            </a>
        </p>
        <?php endif; ?>
    </div>
</div>
