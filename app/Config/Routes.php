<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Inicio;
use App\Controllers\administracion\sexo;
use App\Controllers\administracion\genero;
use App\Controllers\administracion\tipo;
use App\Controllers\administracion\rol;
use App\Controllers\administracion\persona;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [Inicio::class, 'index']);
$routes->post('/ingresar', [Inicio::class, 'inicio']);

/***** MODULO DE ADMINISTRACION *****/
$routes->group('/admin/sexo', static function ($routes) {
    $routes->get('/', [Sexo::class, 'inicio']);
    $routes->get('new/', [Sexo::class, 'nuevo']);
    $routes->post('save/', [Sexo::class, 'guardar']);
    $routes->get('edit/(:num)', [Sexo::class, 'editar']);
    $routes->post('update/', [Sexo::class, 'actualizar']);
    $routes->get('delete/(:num)', [Sexo::class, 'eliminar']);
});

$routes->group('/admin/genero', static function ($routes) {
    $routes->get('/', [Genero::class, 'inicio']);
    $routes->get('new/', [Genero::class, 'nuevo']);
    $routes->post('save/', [Genero::class, 'guardar']);
    $routes->get('edit/(:num)', [Genero::class, 'editar']);
    $routes->post('update/', [Genero::class, 'actualizar']);
    $routes->get('delete/(:num)', [Genero::class, 'eliminar']);
});

$routes->group('/admin/tipo', static function ($routes) {
    $routes->get('/', [Tipo::class, 'inicio']);
    $routes->get('new/', [Tipo::class, 'nuevo']);
    $routes->post('save/', [Tipo::class, 'guardar']);
    $routes->get('edit/(:num)', [Tipo::class, 'editar']);
    $routes->post('update/', [Tipo::class, 'actualizar']);
    $routes->get('delete/(:num)', [Tipo::class, 'eliminar']);
});

$routes->group('/admin/rol', static function ($routes) {
    $routes->get('/', [Rol::class, 'inicio']);
    $routes->get('new/', [Rol::class, 'nuevo']);
    $routes->post('save/', [Rol::class, 'guardar']);
    $routes->get('edit/(:num)', [Rol::class, 'editar']);
    $routes->post('update/', [Rol::class, 'actualizar']);
    $routes->get('delete/(:num)', [Rol::class, 'eliminar']);
});

$routes->group('/admin/persona', static function ($routes) {
    $routes->get('/', [Persona::class, 'inicio']);
    $routes->get('new/', [Persona::class, 'nuevo']);
    $routes->post('save/', [Persona::class, 'guardar']);
    $routes->get('edit/(:num)', [Persona::class, 'editar']);
    $routes->post('update/', [Persona::class, 'actualizar']);
    $routes->get('delete/(:num)', [Persona::class, 'eliminar']);
});