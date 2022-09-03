<?php

namespace Application\Controller;

use Vendor\Library\AbstractController;
use Vendor\Library\View;

class IndexController extends AbstractController
{

    public function indexAction()
    {
        return ['test'=>1];
    }

    public function afficherAction()
    {
        return ['test'=>1];
    }

}