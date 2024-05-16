<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Clientes::index');
$routes->post('/list', 'Clientes::list');
$routes->post('/delete', 'Clientes::delete');
$routes->post('/store', 'Clientes::store');
$routes->post('/edit', 'Clientes::edit');
$routes->post('/upload', 'Clientes::upload');
