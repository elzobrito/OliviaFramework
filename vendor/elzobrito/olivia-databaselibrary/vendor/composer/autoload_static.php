<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdd122f9c73b6b68172f6ae05070c1589
{
    public static $prefixLengthsPsr4 = array (
        'O' => 
        array (
            'OliviaDatabasePublico\\' => 22,
            'OliviaDatabaseModel\\' => 20,
            'OliviaDatabaseLibrary\\' => 22,
            'OliviaDatabaseConfig\\' => 21,
            'OliviaCache\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'OliviaDatabasePublico\\' => 
        array (
            0 => __DIR__ . '/../..' . '/public_html',
        ),
        'OliviaDatabaseModel\\' => 
        array (
            0 => __DIR__ . '/../..' . '/model',
        ),
        'OliviaDatabaseLibrary\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'OliviaDatabaseConfig\\' => 
        array (
            0 => __DIR__ . '/../..' . '/config',
        ),
        'OliviaCache\\' => 
        array (
            0 => __DIR__ . '/..' . '/elzobrito/olivia-cache/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdd122f9c73b6b68172f6ae05070c1589::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdd122f9c73b6b68172f6ae05070c1589::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdd122f9c73b6b68172f6ae05070c1589::$classMap;

        }, null, ClassLoader::class);
    }
}