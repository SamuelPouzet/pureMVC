<?php

namespace Vendor\Library\Controllers;

use Vendor\Library\AbstractController;
use Vendor\Library\ViewStrategy\View;

class ErrorController extends AbstractController
{
    public function error404Action(): View
    {
        return new View();
    }

    public function error500Action(): View
    {
        return new View();
    }

}