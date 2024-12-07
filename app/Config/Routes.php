<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->get('/register', 'UserController::formPage');
$routes->post('/register/create', 'UserController::create');
$routes->get('/login', 'UserController::logPage');
$routes->post('/createLog', 'UserController::createLog');
$routes->get('/welcome', 'UserController::welcome');
$routes->get('/logout', 'UserController::logout');


