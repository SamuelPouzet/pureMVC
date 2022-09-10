<?php

namespace Vendor\Library;

/**
 * class qui gère la requete http
 */
class Request
{

    /**
     * @var string
     */
    protected $uri;


    /**
     * @var Route
     */
    protected $currentRoute;

    public function __construct()
    {
        $this->setUri($_SERVER['REQUEST_URI']);
        $this->setCurrentRoute(new Route());
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    /**
     * @return Route
     */
    public function getCurrentRoute(): Route
    {
        return $this->currentRoute;
    }

    /**
     * @param Route $currentRoute
     * @return Request
     */
    public function setCurrentRoute(Route $currentRoute): Request
    {
        $this->currentRoute = $currentRoute;
        return $this;
    }
}