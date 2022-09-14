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
        //$this->redirect()->toUrl('https://developer.mozilla.org/en-US/docs/Web/HTTP/Status#redirection_messages');
        //$this->redirect()->toRoute('test2');
        return $view;
    }

    public function afficherAction()
    {
        return ['test'=>1];
    }

}