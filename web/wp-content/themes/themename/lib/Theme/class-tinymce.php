<?php
namespace CarbonPress\Theme;

/**
 * TinyMCE
 *
 * @package CarbonPress\Theme
 */
class TinyMCE
{

    /**
     * TinyMCE constructor.
     */
    public function __construct()
    {
        //
        add_filter('mce_buttons', [$this, 'modify_buttons_row_1']);

        //
        add_filter('mce_buttons_2', [$this, 'modify_buttons_row_2']);

        //
        add_filter('tiny_mce_before_init', [$this, 'remove_header_from_editor']);

        // Attach callback to 'tiny_mce_before_init'
        add_filter( 'tiny_mce_before_init', [$this, 'format_options'] );
    }

    /**
     * Remove buttons from TinyMCE default toolbar
     *
     * @param array $buttons
     * @return array
     */
    public function modify_buttons_row_1( $buttons )
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
    public function modify_buttons_row_2( $buttons )
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
    public function remove_header_from_editor( $init )
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
    public function format_options( $init_array )
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
