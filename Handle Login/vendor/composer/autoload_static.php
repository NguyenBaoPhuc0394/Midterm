<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit59166e7bb5606935b798dd399273467d
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'G' => 
        array (
            'Giahu\\Login\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Giahu\\Login\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit59166e7bb5606935b798dd399273467d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit59166e7bb5606935b798dd399273467d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit59166e7bb5606935b798dd399273467d::$classMap;

        }, null, ClassLoader::class);
    }
}
