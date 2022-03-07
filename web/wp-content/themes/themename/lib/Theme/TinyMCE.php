<?php
namespace Carbonara\Theme;

/**
 * TinyMCE
 *
 * @package Carbonara\Theme
 */
class TinyMCE
{

    /**
     * TinyMCE constructor.
     */
    public function __construct()
    {
        //
        add_filter('mce_buttons', [$this, 'modifyButtonsRow1']);

        //
        add_filter('mce_buttons_2', [$this, 'modifyButtonsRow2']);

        //
        add_filter('tiny_mce_before_init', [$this, 'removeHeaderFromEditor']);

        // Attach callback to 'tiny_mce_before_init'
        add_filter( 'tiny_mce_before_init', [$this, 'formatOptions'] );
    }

    /**
     * Remove buttons from TinyMCE default toolbar
     *
     * @param array $buttons
     * @return array
     */
    public function modifyButtonsRow1( $buttons )
    {
        //Remove the format dropdown select and text color selector
        $remove = array( 'numlist', 'hr', 'alignleft', 'aligncenter', 'alignright', 'wp_more' );

        // Return Options
        return array_diff( $buttons, $remove );
    }


    /**
     * Remove buttons from TinyMCE expanded toolbar
     *
     * @param array $buttons
     * @return array
     */
    public function modifyButtonsRow2( $buttons )
    {

        // Remove the format dropdown select and text color selector
        $remove = array( 'forecolor', 'outdent', 'indent');

        // Add Format Options
        array_unshift($buttons, 'styleselect');

        // Return Options
        return array_diff( $buttons, $remove );
    }


    /**
     * Remove H1 from TinyMCE toolbar
     *
     * @param array $init
     * @return array
     */
    public function removeHeaderFromEditor( $init )
    {
        $init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Preformatted=pre;';
        return $init;
    }


    /**
     * Callback function to filter the MCE settings
     *
     * @param array $init_array
     * @return array
     */
    public function formatOptions( $init_array )
    {
        $style_formats = array(
            array(
                'title' => 'Primary Button',
                'selector' => 'a',
                'classes' => 'c-button c-button--alpha'
            ),
            array(
                'title' => 'Secondary Button',
                'selector' => 'a',
                'classes' => 'c-button c-button--bravo'
            ),
        );
        // Insert the array, JSON ENCODED, into 'style_formats'
        $init_array['style_formats'] = json_encode( $style_formats );

        // Return Options
        return $init_array;
    }

}
(new TinyMCE());
