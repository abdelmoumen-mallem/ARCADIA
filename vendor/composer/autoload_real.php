<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitfade9d3e375d4ccff80a2ccefcfd2685
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitfade9d3e375d4ccff80a2ccefcfd2685', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitfade9d3e375d4ccff80a2ccefcfd2685', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitfade9d3e375d4ccff80a2ccefcfd2685::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
