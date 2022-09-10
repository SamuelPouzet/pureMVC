<?php

namespace Vendor\Library\ViewStrategy;

use Vendor\Library\AbstractView;
use Vendor\Library\Interfaces\ViewInterface;

class ViewJson extends AbstractView  implements ViewInterface
{

    public function render()
    {
        header("Content-Type: application/json;charset=utf-8");
        $this->hasLayout= false;
        return json_encode($this->data);
    }

}