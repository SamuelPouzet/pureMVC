<?php

namespace Vendor\Library;

use Vendor\Library\Interfaces\ModuleInterface;

class Library implements ModuleInterface
{
    public function getConfig(): array
    {
        return require_once __DIR__ . DS . 'Config' . DS . "Config.php";
    }
}