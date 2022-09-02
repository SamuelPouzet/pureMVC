<?php

namespace Application\Config;

use Application\Controller\IndexController;
use Vendor\Library\Interfaces\ConfigInterface;

class Config implements ConfigInterface
{

    public function getRoutes()
    {
        return [
            'index'=>[
                'path'=>'/',
                'controller'=>IndexController::class,
                'action'=>'index',
            ],
            'application'=>[
                'path'=>'/index/:action/:id/:value',
                'controller'=>IndexController::class,
                'action'=>'index',
            ],
        ];
    }

}