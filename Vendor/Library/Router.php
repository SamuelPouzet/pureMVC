<?php

namespace Vendor\Library;

use Vendor\Library\Exceptions\NotFoundException;
use Vendor\Library\ResponseStrategy\RedirectResponse;
use Vendor\Library\Services\NavigationService;

/**
 *
 */
class Router
{
    /**
     * @var Container
     */
    protected Container $container;

    /**
     * @var Request
     */
    protected Request $request;

    /**
     * @var Response
     */
    protected Response $response;

    /**
     * @var array
     */
    protected array $routes = [];

    /**
     * @param Container $container
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Container $container, Request $request, Response $response)
    {
        $this->container = $container;
        $this->request = $request;
        $this->response = $response;
        $this->getRoutesArray();
    }

    /**
     * @return void
     * @throws NotFoundException
     */
    public function route()
    {

        $requestedUri = $this->request->getUri();

        $uriParts = explode('/', trim($requestedUri, '/'));
        $routeMatched = $this->findRoute($this->routes, $uriParts);

        if (!$routeMatched) {
            throw new NotFoundException();
        }
        $route = $this->container->getConfiguration()->getConfig('routes')[$routeMatched];
        $getData = $this->getDataFromRoute($requestedUri, $route['path']);
        $this->createRoute($routeMatched, $route, $getData);
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function getRoutesArray(): void
    {
        $routes = $this->container->getConfiguration()->getConfig('routes');
        $routesArray = [];
        foreach ($routes as $key => $route) {
            $path = explode('/', trim($route['path'], '/'));
            $routesArray = array_merge_recursive($routesArray, $this->explodeRoute($path, $key));
        }
        $this->routes = $routesArray;
    }

    /**
     * @param array $path
     * @param string $name
     * @return array
     */
    protected function explodeRoute(array $path, string $name): array
    {
        $return = [];
        $element = '/' . array_shift($path);
        $isVariable = (bool)strpos($element, ':');
        $key = $isVariable ? '?' : $element;
        if (count($path) == 0) {
            $return[$key] = $name;
            return $return;
        }
        $return[$key] = $this->explodeRoute($path, $name);
        return $return;
    }

    /**
     * @param string $routename
     * @param array $route
     * @param array $getData
     * @return void
     */
    protected function createRoute(string $routename, array $route, array $getData): void
    {
        $module = explode('\\', $route['controller']);
        $action = $getData['action'] ?? $route['action'];
        $this->request->getCurrentRoute()
            ->setRouteName($routename)
            ->setRoutePath($route['path'])
            ->setController($route['controller'])
            ->setAction($action)
            ->setModule(array_shift($module))
            ->setGets($getData);
    }

    /**
     * @param array $routes
     * @param array $uriParts
     * @return string|null
     */
    protected function findRoute(array $routes, array $uriParts): ?string
    {
        $part = '/' . array_shift($uriParts);
        $variable = '?';

        if (isset($routes[$part]) || isset($routes[$variable])) {

            foreach ([$part, $variable] as $key) {
                if (!isset($routes[$key])) {
                    continue;
                }
                if (is_scalar($routes[$key])) {
                    return $routes[$key];
                }

                if(($key == $variable && $uriParts) || $key == $part){
                    $goodRoute = $this->findRoute($routes[$key], $uriParts);
                    if ($goodRoute) {
                        return $goodRoute;
                    }
                }
            }
        }
        return false;
    }


    /**
     * @param string $requestedUrl
     * @param string $path
     * @return array
     */
    private function getDataFromRoute(string $requestedUrl, string $path): array
    {
        $explPath = explode('/', trim($path, '/'));
        $explUrl = explode('/', trim($requestedUrl, '/'));
        $return = [];

        foreach ($explPath as $pathElement) {
            $element = array_shift($explUrl);
            if ($pathElement[0] !== ':') {
                continue;
            }
            $key = substr($pathElement, 1);
            $return[$key] = $element;
        }
        return $return;
    }

}