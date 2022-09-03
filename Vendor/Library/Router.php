<?php

namespace Vendor\Library;

class Router
{
    protected $configuration;

    protected $request;

    protected $response;

    public function __construct(Configuration $configuration, Request $request, Response $response)
    {
        $this->configuration = $configuration;
        $this->request = $request;
        $this->response = $response;
    }

    public function route()
    {
        $requestedUri = $this->request->getUri();
        foreach ($this->configuration->getRoutes() as $key=>$route) {
            if ($this->routeMatch($route, $requestedUri)) {
                $this->request->getCurrentRoute()
                    ->setRouteName($key)
                    ->setRoutePath($route['path'])
                    ->setController($route['controller'])
                    ->setAction($route['action'])
                ;
                $this->request->setModule($route['module']);
                $this->explodeRoute($route['path'], $requestedUri);
                break;
            }
        }

    }

    protected function routeMatch(array $route, string $requestedUri): bool
    {
        if (!isset($route['path'])) {
            //@todo réfléchir si on claque une exception à ce moment là
            return false;
        }
        $path = trim($route['path'], '/');
        $requestedUri = trim($requestedUri, '/');

        if($path == $requestedUri){
            return true;
        }

        //@todo, gérer les paramètres optionnels regex, certainement
        $pattern = explode('/', $path);
        $uriParts = explode('/', $requestedUri);
        if(count($uriParts) !== count($pattern)){
            return false;
        }
        for ($i = 0; $i < count($pattern); $i++) {
            $string = $pattern[$i];
            if ($string[0] != ':' && $uriParts[$i] != $string) {
                return false;
            }
        }
        return true;
    }

    protected function explodeRoute(string $path, string $requestedUri): void
    {
        $path = trim($path, '/');
        $requestedUri = trim($requestedUri, '/');
        $pattern = explode('/', $path);
        $uriParts = explode('/', $requestedUri);
        for ($i = 0; $i < count($pattern); $i++) {
            $string = $pattern[$i];
            if (strlen($string) == 0){
                continue;
            }
            if($string[0] != ':'){
                continue;
            }
            $string = substr($string, 1);
            if($string == 'action') {
                $this->request->getCurrentRoute()
                    ->setAction($uriParts[$i])
                ;
                continue;
            }

            $this->request->getCurrentRoute()
                ->addGet($string, $uriParts[$i]);
        }
    }

}