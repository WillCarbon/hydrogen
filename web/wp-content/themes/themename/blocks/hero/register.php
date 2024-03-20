<?php

if ( ! class_exists( 'CP_Block_Hero' ) ) {

    class CP_Block_Hero extends CB_Base_Block
    {

        private CB_Block $block;

        public function __construct()
        {
            if ( !class_exists('CB_Block') )
                return;

            $this->block = new CB_Block();

            $this->block->set_key( 'hero' );

            $this->block->set_name( __('Hero', 'carbonpress') );

            $this->block->set_url( CARBONPRESS_URL . '/blocks/hero/' );

            $this->block->set_dir( CARBONPRESS_DIR . '/blocks/hero/' );

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
             * Set up the Block
             */
            $this->block->add_acf_block([
                'icon'          => 'cover-image',
                'textdomain'    => CARBONPRESS_TXTDOMAIN,
                'preview_image' => $this->block->get_url() .'preview.png',
            ]);

        }

    }
    (new CP_Block_Hero());

}
