<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Inicio;
use App\Controllers\administracion\sexo;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [Inicio::class, 'index']);
$routes->post('/ingresar', [Inicio::class, 'inicio']);

/***** MODULO DE ADMINISTRACION *****/
$routes->group('/admin/sexo', static function ($routes) {
    $routes->get('/', [Sexo::class, 'inicio']);
    $routes->get('new', [Sexo::class, 'nuevo']);
    $routes->post('save', [Sexo::class, 'guardar']);
    $routes->get('edit/(:num)', [Sexo::class, 'editar']);
    $routes->get('delete/(:num)', [Sexo::class, 'eliminar']);
});
