<?php

namespace Vendor\Library\Controllers\Factory;

use Vendor\Library\Container;
use Vendor\Library\Controllers\ErrorController;
use Vendor\Library\Interfaces\FactoryInterface;

class ErrorControllerFactory implements FactoryInterface
{

    public function __invoke(Container $container, ?string $controllerName = null)
    {
        return new ErrorController();
    }

}