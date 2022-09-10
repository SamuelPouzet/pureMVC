<?php

namespace Vendor;

/**
 * generates an autoloader
 */
class autoloader
{


    /**
     * @return void
     */
    public static function register(): void
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    /**
     * @param string $className
     * @return void
     * @throws \Exception
     */
    public static function autoload(string $className): void
    {

        $parts = explode('\\', $className);

        //on récupère le nom de la classe
        $className = array_pop($parts);

        $path = implode(DS, array_map('self::formatDirectoryName', $parts));

        $file = $path . DS . $className . '.php';

        //on regarde en priorité si on a la classe dans le vendor
        if(is_file(ROOT_PATH . DS . $file)){
            require_once ROOT_PATH . DS . $file;
            return;
        }

        //sinon, on regarde dans les modules
        if(is_file(SRC_PATH . DS . $file)){

            require_once SRC_PATH . DS . $file;
            return;
        }

        throw new \Exception(sprintf('la classe : %1$s n\'a pas pu être trouvée', ROOT_PATH . DS . $file));
    }

    /**
     * @param $directory
     * @return string
     */
    protected static function formatDirectoryName(string $directory): string
    {
        $directory = explode('-', strtolower($directory));
        $directory = array_map('ucfirst', $directory);

        return implode('', $directory);
    }

}