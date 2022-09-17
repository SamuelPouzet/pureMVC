<?php

namespace Vendor\Library;

final class Container
{
    protected array $elements = [];
    private Configuration $configuration;

    private const DI = ['controllers', 'services'];

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
        foreach (self::DI as $di){
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

    public function has(string $class): bool
    {
        if(isset($this->elements['$class'])){
            return true;
        }
        $config = $this->configuration->getConfig();
        foreach (self::DI as $di){
            if(isset($config[$di])){
               continue;
            }
            if(isset($config[$di][$class])) {
                return true;
            }
        }
        return false;
    }

}