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
     * @var string
     */
    protected $controller;

    /**
     * @var string
     */
    protected $method;

    /**
     * @todo créer une classe pour les gets et les posts
     * @var array
     */
    protected $gets;

    /**
     * @todo créer une classe pour les gets et les posts
     * @var array
     */
    protected $posts;

    /**
     * @todo créer une classe pour les sessions
     * @var array
     */
    protected $session;

    /**
     * @var array
     */
    protected $params;

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
     * @return string
     */
    public function getModule(): string
    {
        return $this->module;
    }

    /**
     * @param string $module
     */
    public function setModule(string $module): void
    {
        $this->module = $module;
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
     */
    public function setController(string $controller): void
    {
        $this->controller = $controller;
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
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
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
     */
    public function setGets(array $gets): void
    {
        $this->gets = $gets;
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
     */
    public function setPosts(array $posts): void
    {
        $this->posts = $posts;
    }

    /**
     * @return array
     */
    public function getSession(): array
    {
        return $this->session;
    }

    /**
     * @param array $session
     */
    public function setSession(array $session): void
    {
        $this->session = $session;
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
     */
    public function setParams(array $params): void
    {
        $this->params = $params;
    }

}