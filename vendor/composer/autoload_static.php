<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit484aec29e4e40b64a309564bd74f89b6
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit484aec29e4e40b64a309564bd74f89b6::$classMap;

        }, null, ClassLoader::class);
    }
}
