<?php
namespace CarbonPress\Theme;

/**
 * Class Images
 *
 * @package CarbonPress\Theme
 */
class Images
{

    /**
     * Images constructor.
     */
    public function __construct()
    {
        add_action('init', [$this, 'image_sizes']);
        #add_filter('image_size_names_choose', [$this, 'size_names']);
    }

    /**
     * Add custom image sizes
     *
     * @return void
     */
    public function image_sizes()
    : void
    {
        // Create image with specific width
        add_image_size( 'hero', 1920, 450 );

        // Create image with specific width
        //add_image_size( 'example-width', 150 );

        // Create image, resize by ratio
        //add_image_size( 'example-ratio', 150, 100 );

        // Create image with specific dimensions
        //add_image_size( 'example-crop', 150, 100, true );
    }

    /**
     * Set custom image size names
     *
     * @param array $sizes
     * @return array
     */
    public function size_names(array $sizes)
    : array
    {
        $sizes['example-width'] = 'Example: Width Only';
        $sizes['example-ratio'] = 'Example: Keep Ratio';
        $sizes['example-crop'] = 'Example: Crop Image';
        return $sizes;
    }
}
(new Images());
