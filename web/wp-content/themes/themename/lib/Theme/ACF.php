<?php
if (!class_exists('CarbonaraACF')):

    /**
     * Class CarbonaraACF
     */
    class CarbonaraACF
    {

        /**
         * CarbonaraACF constructor.
         */
        public function __construct()
        {
            // add_filter('carbon/acf/option_pages', [$this, 'optionPages']);
        }

        /**
         * Add / Remove ACF Option Pages
         *
         * @param array $pages
         * @return array
         */
        public function optionPages( $pages )
        {

            // Example Settings
            $pages['example-settings'] = [
                'page_title'    => 'Example Settings',
                'menu_title'    => 'Example Settings',
                'menu_slug'     => 'example-settings',
                'capability'    => 'manage_options',
                'redirect'      => false
            ];

            return $pages;
        }

    }
    (new CarbonaraACF());

endif;
