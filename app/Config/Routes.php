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
$routes->get('/change-password', 'DashboardController::change_password');
$routes->get('/category/(:num)', 'DashboardController::category/$1');
$routes->get('/user-list', 'UserController::index');
$routes->post('/create-user', 'UserController::store_user_data');
