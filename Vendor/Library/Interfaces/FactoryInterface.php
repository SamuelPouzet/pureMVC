<?php

namespace Vendor\Library\Interfaces;

use Vendor\Library\Container;

/**
 *
 */
interface FactoryInterface
{
    /**
     * @param Container $container
     * @return mixed
     */
    public function __invoke(Container $container);
}