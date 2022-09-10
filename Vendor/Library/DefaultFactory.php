<?php

namespace Vendor\Library;

use Vendor\Library\Interfaces\FactoryInterface;

class DefaultFactory implements FactoryInterface
{

    public function __invoke(Container $container, ?string $controllerName = null)
    {
        //@todo, check controller's existence
        return new $controllerName;
    }

}