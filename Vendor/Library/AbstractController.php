<?php

namespace Vendor\Library;

abstract class AbstractController
{

    protected Request $request;

    protected Response $response;

    private static Container $container;

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @param Request $request
     * @return AbstractController
     */
    public function setRequest(Request $request): AbstractController
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

    /**
     * @param Response $response
     * @return AbstractController
     */
    public function setResponse(Response $response): AbstractController
    {
        $this->response = $response;
        return $this;
    }

    public static function setContainer(Container $container)
    {
        self::$container = $container;
    }

    public function __call(string $name, array $arguments)
    {
        $plugins = self::$container->getConfiguration()->getConfig('controller_plugins');
        if(!isset($plugins['alias'][$name])){
            throw new \Exception('plugin not found');
        }
        $className = $plugins['alias'][$name];
        if(!isset($plugins['factories'][$className])){
            throw new \Exception('class not found in plugin configuration');
        }
        $factory = new $plugins['factories'][$className]();

        $class = $factory(self::$container);

        return $class();
    }

}