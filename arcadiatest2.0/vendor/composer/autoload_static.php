<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb7b3fc1a3ae5f77be30780ddce46acae
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb7b3fc1a3ae5f77be30780ddce46acae::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb7b3fc1a3ae5f77be30780ddce46acae::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb7b3fc1a3ae5f77be30780ddce46acae::$classMap;

        }, null, ClassLoader::class);
    }
}
