<?php

namespace Vendor\Library;

class ViewRenderer
{
    protected Container $container;
    protected  Request $request;
    protected Response $response;
    protected  AbstractView $view;

    /**
     * @param Container $container
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Container $container, Request $request, Response $response, AbstractView $view)
    {
        $this->container = $container;
        $this->request = $request;
        $this->response = $response;
        $view->setRequest($this->request);
        $view->setContainer($this->container);
        $this->view = $view;
    }

    public function render()
    {
        $this->response->setBody($this->view->render());
        if( $this->view->hasLayout() ){
            $layout = new \Vendor\Library\Layout($this->container, $this->request, $this->response);
            $this->response->setBody($layout->render($this->response->getBody()));
        }
    }

}