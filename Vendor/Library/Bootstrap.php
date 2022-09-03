<?php

namespace Vendor\Library;

use Vendor\Library\Traits\FileTrait;

/**
 *
 */
class Bootstrap
{
    use FileTrait;

    /**
     * @var Configuration
     */
    protected Configuration $configuration;

    /**
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function createRoutes()
    {
        $modules = $this->scanDir(SRC_PATH);
        $routes = [];
        foreach ($modules as $module) {
            $confName = sprintf('%1$s%2$sConfig%2$sConfig', $module, DS);
            try {
                $config = new $confName();
                $moduleroutes = $config->getRoutes();
                $this->addModule($moduleroutes, $module);
                $routes = array_merge($routes, $moduleroutes);
            } catch (\Exception $e) {
                throw new \Exception('Config not found for module');
            }
        }
        $this->configuration->setRoutes($routes);
    }

    /**
     * @param array $routes
     * @param string $module
     * @return void
     */
    protected function addModule(array &$routes, string $module): void
    {
        foreach ($routes as &$route)
        {
            $route['module']=$module;
        }
    }

}