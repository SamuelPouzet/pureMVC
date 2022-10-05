<?php

namespace Vendor\Library\Interfaces;

interface ViewInterface
{

    public static function header();
    public static function getStrategy();
    public function render();

}