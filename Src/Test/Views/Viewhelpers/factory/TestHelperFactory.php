<?php

namespace Test\Views\Viewhelpers\Factory;

use Test\Views\Viewhelpers\TestHelper;

class TestHelperFactory
{

    public function __invoke()
    {
        return new TestHelper();
    }

}