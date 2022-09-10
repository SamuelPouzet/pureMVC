<?php

namespace Vendor\Library;

class Layout
{

    protected Container $container;

    protected Request $request;

    protected Response $response;

    protected array $data;

    /**
     * @param Container $container
     * @param Request $request
     * @param Response $response
     * @param array $data
     */
    public function __construct(Container $container, Request $request, Response $response, array $data=[])
    {
        $this->container = $container;
        $this->request = $request;
        $this->response = $response;
        $this->data = $data;
    }


    protected function getPath(): string
    {
        $viewConfig = $this->container->getConfiguration()->getConfig('views_renderers');
        $module = $this->request->getCurrentRoute()->getModule();
        $controller = $this->request->getCurrentRoute()->getControllerShortName();
        $action = $this->request->getCurrentRoute()->getAction();

        if(isset($viewConfig['layout_templates'][$module])){
            $path = $viewConfig['layout_templates'][$module];
            if(is_file($path)){
                return $path;
            }
            throw new \Exception('Template file not found for configuration1');
        }

        if(isset($viewConfig['layout_templates']['*'])){
            $path = $viewConfig['layout_templates']['*'];
            if(is_file($path)){
                return $path;
            }
            throw new \Exception('Template file not found for configuration2');
        }
        throw new \Exception('no template found for configuration3');
    }

    public function render(string $html)
    {
        $path = $this->getPath();
        ob_start();
        foreach($this->data as $key=>$data){
            $this->$key = $data;
        }
        $this->content = $html;
        require $path;
        return ob_get_clean();
    }

}