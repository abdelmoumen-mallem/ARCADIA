<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfade9d3e375d4ccff80a2ccefcfd2685
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Src\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Src\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfade9d3e375d4ccff80a2ccefcfd2685::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfade9d3e375d4ccff80a2ccefcfd2685::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfade9d3e375d4ccff80a2ccefcfd2685::$classMap;

        }, null, ClassLoader::class);
    }
}
