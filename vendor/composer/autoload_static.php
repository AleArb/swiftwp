<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb36078190832b382c51886a4411bbcb0
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Swift\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Swift\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb36078190832b382c51886a4411bbcb0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb36078190832b382c51886a4411bbcb0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb36078190832b382c51886a4411bbcb0::$classMap;

        }, null, ClassLoader::class);
    }
}
