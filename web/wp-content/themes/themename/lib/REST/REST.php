<?php
namespace Carbonara\REST;

/**
 * Class REST
 *
 * @package Carbonara\REST
 */
class REST
{
    /**
     * Register the namespace for your RESTFul JSON calls
     * https://domain.com/wp-json/api/
     */
    const REST_NAMESPACE = 'api';

    /**
     * @param string $route
     * @param array $args
     */
    public function registerRoute($route = '/', $args = [])
    {
        register_rest_route(self::REST_NAMESPACE, $route, $args);
    }
}
