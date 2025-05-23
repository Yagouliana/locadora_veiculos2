<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit03f732cd6df5eb41336d86ded4510fb5
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Services\\' => 9,
        ),
        'M' => 
        array (
            'Models\\' => 7,
        ),
        'I' => 
        array (
            'Interfaces\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Services\\' => 
        array (
            0 => __DIR__ . '/../..' . '/services',
        ),
        'Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/models',
        ),
        'Interfaces\\' => 
        array (
            0 => __DIR__ . '/../..' . '/interfaces',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit03f732cd6df5eb41336d86ded4510fb5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit03f732cd6df5eb41336d86ded4510fb5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit03f732cd6df5eb41336d86ded4510fb5::$classMap;

        }, null, ClassLoader::class);
    }
}
