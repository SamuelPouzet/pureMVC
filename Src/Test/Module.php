<?php

namespace Test;

use Vendor\Library\Interfaces\ModuleInterface;

/**
 *
 */
class Module implements ModuleInterface
{
    public function getConfig(): array
    {
        return require_once __DIR__ . DS . 'Config' . DS . "Config.php";
    }
}