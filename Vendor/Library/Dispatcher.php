<?php

namespace Vendor\Library;

class Dispatcher
{

    protected Container $container;

    protected Request $request;

    protected Response $response;

    public function __construct(Container $container, Request $request, Response $response)
    {
        $this->container = $container;
        $this->request = $request;
        $this->response = $response;
    }


    public function dispatch()
    {
        $route = $this->request->getCurrentRoute();
        $controllerName = $route->getController();

        try {
            $controller = $this->container->get($controllerName);
        }catch(\Exception $e) {
            $this->response
                ->setStatusCode(404)
                ->setResponseMessage(sprintf('Controller not found for route %s', $route->getRouteName() ))
                ;
            return;
        }

        if(! $controller instanceof AbstractController){
            $this->response
                ->setStatusCode(500)
                ->setResponseMessage(sprintf('Controller must extend %s', AbstractController::class ))
            ;
            return;
        }

        $actionName = strtolower($route->getAction()) . 'Action';

        if(! method_exists($controller, $actionName)){
            $this->response
                ->setStatusCode(404)
                ->setResponseMessage(sprintf('Action not found for action %s', $actionName ))
            ;
            return;
        }

        return $controller->$actionName();

    }

}