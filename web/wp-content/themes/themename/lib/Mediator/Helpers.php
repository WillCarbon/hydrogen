<?php
namespace Carbonite\Mediator;

class Helpers
{
    /**
     * Return the img tag for the given attachment ID
     *
     * @param int $id Attachment ID of the image
     * @param string $size The WP image size to be returned
     * @param array $attr Attributes to be overwritten
     * @return string $img The full img tag
     */
    public static function getImage($id, $size = 'full', $attr = [])
    {
        return wp_get_attachment_image(
            $id,
            $size,
            false,
            $attr
        );
    }

    /**
     * Grab a static Google map for the specified location
     *
     * @param  array  $location An array containing lat and lng values
     * @return string $map      Static map image URL
     */
    public static function getGoogleMap($location, $zoom = 15)
    {
        $mapData = [
            'zoom'    => $zoom,
            'scale'   => '2',
            'size'    => '750x276',
            'maptype' => 'roadmap',
            'markers' => 'size:mid|' . $location['lat'] . ',' . $location['lng'],
            'key'     => (defined('GMAPS_KEY'))? GMAPS_KEY : '',
        ];

        $mapParameters = http_build_query($mapData);
        return $map = 'http://maps.googleapis.com/maps/api/staticmap?' . $mapParameters;
    }

    /**
     * Compares two post IDs to check whether the menu item is active
     *
     * @param  int  $menuId  Menu item ID
     * @param  int  $pageId  Current page ID
     * @return bool $active  Comparison result
     */
    public static function isActive($menuId, $pageId)
    {
        if (is_archive() || is_single()) {
            $postTypeObj = get_post_type_object(get_query_var('post_type'));
            $archiveId = get_page_by_path($postTypeObj->rewrite['slug'])->ID;
            if ($menuId == $archiveId) {
                return true;
            }
        } else if ($menuId == $pageId) {
            return true;
        }
        return false;
    }
}
