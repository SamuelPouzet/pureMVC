<?php

namespace Vendor\Library;

use Vendor\Library\Interfaces\LayoutInterface;
use Vendor\Library\Interfaces\ViewInterface;

class ViewRenderer
{
    protected Request $request;
    protected Response $response;
    protected Container $container;
    protected ViewInterface $view;
    protected LayoutInterface $layout;


    public function __construct(ViewInterface $view, LayoutInterface $layout)
    {
        $this->view = $view;
        $this->layout = $layout;
    }

    public function init(Request $request, Response $response, Container $container)
    {
        $this->response = $response;
        $this->request = $request;
        $this->container = $container;
        $this->view->init($request, $response, $container);
        $this->layout->init($request, $response, $container);
    }

    public function render()
    {
        $this->view::header();
        $this->layout->setView($this->view);
        echo $this->layout->render();

    }

}