<?php

$myTemplatesPath = __DIR__ . '/../templates';

// setup Twig
$loader = new Twig_Loader_Filesystem($myTemplatesPath);
$twig = new Twig_Environment($loader);

// setup Silex
$app = new Silex\Application();

// register Session provider with Silex
$app->register(new Silex\Provider\SessionServiceProvider());

// register Twig with Silex
$app->register(new Silex\Provider\TwigServiceProvider(), array(
'twig.path' => $myTemplatesPath
));

// the DatabaseManager class needs the following 4 constants to be defined in order to create the DB connection
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'webassignment');