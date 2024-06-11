<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2af4e34babb3b1461f9489753cdfff25
{
    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'Extendify\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Extendify\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2af4e34babb3b1461f9489753cdfff25::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2af4e34babb3b1461f9489753cdfff25::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
