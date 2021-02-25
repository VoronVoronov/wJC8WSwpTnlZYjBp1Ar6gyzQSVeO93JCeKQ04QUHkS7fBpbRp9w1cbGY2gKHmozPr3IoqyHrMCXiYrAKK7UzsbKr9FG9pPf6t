<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitebd1ec95788004842d64851afa4e462f
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        'c964ee0ededf28c96ebd9db5099ef910' => __DIR__ . '/..' . '/guzzlehttp/promises/src/functions_include.php',
        'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/functions_include.php',
        '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/functions_include.php',
    );

    public static $prefixLengthsPsr4 = array (
        'b' => 
        array (
            'baibaratsky\\WebMoney\\' => 21,
        ),
        'T' => 
        array (
            'TwitchApi\\' => 10,
        ),
        'Q' => 
        array (
            'Qiwi\\Api\\' => 9,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Http\\Client\\' => 16,
        ),
        'N' => 
        array (
            'NewTwitchApi\\Tests\\' => 19,
            'NewTwitchApi\\' => 13,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
            'GuzzleHttp\\Promise\\' => 19,
            'GuzzleHttp\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'baibaratsky\\WebMoney\\' => 
        array (
            0 => __DIR__ . '/..' . '/baibaratsky/php-webmoney',
            1 => __DIR__ . '/..' . '/baibaratsky/php-wmsigner',
        ),
        'TwitchApi\\' => 
        array (
            0 => __DIR__ . '/..' . '/nicklaw5/twitch-api-php/src',
        ),
        'Qiwi\\Api\\' => 
        array (
            0 => __DIR__ . '/..' . '/qiwi/bill-payments-php-sdk/src',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Http\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-client/src',
        ),
        'NewTwitchApi\\Tests\\' => 
        array (
            0 => __DIR__ . '/..' . '/nicklaw5/twitch-api-php/test/NewTwitchApi',
        ),
        'NewTwitchApi\\' => 
        array (
            0 => __DIR__ . '/..' . '/nicklaw5/twitch-api-php/src/NewTwitchApi',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
        'GuzzleHttp\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/promises/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'C' => 
        array (
            'Curl' => 
            array (
                0 => __DIR__ . '/..' . '/curl/curl/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitebd1ec95788004842d64851afa4e462f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitebd1ec95788004842d64851afa4e462f::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitebd1ec95788004842d64851afa4e462f::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitebd1ec95788004842d64851afa4e462f::$classMap;

        }, null, ClassLoader::class);
    }
}
