<?php

namespace Test\Config;

use Application\Controller\IndexController;
use Vendor\Library\Interfaces\ConfigInterface;

class Config implements ConfigInterface
{

    public function getRoutes()
    {
        return [
            'test2'=>[
                'path'=>'/test',
                'controller'=>IndexController::class,
                'action'=>'index',
            ],
            'test3'=>[
                'path'=>'/toto',
                'controller'=>IndexController::class,
                'action'=>'index',
            ],
        ];
    }

}