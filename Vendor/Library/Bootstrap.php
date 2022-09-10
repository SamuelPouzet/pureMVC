<?php
declare(strict_types=1);

namespace Vendor\Library;

use Vendor\Library\Traits\FileTrait;

/**
 *
 */
class Bootstrap
{
    use FileTrait;

    /**
     * @var Container
     */
    protected Container $container;

    /**
     */
    public function __construct()
    {
            $this->container = new Container();
    }

    public function getContainer(): Container
    {
        return $this->container;
    }


}