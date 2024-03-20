<?php

if ( ! class_exists( 'CP_Block_Example_Image' ) ) {

    class CP_Block_Example_Image
    {

        private CB_Block $block;

        public function __construct()
        {
            if ( !class_exists('CB_Block') )
                return;

            $this->block = new CB_Block();

            $this->block->set_key( 'example-image' );

            $this->block->set_name( __('Example Image', 'carbonpress') );

            $this->block->set_url( CARBONPRESS_URL . '/blocks/example-image/' );

            $this->block->set_dir( CARBONPRESS_DIR . '/blocks/example-image/' );

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
            // $this->block->add_style( Theme::getCss('block-example-image'), '', [
            //     'version' => Theme::getVersion(),
            // ]);

            /**
             * Add additional stylesheets (block-example-image-more.css)
             */
            // $this->block->add_style( Theme::getCss('block-example-image-more'), 'more', [
            //     'version' => Theme::getVersion(),
            // ]);

            /**
             * Set up the Block
             */
            $this->block->add_acf_block([
                'icon'          => 'block-default',
                'textdomain'    => CARBONPRESS_TXTDOMAIN,
                'preview_image' => $this->block->get_url() .'preview.png',
            ]);

        }

    }
    (new CP_Block_Example_Image());

}
