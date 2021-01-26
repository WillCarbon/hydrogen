<?php
use Carbon\Helpers\Theme;

if (!class_exists('CarbonaraScripts')):

    /**
     * Class CarbonaraScripts
     */
    class CarbonaraScripts
    {

        /**
         * CarbonaraScripts constructor.
         */
        public function __construct()
        {
            // Add Javascript files
            add_action('wp_enqueue_scripts', [$this, 'registerScripts'], 99);

            // Remove JavaScript files
            add_action('wp_enqueue_scripts', [$this, 'deregisterScripts'], 90);

            // Uncomment line below to use custom version of jQuery
            #add_action('wp_enqueue_scripts', [$this, 'replaceJquery'], 5);
        }

        /**
         * Add Javascript files
         */
        public function registerScripts()
        {
            // Dont run on Dashboard
            if (is_admin()) return;

            wp_enqueue_script(
                'main',
                Theme::getJs('main'),
                false,
                Theme::getVersion(),
                true
            );
        }

        /**
         * Remove JavaScript files
         */
        public function deregisterScripts()
        {
            // Dont run on Dashboard
            if (is_admin()) return;

            wp_deregister_script('l10n');
        }


        /**
         * Replace WordPress jQuery
         */
        public function replaceJquery()
        {
            // Dont run on Dashboard
            if (is_admin()) return;

            // Remove WordPress version
            wp_deregister_script('jquery');

            // Load version from Node
            wp_enqueue_script(
                'jquery',
                Theme::getVendor('jquery/dist/jquery.min.js'),
                false,
                '3.5.1',
                false
            );
        }

    }
    (new CarbonaraScripts());

endif;
