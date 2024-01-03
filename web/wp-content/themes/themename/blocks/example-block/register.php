<?php
use Carbon\Helpers\Theme;

/**
 * Class ExampleBlock
 */
if ( ! class_exists( 'ExampleBlock' ) ) {
    class ExampleBlock extends CB_Base_Block
    {
        /**
         * ExampleBlock constructor.
         */
        public function __construct()
        {
            $this->set_key( 'example-block' );

            $this->set_name( __('ExampleBlock', 'carbonpress') );

            $this->set_url( CARBONPRESS_URL . '/blocks/example-block/' );

            $this->set_dir( CARBONPRESS_DIR . '/blocks/example-block/' );

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
             * Add default stylesheet (block-key.css)
             */
            $this->add_style( Theme::getCss('block-example'), '', [
                'version' => Theme::getVersion(),
            ]);

            /**
             * Add additional stylesheets (block-example-more.css)
             */
            // $this->add_style( Theme::getCss('block-example-more'), 'more', [
            //     'version' => Theme::getVersion(),
            // ]);

            /**
             * Set up the Block
             */
            $this->add_acf_block([
                // 'icon'          => 'block-default',
                // 'textdomain'    => CARBONPRESS_TXTDOMAIN,
                // 'example'       => [
                //     'attributes' => [
                //         'data' => [
                //             'preview_image_help' => get_carbon_img_url('/blocks/example-block/preview.png')
                //         ]
                //     ]
                // ]
            ]);

        }

    }
    (new ExampleBlock());

}
