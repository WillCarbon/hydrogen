<?php
if (!class_exists('CarbonaraTinyMCE')):

    /**
     * CarbonaraTinyMCE
     */
    class CarbonaraTinyMCE
    {
        /**
         * CarbonaraTinyMCE constructor.
         */
        public function __construct()
        {
            /* Uncomment to enable */
            // add_filter('mce_buttons', [$this, 'modify_buttons']);

            /* Uncomment to enable */
            // add_filter('mce_buttons_2', [$this, 'modify_buttons_2']);

            /* Uncomment to enable */
            // add_filter('tiny_mce_before_init', [$this, 'remove_h1_from_editor']);
        }

        /**
         * Remove buttons from TinyMCE default toolbar
         */
        public function modify_buttons( $buttons ) {
            //Remove the format dropdown select and text color selector
            $remove = array( 'numlist', 'hr', 'alignleft', 'aligncenter', 'alignright', 'wp_more' );

            return array_diff( $buttons, $remove );
        }

        /**
         * Remove buttons from TinyMCE expanded toolbar
         */

        public function modify_buttons_2( $buttons ) {
            //Remove the format dropdown select and text color selector
            $remove = array( 'forecolor', 'outdent', 'indent', 'alignleft', 'aligncenter', 'alignright', 'alignjustify',  'underline' );

            return array_diff( $buttons, $remove );
        }


        /**
         * Remove H1 from TinyMCE toolbar
         */
        public function remove_h1_from_editor( $init ) {
            $init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Preformatted=pre;';
            return $init;
        }

    }
    (new CarbonaraTinyMCE());

endif;
