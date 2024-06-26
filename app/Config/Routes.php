<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Users::dashboard');
$routes->get('users/dashboard', 'Users::dashboard');
$routes->get('users/index', 'Users::index', ['filter' => 'role:administrator']);
$routes->get('users/add', 'Users::add', ['filter' => 'role:administrator']);
$routes->get('users/changePassword/(:segment)', 'Users::changePassword/$1', ['filter' => 'role:administrator']);

$routes->post('users/getUsers', 'Users::getUsers', ['filter' => 'role:administrator']);
$routes->post('users/save', 'Users::save', ['filter' => 'role:administrator']);
$routes->post('users/changeGroup', 'Users::changeGroup', ['filter' => 'role:administrator']);
$routes->post('users/activate', 'Users::activate', ['filter' => 'role:administrator']);

$routes->get('countries/index', 'Countries::index', ['filter' => 'role:administrator']);
$routes->post('countries/getCountries', 'Countries::getCountries', ['filter' => 'role:administrator']);

$routes->get('states/index', 'States::index', ['filter' => 'role:administrator']);
$routes->post('states/getStates', 'States::getStates', ['filter' => 'role:administrator']);

$routes->get('cities/index', 'Cities::index', ['filter' => 'role:administrator']);
$routes->post('cities/getCities', 'Cities::getCities', ['filter' => 'role:administrator']);
