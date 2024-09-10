<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita5f7f27f966a09b460f5f6d86877c6af
{
    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'Hp\\SchoolManegmentSystem\\' => 25,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Hp\\SchoolManegmentSystem\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita5f7f27f966a09b460f5f6d86877c6af::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita5f7f27f966a09b460f5f6d86877c6af::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita5f7f27f966a09b460f5f6d86877c6af::$classMap;

        }, null, ClassLoader::class);
    }
}
