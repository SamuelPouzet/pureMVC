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


        $controller = $this->container->get($controllerName);

        if(! $controller instanceof AbstractController){
            $this->response
                ->setStatusCode(500)
                ->setResponseMessage(sprintf('Controller must extend %s', AbstractController::class ))
            ;
            //return;
        }

        $actionName = strtolower($route->getAction()) . 'Action';


        return $controller->$actionName();

    }

}