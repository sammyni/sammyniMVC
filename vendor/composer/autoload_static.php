<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9641e2058b82a19e46fa47dd2c5b5d7f
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Model\\' => 6,
        ),
        'L' => 
        array (
            'Lib\\' => 4,
        ),
        'D' => 
        array (
            'Dotenv\\' => 7,
        ),
        'C' => 
        array (
            'Controller\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Model\\' => 
        array (
            0 => __DIR__ . '/../..' . '/mods',
        ),
        'Lib\\' => 
        array (
            0 => __DIR__ . '/../..' . '/libs',
        ),
        'Dotenv\\' => 
        array (
            0 => __DIR__ . '/../..' . '/sdk/phpdotenv',
        ),
        'Controller\\' => 
        array (
            0 => __DIR__ . '/../..' . '/ctrls',
        ),
    );

    public static $classMap = array (
        'Controller\\AccountController' => __DIR__ . '/../..' . '/ctrls/AccountController.php',
        'Controller\\AuctionController' => __DIR__ . '/../..' . '/ctrls/AuctionController.php',
        'Controller\\CartController' => __DIR__ . '/../..' . '/ctrls/CartController.php',
        'Controller\\CheckoutController' => __DIR__ . '/../..' . '/ctrls/CheckoutController.php',
        'Controller\\CustomerController' => __DIR__ . '/../..' . '/ctrls/CustomerController.php',
        'Controller\\ProductController' => __DIR__ . '/../..' . '/ctrls/ProductController.php',
        'Controller\\ProductsController' => __DIR__ . '/../..' . '/ctrls/ProductsController.php',
        'Controller\\StartController' => __DIR__ . '/../..' . '/ctrls/StartController.php',
        'Dotenv\\Dotenv' => __DIR__ . '/../..' . '/sdk/phpdotenv/Dotenv.php',
        'Dotenv\\Exception\\ExceptionInterface' => __DIR__ . '/../..' . '/sdk/phpdotenv/Exception/ExceptionInterface.php',
        'Dotenv\\Exception\\InvalidCallbackException' => __DIR__ . '/../..' . '/sdk/phpdotenv/Exception/InvalidCallbackException.php',
        'Dotenv\\Exception\\InvalidFileException' => __DIR__ . '/../..' . '/sdk/phpdotenv/Exception/InvalidFileException.php',
        'Dotenv\\Exception\\InvalidPathException' => __DIR__ . '/../..' . '/sdk/phpdotenv/Exception/InvalidPathException.php',
        'Dotenv\\Exception\\ValidationException' => __DIR__ . '/../..' . '/sdk/phpdotenv/Exception/ValidationException.php',
        'Dotenv\\Loader' => __DIR__ . '/../..' . '/sdk/phpdotenv/Loader.php',
        'Dotenv\\Validator' => __DIR__ . '/../..' . '/sdk/phpdotenv/Validator.php',
        'Lib\\App' => __DIR__ . '/../..' . '/libs/App.php',
        'Lib\\Config' => __DIR__ . '/../..' . '/libs/Config.php',
        'Lib\\Controller' => __DIR__ . '/../..' . '/libs/Controller.php',
        'Lib\\Db' => __DIR__ . '/../..' . '/libs/Db.php',
        'Lib\\Email' => __DIR__ . '/../..' . '/libs/Email.php',
        'Lib\\Fn' => __DIR__ . '/../..' . '/libs/Fn.php',
        'Lib\\Lang' => __DIR__ . '/../..' . '/libs/Lang.php',
        'Lib\\Login' => __DIR__ . '/../..' . '/libs/Login.php',
        'Lib\\Model' => __DIR__ . '/../..' . '/libs/Model.php',
        'Lib\\Router' => __DIR__ . '/../..' . '/libs/Router.php',
        'Lib\\Session' => __DIR__ . '/../..' . '/libs/Session.php',
        'Lib\\View' => __DIR__ . '/../..' . '/libs/View.php',
        'Model\\Account' => __DIR__ . '/../..' . '/mods/Account.php',
        'Model\\Auction' => __DIR__ . '/../..' . '/mods/Auction.php',
        'Model\\Cart' => __DIR__ . '/../..' . '/mods/Cart.php',
        'Model\\Checkout' => __DIR__ . '/../..' . '/mods/Checkout.php',
        'Model\\Customer' => __DIR__ . '/../..' . '/mods/Customer.php',
        'Model\\Products' => __DIR__ . '/../..' . '/mods/Products.php',
        'Model\\Start' => __DIR__ . '/../..' . '/mods/Start.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9641e2058b82a19e46fa47dd2c5b5d7f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9641e2058b82a19e46fa47dd2c5b5d7f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9641e2058b82a19e46fa47dd2c5b5d7f::$classMap;

        }, null, ClassLoader::class);
    }
}
