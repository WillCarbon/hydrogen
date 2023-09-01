<?php
    function my_plugin_register_my_patterns() {
        register_block_pattern(
            'carbonpattern/test',
            array(
                'title'       => __( 'Text and image', 'carbonpattern' ),
                'description' => _x( 'Some text, and an image.', 'Some text, and an image.', 'carbonpattern' ),
                'categories'  => array( 'text' ),
                'content'     => '<!-- wp:heading {"fontSize":"large"} -->
                <h2 class="has-large-font-size"><span style="color:#ba0c49" class="has-inline-color">Hi everyone</span></h2>
                <!-- /wp:heading -->',
                'templateTypes' => array( 'page', 'single' ),
            )
        );
    }
    
    add_action( 'init', 'my_plugin_register_my_patterns' );
?>