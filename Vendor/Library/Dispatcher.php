<?php

namespace Vendor\Library;

class Dispatcher
{

    protected Configuration $configuration;

    protected Request $request;

    protected Response $response;

    public function __construct(Configuration $configuration, Request $request, Response $response)
    {
        $this->configuration = $configuration;
        $this->request = $request;
        $this->response = $response;
    }


    public function dispatch()
    {
        $route = $this->request->getCurrentRoute();
        $controllerName = $route->getController();
        try {
            $controller = new $controllerName();
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

        $controller->setConfiguration($this->configuration);
        $controller->setRequest($this->request);
        $controller->setResponse($this->response);
        //$controller->init();

        switch($this->response->getStrategy()){
            default:
                //HTML or other
                $view = new View($this->configuration, $this->request, $this->response, $controller->$actionName() );
                $layout = new Layout($this->configuration, $this->request, $this->response, $controller->$actionName() );
                $this->response->setView($view);
                $this->response->setLayout($layout);
        }



        //@todo injection de dépendance

    }

}