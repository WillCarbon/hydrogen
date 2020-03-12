<?php

namespace Carbonite\REST;

class REST
{
    /**
     * Register the namespace for your RESTFul JSON calls
     * https://domain.com/wp-json/api/
     */
    const REST_NAMESPACE = 'api';

    public function registerRoute($route = '/', $args = [])
    {
        register_rest_route(self::REST_NAMESPACE, $route, $args);
    }
}
