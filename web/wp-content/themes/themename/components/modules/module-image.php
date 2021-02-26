
<div class="c-module c-module-image">
    <div class="c-module-image__wrap">
        <?php
            $image = get_sub_field('image');
            echo wp_get_attachment_image($image, 'medium');
        ?>
    </div>
</div>
