<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfea52e252f448f30495266921dde27c1
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfea52e252f448f30495266921dde27c1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfea52e252f448f30495266921dde27c1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfea52e252f448f30495266921dde27c1::$classMap;

        }, null, ClassLoader::class);
    }
}
