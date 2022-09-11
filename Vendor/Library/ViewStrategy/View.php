<?php

namespace Vendor\Library\ViewStrategy;
use \Vendor\Library\AbstractView;
use Vendor\Library\Interfaces\ViewInterface;
use Vendor\Library\Traits\FileTrait;

class View extends AbstractView implements ViewInterface
{

    use FileTrait;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    protected function getPath(): string
    {
        $viewConfig = $this->container->getConfiguration()->getConfig('views_renderers');
        $module = $this->formatPathElement($this->request->getCurrentRoute()->getModule() );
        $controller = $this->formatPathElement($this->request->getCurrentRoute()->getControllerShortName());

        $action = $this->formatPathElement($this->request->getCurrentRoute()->getAction());
        foreach ($viewConfig['view_templates'] as $key=>$template){
            $path = $template . DS . $module . DS .$controller . DS . $action . '.phtml';
            if(is_file($path)){
                return $path;
            }
        }
        throw new \Exception('resolver could not resolve to a template');
    }

    protected function formatPathElement($element)
    {
        return ucfirst(strtolower(trim(preg_replace('/([A-Z])/', '-$1', $element), '-' )));
    }

    public function render()
    {
        $path = $this->getPath();
        ob_start();
        foreach($this->data as $key=>$data){
            $this->$key = $data;
        }
        require $path;
        return ob_get_clean();
    }

}