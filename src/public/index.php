<?php
// print_r(apache_get_modules());
// echo "<pre>"; print_r($_SERVER); die;
// $_SERVER["REQUEST_URI"] = str_replace("/phalt/","/",$_SERVER["REQUEST_URI"]);
// $_GET["_url"] = "/";
use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Url;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Config;
use Phalcon\Config\ConfigFactory;
use Phalcon\Escaper;
use Phalcon\Logger;
use Phalcon\Logger\Adapter\Stream;


$config = new Config([]);

// Define some absolute path constants to aid in locating resources
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

// Register an autoloader
$loader = new Loader();

$loader->registerDirs(
    [
        APP_PATH . "/controllers/",
        APP_PATH . "/models/",
    ]
);


$loader->registerNamespaces(
    [
        'App\Component' => APP_PATH . "/component/",
    ]
);

$loader->register();

$container = new FactoryDefault();

$container->set(
    'view',
    function () {
        $view = new View();
        $view->setViewsDir(APP_PATH . '/views/');
        return $view;
    }
);

$container->set(
    'url',
    function () {
        $url = new Url();
        $url->setBaseUri('/');
        return $url;
    }
);

$application = new Application($container);



$container->set(
    'db',
    function () {
        return new Mysql(
            [
                'host'     => $this['config']['db']['host'],
                'username' => $this['config']['db']['username'],
                'password' => $this['config']['db']['password'],
                'dbname'   => $this['config']['db']['dbname'],
            ]
        );
    }
);

$container->set(
    'config',
    function () {
            
        $fileName = '../app/etc/config.php';
        $factory  = new ConfigFactory();

        return $factory->newInstance('php', $fileName);
    },
    true
);

$container->set(
    'escaper',
    function () {
        return new Escaper();
    }
);


$container->set(
    'logger',
    function () {
        $signup = new Stream('../app/logs/signup.log');
        $login = new Stream('../app/logs/login.log');
        $logger  = new Logger(
            'messages',
            [
                'login' => $login,
                'signup' => $signup,
            ]
        );

        return $logger;
    }
);

$logger = $container->getShared('logger');

$container->set(
    'mongo',
    function () {
        $mongo = new MongoClient();

        return $mongo->selectDB($this['config']['db']['dbname']);
    },
    true
);




try {
    // Handle the request
    $response = $application->handle(
        $_SERVER["REQUEST_URI"]
    );

    $response->send();
} catch (\Exception $e) {
    echo 'Exception: ', $e->getMessage();
}
