<?php

namespace Test\Config;

use Vendor\Library\Controllers\Factory\NotFoundControllerFactory;
use Vendor\Library\Controllers\NotFoundController;
use Vendor\Library\Controllers_plugins\Factories\RedirectPluginFactory;
use Vendor\Library\Controllers_plugins\RedirectPlugin;
use Vendor\Library\Services\Factory\NavigationServiceFactory;
use Vendor\Library\Services\NavigationService;


return [
    'routes'=> [
        '404'=>[
            'path'=>'/404',
            'controller'=>NotFoundController::class,
            'action'=>'error404',
        ],
    ],
    'controllers'=> [
        NotFoundController::class=>NotFoundControllerFactory::class,
    ],
    'services'=>[
        NavigationService::class=>NavigationServiceFactory::class,
    ],
    'controller_plugins' => [
        'factories' => [
            RedirectPlugin::class=>RedirectPluginFactory::class,
        ],
        'alias' => [
            'redirect'=>RedirectPlugin::class,
        ]
    ],
    'views_renderers' => [
        'view_templates' => [
            __DIR__ . DS . '..' . DS . 'View',
        ],
    ],
];