<?php

namespace Test\Controller\Factory;

use Application\Controller\IndexController;
use Test\Controller\TestController;
use Vendor\Library\Container;
use Vendor\Library\Interfaces\FactoryInterface;

class TestControllerFactory implements FactoryInterface
{

    public function __invoke(Container $container, ?string $controllerName = null)
    {
        $test = ["a"=>'yoshi', "b"=>"mario", "c"=>"luigi"];
        return new TestController($test);
    }

}