<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::login');
$routes->get('auth/login', 'AuthController::login');
$routes->get('auth/callback', 'AuthController::callback');
$routes->get('logout', 'AuthController::logout');

$routes->get('dashboard', 'DashboardController::index', ['filter' => 'auth']);

// Aliases to support provided redirect URI
$routes->get('girione', 'AuthController::login');
$routes->get('girione/callback', 'AuthController::callback');

// Toleransi jika server menyisipkan index.php pada URL
$routes->get('index.php', 'AuthController::login');
$routes->get('index.php/callback', 'AuthController::callback');
$routes->get('index.php/dashboard', 'DashboardController::index', ['filter' => 'auth']);
