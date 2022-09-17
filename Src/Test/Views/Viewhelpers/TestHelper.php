<?php

namespace Test\Views\Viewhelpers;

class TestHelper
{
    public function __invoke()
    {
        return 'vous êtes dans le helper test';
    }

}