<?php

/**
 * Class CP_Block_Example_Text
 */
if ( ! class_exists( 'CP_Block_Example_Text' ) ) {

    class CP_Block_Example_Text extends CB_Base_Block
    {
        /**
         * ExampleBlock constructor.
         */
        public function __construct()
        {
            $this->set_key( 'example-text' );

            $this->set_name( __('Example Text', 'carbonpress') );

            $this->set_url( CARBONPRESS_URL . '/blocks/example-text/' );

            $this->set_dir( CARBONPRESS_DIR . '/blocks/example-text/' );

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
             * Add default stylesheet (block-example-text.css)
             */
            // $this->add_style( Theme::getCss('block-example-text'), '', [
            //     'version' => Theme::getVersion(),
            // ]);

            /**
             * Add additional stylesheets (block-example-text-more.css)
             */
            // $this->add_style( Theme::getCss('block-example-text-more'), 'more', [
            //     'version' => Theme::getVersion(),
            // ]);

            /**
             * Set up the Block
             */
            $this->add_acf_block([
                'icon'          => 'block-default',
                'textdomain'    => CARBONPRESS_TXTDOMAIN,
                'preview_image' => get_carbon_img_url('/blocks/example-text/preview.png'),
            ]);

        }

    }
    (new CP_Block_Example_Text());

}
