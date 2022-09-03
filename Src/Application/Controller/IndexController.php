<?php

namespace Application\Controller;

use Vendor\Library\AbstractController;
use Vendor\Library\View;

class IndexController extends AbstractController
{

    public function indexAction()
    {
print('indexAction');
    }

    public function afficherAction()
    {
        return ['test'=>1];
    }

}