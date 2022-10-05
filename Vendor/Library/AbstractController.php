<?php

namespace Vendor\Library;

use Vendor\Library\Interfaces\ViewInterface;
use \Vendor\Library\ViewStrategy\Layout;

abstract class AbstractController
{

    protected Request $request;

    protected Response $response;

    private Container $container;

    protected ViewInterface $view;

    protected abstractLayout $layout;

    public function init(Request $request, Response $response, Container $container)
    {
        $this->layout = new Layout([]);
        $this->response = $response;
        $this->request = $request;
        $this->container = $container;
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

    public function __call(string $name, array $arguments)
    {
        $plugins = $this->container->getConfiguration()->getConfig('controller_plugins');
        if(!isset($plugins['alias'][$name])){
            throw new \Exception('plugin not found');
        }
        $className = $plugins['alias'][$name];
        if(!isset($plugins['factories'][$className])){
            throw new \Exception('class not found in plugin configuration');
        }
        $factory = new $plugins['factories'][$className]();

        $class = $factory($this->container);

        return $class();
    }

    public function run(ViewInterface $view)
    {
        $renderer = new ViewRenderer($view, $this->layout);
        $renderer->init($this->request, $this->response, $this->container);
        $renderer->render();
    }

}