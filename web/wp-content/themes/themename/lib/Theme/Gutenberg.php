<?php
namespace Carbonara\Theme;

/**
 * Class Setup
 *
 * @package Carbonara\Theme
 */
class Gutenberg
{
    /**
     * Setup constructor.
     */
    public function __construct()
    {
        add_filter( 'allowed_block_types_all',      [$this, 'setBlockTypes'], 20) ;
        add_filter( 'block_editor_settings_all',    [$this, 'disableLockBlocks'], 10, 2 );
        // add_action( 'init',                         [$this, 'registerBlockTemplatePage'], 20 );
    }

    /**
     * Choose block types
     */
    public function setBlockTypes() 
    {
        return array(
            'core/heading',
            'core/paragraph',
            'core/list',
            'core/list-item',
            'core/buttons',
            'core/button',
            'core/image',
            'core/columns',
            'core/column',
            'core/media-text', 

            'carbonberg/text',
            'carbonberg/image',
            'carbonberg/text-image',
            'carbonberg/form',
            'carbonberg/accordion'
        );
    }

    /**
     * Disable lock/unlock functionality on blocks
     */
    public function disableLockBlocks( $settings, $context ) 
    {
        $settings['canLockBlocks'] = current_user_can( 'activate_plugins' );
    
        return $settings;
    }

    /**
     * Block template: Page
     */
    public function registerBlockTemplatePage() 
    {
        $block_template = array(
            array( 'core/columns', array(), array(
                array( 'core/column', array('width' => '33.33%'), array(
                    array( 'core/image', array() ),
                ) ),
                array( 'core/column', array('width' => '66.66%'), array(
                    array( 'core/paragraph', array(
                        'placeholder' => 'Lorem ipsum'
                    ) ),
                ) ),
            ) ),
            array( 'core/columns', array(), array(
                array( 'core/column', array('width' => '66.66%'), array(
                    array( 'core/paragraph', array(
                        'placeholder' => 'Lorem ipsum'
                    ) ),
                ) ),
                array( 'core/column', array('width' => '33.33%'), array(
                    array( 'core/image', array() ),
                ) ),
            ) )
        );
        
        $post_type_object                = get_post_type_object( 'page' );
        
        $post_type_object->template      = $block_template;
        // $post_type_object->template_lock = 'all';
    }
}
(new Gutenberg());