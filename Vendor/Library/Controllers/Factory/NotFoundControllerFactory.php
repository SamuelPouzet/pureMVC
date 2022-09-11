<?php

namespace Vendor\Library\Controllers\Factory;

use Vendor\Library\Container;
use Vendor\Library\Controllers\NotFoundController;
use Vendor\Library\Interfaces\FactoryInterface;

class NotFoundControllerFactory implements FactoryInterface
{

    public function __invoke(Container $container, ?string $controllerName = null)
    {
        return new NotFoundController();
    }
}