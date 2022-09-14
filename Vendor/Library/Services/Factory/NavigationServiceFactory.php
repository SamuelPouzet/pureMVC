<?php

namespace Vendor\Library\Services\Factory;

use Vendor\Library\Container;
use Vendor\Library\Interfaces\FactoryInterface;
use Vendor\Library\Services\NavigationService;

class NavigationServiceFactory implements FactoryInterface
{

    public function __invoke(Container $container, ?string $controllerName = null)
    {
        $routes = $container->getConfiguration()->getConfig('routes');
        return new NavigationService($routes);
    }

}