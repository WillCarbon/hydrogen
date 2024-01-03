<?php
/**
 * Header
 */
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title(''); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script>document.documentElement.classList.remove('no-js');</script>
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header class="c-header o-wrapper-parent">
        <div class="c-header__wrap o-wrapper-centre">
            <div class="c-header__brand">
                <a href="<?php echo home_url('/'); ?>">
                    <?php
                        the_carbon_svg('logo', '/assets/svg/brand-elements/');
                    ?>
                </a>
            </div>
            <div class="c-header__menu">
                <?php
                    get_template_part('components/layout/nav', 'main');

                    get_template_part('components/layout/nav', 'toggle');
                ?>
            </div>
        </div>
    </header>

    <main>
