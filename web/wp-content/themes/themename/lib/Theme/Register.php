<?php

namespace Carbonite\Theme;

/**
 * Class Register
 * @package Carbonite\Theme
 */
class Register
{
    /**
     * Register constructor.
     * Register or de register your theme settings here
     */
    public function __construct()
    {
        (new Activation());

        (new Setup());
        (new LoadBem());
        (new CleanUp());
        (new Images());
        (new Lazysizes());
        (new Scripts());
        (new Styles());
        (new SMTP());
        (new TinyMCE());
        (new TrackingCodes());
    }
}
