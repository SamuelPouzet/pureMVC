<?php

namespace Vendor\Library\Controllers_plugins;

use Vendor\Library\ResponseStrategy\RedirectResponse;
use Vendor\Library\Services\NavigationService;

class RedirectPlugin
{

    protected NavigationService $navigationService;

    public function __construct(NavigationService $navigationService)
    {
        $this->navigationService = $navigationService;
    }

    public function __invoke()
    {
        return new RedirectResponse($this->navigationService);
    }
}