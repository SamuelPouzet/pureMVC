<?php

namespace Vendor\Library;

class Renderer
{

    public function __construct()
    {

    }

    public function render(string $path, array $params)
    {
        if(! is_file($path)){
            throw new \Exception('file not found ' . $path);
        }

        foreach ($params as $key=>$param)
        {
            $this->$key = $param;
            $$key = $param;
        }

        ob_start();
        require $path;
        return ob_get_clean();
    }

}