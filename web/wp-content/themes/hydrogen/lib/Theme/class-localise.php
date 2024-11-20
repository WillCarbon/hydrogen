<?php
namespace CarbonPress\Theme;

/**
 * Class Localisation
 *
 * @package CarbonPress\Theme
 */
class Localisation
{

	/**
	 * Absolute path to the translation directory.
	 *
	 * @var string
	 */
	public $dir = '';


    /**
     * Localisation constructor.
     */
    public function __construct()
    {
        // Define the translation directory.
        $this->dir = CARBONPRESS_DIR . '/langs';

        add_action( 'after_setup_theme', [ $this, 'getTextdomain' ], 1 );
    }


	/**
	 * Loads the theme textdomain.
     *
     * @return void
	 */
	public function getTextdomain()
    {
		load_theme_textdomain( CARBONPRESS_TXTDOMAIN, $this->dir );
	}

}
(new Localisation());
