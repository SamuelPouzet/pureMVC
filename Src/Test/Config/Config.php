<?php

namespace Test\Config;

use Application\Controller\IndexController;
use Test\Controller\Factory\TestControllerFactory;
use Test\Controller\TestController;
use Test\Views\Viewhelpers\Factory\TestHelperFactory;
use Test\Views\Viewhelpers\TestHelper;
use Vendor\Library\DefaultFactory;
use Vendor\Library\Interfaces\ConfigInterface;


return [
    'routes'=> [
        'test2'=>[
            'path'=>'/test/:action',
            'controller'=>TestController::class,
            'action'=>'index',
        ],
        'test3'=>[
            'path'=>'/test',
            'controller'=>IndexController::class,
            'action'=>'index',
        ],
        'test4'=>[
            'path'=>'/test/test1/:model/:id',
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
    'view_helpers'=>[
        'factories'=>[
            TestHelper::class=>TestHelperFactory::class,
        ],
        'alias'=>[
            'testHelper'=>TestHelper::class,
        ]
    ]
];