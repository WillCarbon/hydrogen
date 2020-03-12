<?php

namespace Carbonite\Mediator;

class Page
{
    public $pageId = '';
    public $fieldStorage = [];

    public function __construct($page = '')
    {
        // save the page ID
        $this->pageId = $this->getId($page);

        // save all custom fields
        $this->registerCustomFields();
    }

    public function getId($page = '')
    {
        $pageId = '';

        if (empty($page)) {
            global $post;
            return $post->ID;
        }

        if ($page == 'frontpage') {
            $pageId = get_option('page_on_front');
        } elseif ($page == 'blog') {
            $pageId = get_option('page_for_posts');
        } elseif ($page == 'archive') {
            $postType = get_query_var('post_type');
            if (!empty($postType)) {
                $postTypeData = get_post_type_object($postType);
                $postTypeSlug = $postTypeData->has_archive;
                $postArchive  = get_page_by_path($postTypeSlug);
                $pageId = $postArchive->ID;
            }
        }

        return $pageId;
    }

    public function registerCustomFields($page = '')
    {
        $this->fieldStorage = get_fields($this->pageId);
    }

    public function getCustomFields($field)
    {
        $field = $this->fieldStorage[$field];

        if (is_array($field) && count($field) == 1) {
            return $field[0];
        } else {
            return $field;
        }
    }

    public function getHero()
    {
        $hero = $this->getCustomFields('hero');

        if (empty($hero['heading'])) {
            $hero['heading'] = get_the_title($this->pageId);
        }

        if (empty($hero['image'])) {
            $hero['image'] = get_field('hero_image', 'option');
        }

        if (!empty($hero['button'])) {
            $hero['button'] = $hero['button'][0];
        }

        return $hero;
    }
}
