<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit34729d75b41cc931c1f095c1a9930c0f
{
    public static $files = array (
        '6e4c43567e203d686c92a323d55acff5' => __DIR__ . '/../..' . '/includes/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WeDevs\\Academy\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WeDevs\\Academy\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit34729d75b41cc931c1f095c1a9930c0f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit34729d75b41cc931c1f095c1a9930c0f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit34729d75b41cc931c1f095c1a9930c0f::$classMap;

        }, null, ClassLoader::class);
    }
}
