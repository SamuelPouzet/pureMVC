<?php

namespace Vendor\Library\Controllers;

use Vendor\Library\AbstractController;
use Vendor\Library\ViewStrategy\View;

class NotFoundController extends AbstractController
{

    public function __construct()
    {
        //die('dans le constructeur');
    }

    public function error404Action()
    {
        $view = new View();

        return $view;
    }

}