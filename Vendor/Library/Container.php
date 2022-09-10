<?php

namespace Vendor\Library;

class Container
{
    protected array $elements = [];
    protected Configuration $configuration;

    public function __construct()
    {
        $this->configuration = new Configuration();

    }

    public function getConfiguration()
    {
        return $this->configuration;
    }

    public function get(string $class)
    {
        if(isset($this->elements[$class])){
            return $this->elements[$class];
        }

        $config = $this->configuration->getConfig();
        foreach (['controllers', 'services'] as $di){
            if(!isset($config[$di])){
                continue;
            }
            if(!isset($config[$di][$class])){
                continue;
            }
            $factoryName = $config[$di][$class];
            $factory = new $factoryName();

            $this->elements[$class] = $factory($this);
            return $this->elements[$class];
        }

    }

}