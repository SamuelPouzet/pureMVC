<?php

namespace Vendor\Library;

use Vendor\Library\Exceptions\NotFoundException;
use Vendor\Library\ResponseStrategy\RedirectResponse;
use Vendor\Library\Services\NavigationService;

class Router
{
    protected Container $container;

    protected Request $request;

    protected Response $response;

    protected array $routes = [];

    public function __construct(Container $container, Request $request, Response $response)
    {
        $this->container = $container;
        $this->request = $request;
        $this->response = $response;
        $this->getRoutesArray();
    }

    public function route()
    {

        $requestedUri = $this->request->getUri();

        $uriParts = explode('/',trim( $requestedUri, '/') );
        $routeMatched = $this->findRoute($this->routes, $uriParts);

        if(! $routeMatched){
            throw new NotFoundException();
        }
        $route = $this->container->getConfiguration()->getConfig('routes')[$routeMatched];
        $this->createRoute($routeMatched, $route);
    }

    protected function getRoutesArray(): void
    {
        $routes = $this->container->getConfiguration()->getConfig('routes');
        $routesArray = [];
        foreach($routes as $key=>$route){
            $path = explode('/', trim($route['path'], '/'));
            $routesArray = array_merge_recursive($routesArray, $this->explodeRoute($path, $key));
        }
        $this->routes = $routesArray;
    }

    protected function explodeRoute(array $path, string $name): array
    {
        $return = [];
        $element = '/' . array_shift($path);
        $isVariable = (bool) strpos($element, ':');
        $key =  $isVariable?'?':$element;
        if(count($path) == 0){
            $return[$key] = $name;
            return $return;
        }
        $return[$key] = $this->explodeRoute($path, $name);
        if($isVariable){
            $return[$key]['_variableName'] = substr($element, 2);
        }
        return $return;
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

    protected function findRoute(array $routes, array $uriParts): ?string
    {

        $part = '/' . array_shift($uriParts);
        $variable = '/?';

        if(isset($routes[$part])){
            $route = $routes[$part];

            if(is_scalar($route)){
                return $route;
            }
            return $this->findRoute($route, $uriParts);
        }elseif (isset($route[$variable])) {
            $route = $routes[$variable];
            if(is_scalar($route)){
                return $route;
            }
            return $this->findRoute($route, $uriParts);
        }
        return false;
    }

}