<?php
/**
 * Example Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

$block_name     = 'example-image';
$block_class    = ['o-block', 'b-example-image'];
$wrap_class     = ['o-block-wrap', 'b-example-image__wrap'];

// Grab ACF fields
$image = get_field('image');
$image = wp_get_attachment_image($image, 'medium');
if ( empty($image) )
    return;

// Optional anchor
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = ' id="' . esc_attr( $block['anchor'] ) . '"';
}

// Add background styling
if ( !empty($block['backgroundColor']) ) {
    $block_class[] = 'has-background';
    $block_class[] = 'has-background--' . $block['backgroundColor'];
    $block_class[] = 'o-background';
    $block_class[] = 'o-background--' . $block['backgroundColor'];
}

// Additional classes
if ( ! empty( $block['className'] ) ) {
    $block_class[] = $block['className'];
}

// Enqueue stylesheets
if ( !empty($block['style_handles']) ) {
    foreach ($block['style_handles'] as $handle) {
        wp_enqueue_style($handle);
    }
}
?>

<section<?php echo $anchor; ?> class="<?php echo implode(' ', $block_class); ?>">
    <div class="<?php echo implode(' ', $wrap_class); ?>">

        <?php echo $image; ?>

    </div>
</section>
