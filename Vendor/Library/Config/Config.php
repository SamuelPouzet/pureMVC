<?php

namespace Test\Config;

use Vendor\Library\Controllers_plugins\Factories\RedirectPluginFactory;
use Vendor\Library\Controllers_plugins\RedirectPlugin;


return [
    'controller_plugins' => [
        'factories' => [
            RedirectPlugin::class=>RedirectPluginFactory::class,
        ],
        'alias' => [
            'redirect'=>RedirectPlugin::class,
        ]
    ],
];