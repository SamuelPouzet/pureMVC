<?php

namespace Application\Controller;

use Vendor\Library\AbstractController;
use Vendor\Library\AbstractView;
use Vendor\Library\ViewStrategy\View;
use Vendor\Library\ViewStrategy\ViewJson;

class IndexController extends AbstractController
{

    public function __construct(array $test)
    {
        $this->test = $test;
    }

    public function indexAction(): AbstractView
    {
        $view = new View($this->test);

        var_dump($this->redirect()->toUrl('https://www.bluehost.com/help/article/php-redirect'));

        return $view;
    }

    public function afficherAction()
    {
        return ['test'=>1];
    }

}