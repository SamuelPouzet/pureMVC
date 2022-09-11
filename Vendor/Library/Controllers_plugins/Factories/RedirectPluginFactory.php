<?php

namespace Vendor\Library\Controllers_plugins\Factories;

use Vendor\Library\Container;
use Vendor\Library\Controllers_plugins\RedirectPlugin;
use Vendor\Library\Interfaces\FactoryInterface;

class RedirectPluginFactory implements FactoryInterface
{
    
    public function __invoke(Container $container, ?string $controllerName = null)
    {
        return new RedirectPlugin();
    }

}