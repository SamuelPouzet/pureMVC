<?php

namespace Vendor\Library;

class Configuration
{
    /**
     * @var array
     */
    protected $routes;

    public function getRoute(string $routeName)
    {
        if(isset( $this->routes[$routeName])){
            return $this->routes[$routeName];
        }
        return $this->routes['404'];
    }

    /**
     * @return mixed
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @param mixed $routes
     * @return Configuration
     */
    public function setRoutes($routes)
    {
        $this->routes = $routes;
        return $this;
    }



}