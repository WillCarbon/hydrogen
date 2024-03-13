<?php

/**
 * Class ExampleBlock
 */
if ( ! class_exists( 'ExampleImage' ) ) {
    class ExampleImage extends CB_Base_Block
    {
        /**
         * ExampleBlock constructor.
         */
        public function __construct()
        {
            $this->set_key( 'example-image' );

            $this->set_name( __('Example Image', 'carbonpress') );

            $this->set_url( CARBONPRESS_URL . '/blocks/example-image/' );

            $this->set_dir( CARBONPRESS_DIR . '/blocks/example-image/' );

            add_action( 'init', [$this, 'register'] );
        }


        /**
         * Register block
         *
         * @return void
         */
        public function register()
        : void
        {

            /**
             * Add default stylesheet (block-example-image.css)
             */
            // $this->add_style( Theme::getCss('block-example-image'), '', [
            //     'version' => Theme::getVersion(),
            // ]);

            /**
             * Add additional stylesheets (block-example-image-more.css)
             */
            // $this->add_style( Theme::getCss('block-example-image-more'), 'more', [
            //     'version' => Theme::getVersion(),
            // ]);

            /**
             * Set up the Block
             */
            $this->add_acf_block([
                'icon'          => 'block-default',
                'textdomain'    => CARBONPRESS_TXTDOMAIN,
                'preview_image' => get_carbon_img_url('/blocks/example-image/preview.png'),
            ]);

        }

    }
    (new ExampleImage());

}
