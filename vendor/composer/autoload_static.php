<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6f162ac2df7a86fb1bead6c2feb0c8a8
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
    );

    public static $prefixesPsr0 = array (
        'M' => 
        array (
            'Monolog' => 
            array (
                0 => __DIR__ . '/..' . '/monolog/monolog/src',
            ),
        ),
        'F' => 
        array (
            'Fuel\\Upload' => 
            array (
                0 => __DIR__ . '/..' . '/fuelphp/upload/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6f162ac2df7a86fb1bead6c2feb0c8a8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6f162ac2df7a86fb1bead6c2feb0c8a8::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit6f162ac2df7a86fb1bead6c2feb0c8a8::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
