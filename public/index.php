<?php
// autoloader
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/utility/helperFunctions.php';

// load all our Silex / Twig setup etc.
require_once __DIR__ . '/../app/config.php';

//-------------------------------------------
// map routes to controller class/method
//-------------------------------------------
$app->get('/',      controller('Hdip\Controller', 'main/index'));
$app->get('/about',      controller('Hdip\Controller', 'main/about'));

// ------ SECURE PAGES ----------
$app->get('/admin',  controller('Hdip\Controller', 'admin/index'));
$app->get('/adminProfile',  controller('Hdip\Controller', 'admin/profile'));
$app->get('/adminClasses',  controller('Hdip\Controller', 'admin/classes'));
$app->get('/adminStudents',  controller('Hdip\Controller', 'admin/students'));
$app->get('/showNewStudentForm',  controller('Hdip\Controller', 'admin/showNewStudentForm'));

// ------ login routes GET ------------
$app->get('/login',  controller('Hdip\Controller', 'user/login'));
$app->get('/logout',  controller('Hdip\Controller', 'user/logout'));

// ------ POST routes     ------------
$app->post('/login',  controller('Hdip\Controller', 'user/processLogin'));
$app->post('/adminAddStudent',  controller('Hdip\Controller', 'admin/processAddStudent'));
//$app->post('/update',  controller('Hdip\Controller', 'admin/processUpdate'));

$app->run();