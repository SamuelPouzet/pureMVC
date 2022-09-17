<?php

namespace Test\Config;

use Vendor\Library\Controllers\ErrorController;
use Vendor\Library\Controllers\Factory\ErrorControllerFactory;
use Vendor\Library\Controllers_plugins\Factories\RedirectPluginFactory;
use Vendor\Library\Controllers_plugins\RedirectPlugin;
use Vendor\Library\Services\Factory\NavigationServiceFactory;
use Vendor\Library\Services\NavigationService;


return [
    'routes'=> [
        '404'=>[
            'path'=>'/404',
            'controller'=>ErrorController::class,
            'action'=>'error404',
        ],
        '500'=>[
            'path'=>'/500',
            'controller'=>ErrorController::class,
            'action'=>'error500',
        ],
    ],
    'controllers'=> [
        ErrorController::class=>ErrorControllerFactory::class,
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