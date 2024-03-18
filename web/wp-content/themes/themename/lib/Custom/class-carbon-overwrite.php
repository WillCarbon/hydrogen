<?php
namespace CarbonPress\Custom;

/**
 * Class CarbonOverwrite
 *
 * @package CarbonPress\Theme
 */
class CarbonOverwrite
{

    /**
     * CarbonOverwrite constructor.
     */
    public function __construct()
    {
        // add_filter('carbon/socialshare/whitelist', [$this, 'social_whitelist']);
    }


    /**
     * Example Function
     * Replace with your own overwrite
     *
     * @param array $whitelist
     * @return array
     */
    public function social_whitelist( array $whitelist )
    : array
    {
        return [
            'facebook', 'x', 'linkedin', 'email'
        ];
    }

}
(new CarbonOverwrite());
