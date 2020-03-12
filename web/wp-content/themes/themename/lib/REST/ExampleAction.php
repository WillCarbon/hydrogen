<?php

/**
 * Class ExampleAction
 */
class ExampleAction extends REST implements RESTActionInterface
{

    /**
     * ExampleAction constructor.
     */
    public function __construct()
    {
        add_action('rest_api_init', [$this, 'register']);
    }

    /**
     * You must have register() function in your class
     * Its being called by REST\Register
     *
     * Register all of your routes here
     */
    public function register()
    {
        $this->registerRoute('/search', [
            'methods'   =>  'post',
            'callback'  =>  [$this, 'search']
        ]);
    }

    /**
     * This is just example of how to search using ajax and WP Rest
     *
     * @param \WP_REST_Request $request
     * @return \WP_REST_Response
     */
    public function search(\WP_REST_Request $request)
    {
        $result = [];

        return new \WP_REST_Response($result);
    }
}
(new ExampleAction());
