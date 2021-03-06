<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit80721dbca563a68a95ea3bbe3b268ab9
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Azlk\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Azlk\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit80721dbca563a68a95ea3bbe3b268ab9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit80721dbca563a68a95ea3bbe3b268ab9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit80721dbca563a68a95ea3bbe3b268ab9::$classMap;

        }, null, ClassLoader::class);
    }
}
