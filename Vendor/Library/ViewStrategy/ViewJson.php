<?php

namespace Vendor\Library\ViewStrategy;

use Vendor\Library\AbstractView;
use Vendor\Library\Interfaces\ViewInterface;

class ViewJson extends AbstractView  implements ViewInterface
{
    private const JSON_STRATEGY = 'JSON';

    public static function getStrategy(): string
    {
        return self::JSON_STRATEGY;
    }

    public static function header()
    {
        header('Content-Type: application/json');
    }

    public function render(): string
    {
        return json_encode($this->data);
    }

}