<?php

namespace Application\Controller\Plugins\Factory;

use Application\Controller\Plugins\TestPlugin;
use Vendor\Library\Container;
use Vendor\Library\Interfaces\FactoryInterface;

class TestPluginFactory implements FactoryInterface
{
    /**
     * @todo rebaptiser le $controllerName pour que l'inteface matche avec tout ce qui est factorisable
     * @param Container $container
     * @param string|null $controllerName
     * @return mixed|void
     */
    public function __invoke(Container $container, ?string $controllerName = null)
    {
        return new TestPlugin();
    }

}