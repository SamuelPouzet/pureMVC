<?php
declare(strict_types=1);

use Application\Controller\IndexController;
use Application\Controller\Factory\IndexControllerFactory;

return [
    'routes' => [
        'index' => [
            'path' => '/',
            'controller' => IndexController::class,
            'action' => 'index',
        ],
        'application' => [
            'path' => '/index/:action/:id/:value',
            'controller' => IndexController::class,
            'action' => 'index',
        ],
    ],
    'controllers' => [
        IndexController::class => indexControllerFactory::class,
    ],
    'controller_plugins' => [
        'factories' => [
            \Application\Controller\Plugins\TestPlugin::class=>\Application\Controller\Plugins\Factory\TestPluginFactory::class,
        ],
        'alias' => [
            'testPlugin'=>\Application\Controller\Plugins\TestPlugin::class,
        ]
    ],
    'views_renderers' => [
        'view_templates' => [
            __DIR__ . DS . '..' . DS . 'Views',
            __DIR__ . DS . '..' . DS . 'View',
        ],
        // key * for all site, modulename for one module
        'layout_templates' => [
            '*' => __DIR__ . DS . '..' . DS . 'Views' . DS . 'Layout' . DS . 'layout.phtml',
            'Application' => __DIR__ . DS . '..' . DS . 'Views' . DS . 'Layout' . DS . 'layout.phtml',
            'Test' => __DIR__ . DS . '..' . DS . 'Views' . DS . 'Layout' . DS . 'layout_test.phtml',
        ],
    ],
];
