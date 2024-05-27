<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/clear-cache', function(){
    echo command('cache:clear');
 });

$routes->get('/', 'LoginController::index');
$routes->post('/login', 'LoginController::login');
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/logout', 'DashboardController::logout');
$routes->get('/forgot-password', 'LoginController::forgot_password');

$routes->get('/dashboard', 'DashboardController::index');
