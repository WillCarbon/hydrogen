<?php
namespace CarbonPress\Blocks;

use Carbon\Helpers\Theme;

/**
 * Class ExampleBlock
 *
 * @package CarbonPress\Block
 */
if ( ! class_exists( 'ExampleBlock' ) ) {
    class ExampleBlock
    {
        const BLOCK_KEY = 'example';
        const BLOCK_NAME = 'ExampleBlock';

        /**
         * ExampleBlock constructor.
         */
        public function __construct()
        {
            $this->block_url = CARBONPRESS_URL . '/lib/Blocks/' . self::BLOCK_NAME;
            $this->block_dir = CARBONPRESS_DIR . '/lib/Blocks/' . self::BLOCK_NAME;

            add_action('init', [$this, 'register']);
            add_action('after_setup_theme', [$this, 'fields'], 20);
        }

        /**
         * Register block
         */
        public function register()
        {
            register_block_type($this->block_dir, [
                'category'      => 'example',
                'icon'          => 'block-default',
                'description'   => __('Example description'),
                'keywords'      => [ __( 'example' ), __( 'example' ) ]
            ]);

            wp_enqueue_block_style( 'carbonberg/' . self::BLOCK_KEY, array(
                'handle' => CARBONBERG_PREFIX . self::BLOCK_KEY,
                'src' => Theme::getCss('block-' . self::BLOCK_KEY . '.min.css')
            ));

            // TODO: Create this function in Carbon Neutral
            return;
            $this->addBlock(self::BLOCK_KEY, self::BLOCK_NAME, [
                'category'      => 'example', // defaults: text, media, design, widgets, theme, embed. Can add new categories in class-gutenberg.php
                'icon'          => 'block-default', // dashicons: https://developer.wordpress.org/resource/dashicons/
                'description'   => __( 'Example description' ),
                'keywords'      => [ __( 'example' ), __( 'example' ) ],
                'block_dir'     => $this->block_dir,
                'handle'        => CARBONBERG_PREFIX . self::BLOCK_KEY,
                'style'         => Theme::getCss( 'block-' . self::BLOCK_KEY . '.min.css' )
            ]);
        }

        /**
         * Load ACF Group Config
         *
         * @since 0.1.0
         */
        public function fields()
        {
            if (!function_exists('acf_add_local_field_group'))
                return;

            $fields = array();
            $field_prefix = 'carbonberg_block_' . self::BLOCK_KEY;

            $config['fields'] = apply_filters('carbonberg/blocks/example/fields', $fields);

            // Add ACF Field Group
            acf_add_local_field_group($config);
        }

    }
    (new ExampleBlock());
}
