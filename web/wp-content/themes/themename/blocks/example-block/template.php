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

$block_name = 'b-example';
$block_class = 'b-block ' . $block_name;
$block_wrap_class = 'b-block__wrap ' . $block_name . '__wrap';

if ( $block['backgroundColor'] ) {
    $block_class .= ' has-background has-' . $block['backgroundColor'] . '-background-color ';
    $block_class .= ' o-background o-background--' . $block['backgroundColor'];
}

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class_name = '';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
?>

<div class="<?php echo $block_class; ?> <?php echo esc_attr( $class_name ); ?>">
    <div class="<?php echo $block_wrap_class; ?>" <?php echo $anchor; ?>>

        Example

    </div>
</div>
