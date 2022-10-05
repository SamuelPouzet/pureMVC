<?php

namespace Vendor\Library\ViewStrategy;
use \Vendor\Library\AbstractView;
use Vendor\Library\Interfaces\ViewInterface;
use Vendor\Library\Traits\FileTrait;

class View extends AbstractView implements ViewInterface
{

    use FileTrait;

    protected const VIEW_STRATEGY = 'VIEW';

    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    public static function getStrategy(): string
    {
        return self::VIEW_STRATEGY;
    }

    public static function header()
    {
        header('Content-Type: text/html');
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

    public function __get($key)
    {
        if(!isset($this->data[$key])){
            throw new \Exception(sprintf('variable %1$s not found', $key));
        }
        return $this->data['key'];
    }

    public function render(): string
    {
        $path = $this->getPath();
        ob_start();
        require $path;
        return ob_get_clean();
    }

}