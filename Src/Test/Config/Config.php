<?php

namespace Test\Config;

use Application\Controller\IndexController;
use Test\Controller\Factory\TestControllerFactory;
use Test\Controller\TestController;
use Vendor\Library\Interfaces\ConfigInterface;


return [
    'routes'=> [
        'test2'=>[
            'path'=>'/test/:action',
            'controller'=>TestController::class,
            'action'=>'index',
        ],
        'test3'=>[
            'path'=>'/toto',
            'controller'=>IndexController::class,
            'action'=>'index',
        ],
    ],
    'controllers'=>[
        TestController::class=>TestControllerFactory::class,
    ],
    'views_renderers'=>[
        'view_templates'=>[
            __DIR__ . DS . '..' . DS . 'Views',
            __DIR__ . DS . '..' . DS . 'View',
        ],
    ],
];