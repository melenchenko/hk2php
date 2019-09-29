<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdfb68feed03e124b27ef1bbddf8cab4f
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'VK\\' => 3,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'VK\\' => 
        array (
            0 => __DIR__ . '/..' . '/vkcom/vk-php-sdk/src/VK',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdfb68feed03e124b27ef1bbddf8cab4f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdfb68feed03e124b27ef1bbddf8cab4f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}