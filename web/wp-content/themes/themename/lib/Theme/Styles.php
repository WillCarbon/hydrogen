<?php
use Carbon\Helpers\Theme;

if (!class_exists('CarbonaraStyles')):

    /**
     * Class CarbonaraStyles
     */
    class CarbonaraStyles
    {

        /**
         * Styles constructor.
         */
        public function __construct()
        {
            // Remove Stylesheets
            add_action('wp_enqueue_scripts', [$this, 'deregisterStyles'], 98);

            // Add Stylesheets
            add_action('wp_enqueue_scripts', [$this, 'registerStyles'], 99);

            // Add Editor Stylesheet
            add_action( 'admin_init', [$this, 'addEditorStyle']);
        }

        /**
         * Add Stylesheets
         */
        public function registerStyles()
        {
            // Dont run on Dashboard
            if (is_admin()) return;

            wp_enqueue_style(
                'main',
                Theme::getCss('main', '.css'),
                false,
                Theme::getVersion(),
                'all'
            );
        }

        /**
         * Remove Stylesheets
         */
        public function deregisterStyles()
        {
            // Dont run on Dashboard
            if (is_admin()) return;

            // Remove default WordPress stylesheet
            wp_dequeue_style('wp-block-library');
        }

        /**
         * Registers an editor stylesheet for the theme.
         */
        public function addEditorStyle()
        {
            add_editor_style( Theme::getCss('editor', '.css') );
        }

    }
    (new CarbonaraStyles());

endif;
