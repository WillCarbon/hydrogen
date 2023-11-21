<?php
namespace CarbonPress\Blocks;

/**
 * Class ExampleBlock
 *
 * @package CarbonPress\Block
 */
class ExampleBlock
{
    const BLOCK_KEY = 'example';
    const BLOCK_NAME = 'Example';

    /**
     * ExampleBlock constructor.
     */
    public function __construct()
    {
        add_action('init', [$this, 'register']);
        add_action('after_setup_theme', [$this, 'fields'], 20);
    }

    /**
     * Register block
     */
    public function register()
    {
        $this->addBlock(self::BLOCK_KEY, self::BLOCK_NAME, [

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

        $config['fields'] = apply_filters('carbonberg/blocks/example/fields', $fields);

        $fields = array();
        $field_prefix = 'carbonberg_block_' . BLOCK_KEY;

        $config = '';

        // Add ACF Field Group
        acf_add_local_field_group($config);
    }

}
(new ExampleBlock());
