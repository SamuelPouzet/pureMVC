<?php

namespace Vendor\Library\Controllers_plugins\Factories;

use Vendor\Library\Container;
use Vendor\Library\Controllers_plugins\RedirectPlugin;
use Vendor\Library\Interfaces\FactoryInterface;
use Vendor\Library\Services\NavigationService;

class RedirectPluginFactory implements FactoryInterface
{
    
    public function __invoke(Container $container, ?string $controllerName = null)
    {
        $NavigationService = $container->get(NavigationService::class);
        return new RedirectPlugin($NavigationService);
    }

}