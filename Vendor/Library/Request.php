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
     * @var string
     */
    protected $module;


    /**
     * @var Route
     */
    protected $currentRoute;

    /**
     * @var array
     */
    protected $params;

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

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param array $params
     * @return Request
     */
    public function setParams(array $params): Request
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return string
     */
    public function getModule(): string
    {
        return $this->module;
    }

    /**
     * @param string $module
     * @return Request
     */
    public function setModule(string $module): Request
    {
        $this->module = $module;
        return $this;
    }
}