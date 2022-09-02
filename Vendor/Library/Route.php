<?php

namespace Vendor\Library;

class Route
{
    /**
     * @var string
     */
    protected $routeName;

    /**
     * @var string
     */
    protected $controller;

    /**
     * @var string
     */
    protected $routePath;

    /**
     * @var string
     */
    protected $action;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var array
     */
    protected $gets = [];

    /**
     * @var array
     */
    protected $posts = [];


    public function __construct()
    {
        $this->setMethod($_SERVER['REQUEST_METHOD']);
        $this->setGets($_GET);
        $this->setPosts($_POST);
    }

    /**
     * @return string
     */
    public function getRouteName(): string
    {
        return $this->routeName;
    }

    /**
     * @param string $routeName
     * @return Route
     */
    public function setRouteName(string $routeName): Route
    {
        $this->routeName = $routeName;
        return $this;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @param string $controller
     * @return Route
     */
    public function setController(string $controller): Route
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     * @return Route
     */
    public function setAction(string $action): Route
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @return array
     */
    public function getGets(): array
    {
        return $this->gets;
    }

    /**
     * @param array $gets
     * @return Route
     */
    public function setGets(array $gets): Route
    {
        $this->gets = $gets;
        return $this;
    }

    /**
     * @param array $gets
     * @return Route
     */
    public function addGet($key, $value): Route
    {
        $this->gets[$key] = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getPosts(): array
    {
        return $this->posts;
    }

    /**
     * @param array $posts
     * @return Route
     */
    public function setPosts(array $posts): Route
    {
        $this->posts = $posts;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return Route
     */
    public function setMethod(string $method): Route
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return string
     */
    public function getRoutePath(): string
    {
        return $this->routePath;
    }

    /**
     * @param string $routePath
     * @return Route
     */
    public function setRoutePath(string $routePath): Route
    {
        $this->routePath = $routePath;
        return $this;
    }

}