<?php

if ( ! class_exists( 'CP_Block_Example_Text' ) ) {

    class CP_Block_Example_Text
    {

        private CB_Block $block;

        public function __construct()
        {
            if ( !class_exists('CB_Block') )
                return;

            $this->block = new CB_Block();

            $this->block->set_key( 'example-text' );

            $this->block->set_name( __('Example Text', 'carbonpress') );

            $this->block->set_url( CARBONPRESS_URL . '/blocks/example-text/' );

            $this->block->set_dir( CARBONPRESS_DIR . '/blocks/example-text/' );

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
            // $this->block->add_style( Theme::getCss('block-example-text'), '', [
            //     'version' => Theme::getVersion(),
            // ]);

            /**
             * Add additional stylesheets (block-example-text-more.css)
             */
            // $this->block->add_style( Theme::getCss('block-example-text-more'), 'more', [
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
    (new CP_Block_Example_Text());

}
