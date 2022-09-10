<?php
declare(strict_types=1);
namespace Application;

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

    public static function getModule(): string
    {
        return __NAMESPACE__;
    }
}