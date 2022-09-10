<?php

namespace Application\Controller\Factory;

use Application\Controller\IndexController;
use Vendor\Library\Container;
use Vendor\Library\Interfaces\FactoryInterface;

class IndexControllerFactory implements FactoryInterface
{

    public function __invoke(Container $container)
    {
        $test = ["a"=>'yoshi', "b"=>"mario", "c"=>"luigi"];
        return new IndexController($test);
    }

}