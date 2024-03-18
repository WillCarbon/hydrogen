<?php

/**
 * Class CP_Block_Hero
 */
if ( ! class_exists( 'CP_Block_Hero' ) ) {
    class CP_Block_Hero extends CB_Base_Block
    {
        /**
         * HeroBlock constructor.
         */
        public function __construct()
        {
            $this->set_key( 'hero' );

            $this->set_name( __('Hero', 'carbonpress') );

            $this->set_url( CARBONPRESS_URL . '/blocks/hero/' );

            $this->set_dir( CARBONPRESS_DIR . '/blocks/hero/' );

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
            $this->add_acf_block([
                'icon'          => 'cover-image',
                'textdomain'    => CARBONPRESS_TXTDOMAIN,
                'preview_image' => get_carbon_img_url('/blocks/hero/preview.png')
            ]);

        }

    }
    (new CP_Block_Hero());

}
