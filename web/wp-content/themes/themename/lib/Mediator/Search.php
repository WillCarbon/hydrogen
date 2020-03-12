<?php

namespace Carbonite\Mediator;

class Search
{
    /**
     * This is an example function to show you how to create a Ajax friendly search
     * This can be modified to fit your post type fields
     * Its best to called from REST\Routes
     *
     * @param $type
     * @param $filter
     * @param $page
     * @param $search
     * @param $projectID
     * @param $authorID
     * @return array
     */
    public static function search($type, $filter, $page, $search, $projectID, $authorID)
    {
        $args = [
            'post_type'         =>  'publication',
            'posts_per_page'    =>  10,
            'paged'             =>  $page,
            'meta_query'        =>  [
                'relation'      => 'AND'
            ]
        ];

        /**
         * Universal Search or for a specific project
         */
        if (!empty($projectID)) {
            $args['meta_query'][] = [
                'key'       =>  'project',
                'value'     =>  $projectID,
                'compare'   =>  '='
            ];
        }

        /**
         * Search for resources upload by specific user
         */
        if (!empty($authorID)) {
            $args['meta_query'][] =         [
                'key'       =>  'author',
                'value'     =>  '"'. $authorID .'"',
                'compare'   =>  'LIKE'
            ];
        }

        /**
         * Search
         */
        if (!empty($search)) {
            $args['s'] = $search;
        }

        /**
         * Publication Type
         */
        if ( (!empty($type)) AND ($type != 'all') ) {
            $args['meta_query'][] = [
                'key'       =>  'upload_type',
                'value'     =>  $type,
                'compare'   =>  '='
            ];
        }

        /**
         * Filter Type : Internal, External, All
         */
        if ( (!empty($filter)) AND ($filter != 'all') )  {
            if ($filter == 'internal') {
                $args['meta_query'][] = [
                    'key'       =>  'author',
                    'value'     =>  '',
                    'compare'   =>  '!='
                ];
            } else {
                /**
                 * External
                 */
                $args['meta_query'][] = [
                    'key'       =>  'author',
                    'value'     =>  '',
                    'compare'   =>  '='
                ];
            }
        }

        /**
         * Execute query
         */
        $results = new \WP_Query($args);

        /**
         * Result storage
         */
        $storage = [
            'pages'         =>  0,
            'currentPage'   =>  $page,
            'result'        =>  []
        ];



        if (!empty($results) AND ($results->have_posts())) {

            /**
             * Store total page count
             */
            $storage['pages'] = $results->max_num_pages;

            foreach($results->get_posts() as $post) {

                /**
                 * Get all custom fields
                 */
                $customFields = get_fields($post->ID);

                $storage['result'][] = array_merge($customFields, [
                    'id'        =>  $post->ID,
                    'title'     =>  $post->post_title,
                    'content'   =>  $post->post_content,
                    'link'      =>  get_permalink($post->ID),
                ]);
            }
        }

        return $storage;
    }
}