<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4dc23c3cd971cc6de85ba24f7cdf6673
{
    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'Kampak\\LibSignPDF\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Kampak\\LibSignPDF\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit4dc23c3cd971cc6de85ba24f7cdf6673::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4dc23c3cd971cc6de85ba24f7cdf6673::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4dc23c3cd971cc6de85ba24f7cdf6673::$classMap;

        }, null, ClassLoader::class);
    }
}
