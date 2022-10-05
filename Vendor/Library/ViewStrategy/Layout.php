<?php

namespace Vendor\Library\ViewStrategy;

use Vendor\Library\AbstractLayout;
use Vendor\Library\AbstractView;
use Vendor\Library\Container;
use Vendor\Library\Interfaces\LayoutInterface;
use Vendor\Library\Interfaces\ViewInterface;
use Vendor\Library\Request;
use Vendor\Library\Response;

class Layout extends AbstractLayout implements LayoutInterface
{

    protected array $data = [];

    protected ViewInterface $view;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function init(Request $request, Response $response, Container $container)
    {
        $this->response = $response;
        $this->request = $request;
        $this->container = $container;
    }

    /**
     * utilisé aussi dans la vue, à centraliser, trait ou classe mère, au choix
     * @param string $key
     * @return mixed
     * @throws \Exception
     */
    public function __get(string $key): string
    {
        if(!isset($this->data[$key])){
            throw new \Exception(sprintf('variable %1$s not found', $key));
        }
        return $this->data['key'];
    }

    public function setVariable(string $name, string $value)
    {
        $this->data[$name] = $value;
    }

    public function setView(ViewInterface $view)
    {
        $this->view = $view;
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

    public function render(): string
    {
        $path = $this->getPath();
        $this->content = $this->view->render();
        ob_start();
        require $path;
        return ob_get_clean();
    }

}