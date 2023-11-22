<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit5b2031ebf8eb1ae1e2ed1571a21a69f3
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit5b2031ebf8eb1ae1e2ed1571a21a69f3', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit5b2031ebf8eb1ae1e2ed1571a21a69f3', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit5b2031ebf8eb1ae1e2ed1571a21a69f3::getInitializer($loader));

        $loader->setClassMapAuthoritative(true);
        $loader->register(true);

        $includeFiles = \Composer\Autoload\ComposerStaticInit5b2031ebf8eb1ae1e2ed1571a21a69f3::$files;
        foreach ($includeFiles as $fileIdentifier => $file) {
            composerRequire5b2031ebf8eb1ae1e2ed1571a21a69f3($fileIdentifier, $file);
        }

        return $loader;
    }
}

/**
 * @param string $fileIdentifier
 * @param string $file
 * @return void
 */
function composerRequire5b2031ebf8eb1ae1e2ed1571a21a69f3($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

        require $file;
    }
}
