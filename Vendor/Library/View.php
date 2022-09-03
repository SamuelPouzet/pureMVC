<?php

namespace Vendor\Library;

class View
{

    protected Configuration $configuration;

    protected Request $request;

    protected Response $response;

    protected array $data;

    protected Renderer $renderer;

    protected ?string $path = null;

    public function __construct(Configuration $configuration, Request $request, Response $response, array $data)
    {
        $this->configuration = $configuration;
        $this->request = $request;
        $this->response = $response;
        $this->data = $data;
        $this->renderer = new Renderer();
    }

    public function setPath($path)
    {
        if(!is_file($path)){
            throw new \Exception('file not found');
        }
        $this->path = $path;
    }

    protected function setDefaultPath()
    {
        //@todo create config for default
        $module = ucfirst(strtolower($this->request->getModule()));
        $shortname = strtolower($this->request->getCurrentRoute()->getControllerShortName());
        $action = $this->request->getCurrentRoute()->getAction();
        $this->path = SRC_PATH . DS . $module . DS .  'Views' . DS . $module . DS . $shortname . DS . $action . '.phtml';
    }

    public function render()
    {
        if(! $this->path){
            //chemin non défini manuellement, on prend celui par défaut
            $this->setDefaultPath();
        }

        return $this->renderer->render($this->path, $this->data);
    }

}