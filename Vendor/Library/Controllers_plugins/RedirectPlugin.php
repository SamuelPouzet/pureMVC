<?php

namespace Vendor\Library\Controllers_plugins;

use Vendor\Library\ResponseStrategy\RedirectResponse;

class RedirectPlugin
{

    public function __invoke()
    {
        return new RedirectResponse();
    }
}