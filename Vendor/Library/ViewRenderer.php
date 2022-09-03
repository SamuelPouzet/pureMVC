<?php

namespace Vendor\Library;

class ViewRenderer
{

    protected View $view;

    protected ?Layout $layout;

    protected Configuration $configuration;

    protected Request $request;

    protected Response $response;

    public function __construct(Configuration $configuration, Request $request, Response $response)
    {
        $this->configuration = $configuration;
        $this->request = $request;
        $this->response = $response;
        $this->view = $response->getView();
        $this->layout = $response->getLayout();
    }

    public function render() :void
    {
        if (! $this->layout){
            $this->createLayout();
        }
        echo $this->layout->render($this->view->render());
    }

    protected function createLayout(): void
    {
        $this->layout = new Layout($this->configuration, $this->request, $this->response, []);
        $this->response->setLayout( $this->layout );
    }

}