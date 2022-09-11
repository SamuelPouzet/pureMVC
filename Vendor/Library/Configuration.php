<?php
declare(strict_types=1);

namespace Vendor\Library;

/**
 *
 */
class Configuration
{

    /**
     * @var array|false
     */
    protected array $moduleDir;
    /**
     * @var string
     */
    protected string $configDir;
    /**
     * @var array
     */
    protected array $config;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->configDir = ROOT_PATH . DS . "Config";
        $this->moduleDir = array_diff(scandir(SRC_PATH), ['.', '..']);;
        $this->init();
    }

    /**
     * @return void
     * @todo mettre en cache le tableau des configs pour gagner en performances
     */
    protected function init(): void
    {
        $config = [];


        //get library configuration can be overriden
        $class = new Library();
        $config = array_merge_recursive($config, $class->getConfig());

        $path = $this->configDir . DS . 'Autoload';
        //get general configuration
        if (!is_dir($path)) {
            throw new \Exception('/Config/Autoload directory not found');
        }
        $files = array_diff(scandir($path), ['.', '..']);
        foreach ($files as $file) {
            if (strpos($file, '.config.php')) {
                $filePath = $path . DS . $file;
                $config = array_merge_recursive($config, $this->getFrameworkConfig($filePath));
            }
        }

        // get configuration needed by each module
        foreach ($this->moduleDir as $module) {
            $className = sprintf('%1$s\Module', ucfirst(strtolower($module)));
            $class = new $className();
            if (!method_exists($class, 'getConfig')) {
                throw new \Exception('Module class must implements method getConfig');
            }
            $config = array_merge_recursive($config, $class->getConfig());
        }
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function getModuleDir(): array
    {
        return $this->moduleDir;

    }

    /**
     * @param string $filePath
     * @return array
     */
    protected function getFrameworkConfig(string $filePath): array
    {
        return require_once $filePath;
    }

    /**
     * @param string|null $key
     * @return array
     * @throws \Exception
     */
    public function getConfig(?string $key=null): array
    {
        if ($key) {
            if (!isset($this->config[$key])) {
                throw new \Exception(sprintf('key %1$s not found in config', '$key'));
            }
            return $this->config[$key];
        }
        return $this->config;
    }

}