<?php

namespace Vendor\Library\ResponseStrategy;

/**
 *
 */
class RedirectResponse
{

    /**
     * @param string $routeName
     * @param array $params
     * @param $code
     * @return void
     */
    public function toRoute(string $routeName, array $params=[], $code=403): void
    {
        //@todo créer un routeService


    }

    /**
     * @param string $url
     * @param int $code
     * @return void
     */
    public function toUrl(string $url, int $code=403): void
    {
        header(sprintf('location: %1$s', $url), true, $code);
    }

}