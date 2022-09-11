<?php

namespace Vendor\Library;

use Vendor\Library\ResponseStrategy\RedirectResponse;

class Router
{
    protected $container;

    protected $request;

    protected $response;

    public function __construct(Container $container, Request $request, Response $response)
    {
        $this->container = $container;
        $this->request = $request;
        $this->response = $response;
    }

    public function route()
    {
        $routes = $this->container->getConfiguration()->getConfig('routes');
        $requestedUri = $this->request->getUri();
        if($requestedUri == '/'){
            $this->createRoute('index', $routes['index']);
            return;
        }

        foreach ( $routes as $key=>$route) {
            if($route['path'] == '/'){
                continue;
            }
            if ($this->routeMatch($route, $requestedUri)) {
                $this->createRoute($key, $route);
                //@todo faire mieux en utilisant la requete
                $this->explodeRoute($route['path'], $requestedUri );
                return;
            }
        }

        $error = new RedirectResponse();
        $error->toRoute('404');

    }

    protected function createRoute(string $routename, array $route): void
    {
        $module = explode('\\', $route['controller']);
        $this->request->getCurrentRoute()
            ->setRouteName($routename)
            ->setRoutePath($route['path'])
            ->setController($route['controller'])
            ->setAction($route['action'])
            ->setModule(array_shift($module));
        ;
    }

    protected function routeMatch(array $route, string $requestedUri): bool
    {
        if (!isset($route['path'])) {
            //la route n'est pas définie, on ne la teste pas
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

        for ($i = 0; $i < count($pattern); $i++) {
            $string = $pattern[$i];
            if($string === ''){
                throw new \Exception('pattern cannot be empty');
            }
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