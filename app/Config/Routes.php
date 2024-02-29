<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Inicio;
use App\Controllers\administracion\sexo;
use App\Controllers\administracion\genero;
use App\Controllers\administracion\tipo;
use App\Controllers\administracion\rol;
use App\Controllers\administracion\persona;
use App\Controllers\administracion\correo;
use App\Controllers\administracion\telefono;
use App\Controllers\administracion\usuario;
use App\Controllers\administracion\menu;
use App\Controllers\academico\asignatura;
use App\Controllers\academico\periodo;
use App\Controllers\academico\carrera;
use App\Controllers\academico\facultad;
use App\Controllers\telemetria\accion;
use App\Controllers\telemetria\estacion;
use App\Controllers\telemetria\proceso;
use App\Controllers\telemetria\procesoEstacion;
use App\Controllers\telemetria\procesoEstacionAccion;
use App\Controllers\telemetria\procesoCalendario;

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
    $routes->get('option/(:num)', [Rol::class, 'menu']);
    $routes->get('option/asign/(:num)/(:num)', [Rol::class, 'asignar']);
    $routes->get('option/delete/(:num)/(:num)', [Rol::class, 'quitar']);
    
});

$routes->group('/admin/menu', static function ($routes) {
    $routes->get('/', [Menu::class, 'inicio']);
    $routes->get('new/', [Menu::class, 'nuevo']);
    $routes->post('save/', [Menu::class, 'guardar']);
    $routes->get('edit/(:num)', [Menu::class, 'editar']);
    $routes->post('update/', [Menu::class, 'actualizar']);
    $routes->get('delete/(:num)', [Menu::class, 'eliminar']);
});

$routes->group('/admin/persona', static function ($routes) {
    $routes->get('/', [Persona::class, 'inicio']);
    $routes->get('new/', [Persona::class, 'nuevo']);
    $routes->post('save/', [Persona::class, 'guardar']);
    $routes->get('edit/(:num)', [Persona::class, 'editar']);
    $routes->post('update/', [Persona::class, 'actualizar']);
    $routes->get('delete/(:num)', [Persona::class, 'eliminar']);
    $routes->get('mail/(:num)', [Correo::class, 'inicio']);
    $routes->get('mail/new/(:num)', [Correo::class, 'nuevo']);
    $routes->post('mail/save', [Correo::class, 'guardar']);
    $routes->get('mail/edit/(:num)', [Correo::class, 'editar']);
    $routes->post('mail/update', [Correo::class, 'actualizar']);
    $routes->get('mail/delete/(:num)', [Correo::class, 'eliminar']);
    $routes->get('telefono/(:num)', [Telefono::class, 'inicio']);
    $routes->get('telefono/new/(:num)', [Telefono::class, 'nuevo']);
    $routes->post('telefono/save', [Telefono::class, 'guardar']);
    $routes->get('telefono/edit/(:num)', [Telefono::class, 'editar']);
    $routes->post('telefono/update', [Telefono::class, 'actualizar']);
    $routes->get('telefono/delete/(:num)', [Telefono::class, 'eliminar']);
    $routes->get('usuario/(:num)', [Usuario::class, 'inicio']);
    $routes->post('usuario/save', [Usuario::class, 'guardar']);
    $routes->post('usuario/update', [Usuario::class, 'actualizar']);
    $routes->get('usuario/delete_rol/(:num)', [Usuario::class, 'eliminarRol']);
    $routes->get('usuario/resetear/(:num)', [Usuario::class, 'resetea']);
});


$routes->group('/academico/asignatura', static function ($routes) {
    $routes->get('/', [Asignatura::class, 'inicio']);
    $routes->get('new/', [Asignatura::class, 'nuevo']);
    $routes->post('save/', [Asignatura::class, 'guardar']);
    $routes->get('edit/(:num)', [Asignatura::class, 'editar']);
    $routes->post('update/', [Asignatura::class, 'actualizar']);
    $routes->get('delete/(:num)', [Asignatura::class, 'eliminar']);
});

/***** MODULO ACADEMICO *****/
$routes->group('/academico/periodo', static function ($routes) {
    $routes->get('/', [Periodo::class, 'inicio']);
    $routes->get('new/', [Periodo::class, 'nuevo']);
    $routes->post('save/', [Periodo::class, 'guardar']);
    $routes->get('edit/(:num)', [Periodo::class, 'editar']);
    $routes->post('update/', [Periodo::class, 'actualizar']);
    $routes->get('delete/(:num)', [Periodo::class, 'eliminar']);
});

$routes->group('/academico/carrera', static function ($routes) {
    $routes->get('/', [Carrera::class, 'inicio']);
    $routes->get('new/', [Carrera::class, 'nuevo']);
    $routes->post('save/', [Carrera::class, 'guardar']);
    $routes->get('edit/(:num)', [Carrera::class, 'editar']);
    $routes->post('update/', [Carrera::class, 'actualizar']);
    $routes->get('delete/(:num)', [Carrera::class, 'eliminar']);
});

$routes->group('/academico/facultad', static function ($routes) {
    $routes->get('/', [Facultad::class, 'inicio']);
    $routes->get('new/', [Facultad::class, 'nuevo']);
    $routes->post('save/', [Facultad::class, 'guardar']);
    $routes->get('edit/(:num)', [Facultad::class, 'editar']);
    $routes->post('update/', [Facultad::class, 'actualizar']);
    $routes->get('delete/(:num)', [Facultad::class, 'eliminar']);
});

$routes->group('/academico/calendario', static function ($routes) {
    $routes->get('/', [ProcesoCalendario::class, 'inicio']);
    $routes->get('event/', [ProcesoCalendario::class, 'eventos']);
    $routes->get('new/', [ProcesoCalendario::class, 'nuevo']);
    $routes->post('save/', [ProcesoCalendario::class, 'guardar']);
    $routes->get('edit/(:num)', [ProcesoCalendario::class, 'editar']);
    $routes->post('update/', [ProcesoCalendario::class, 'actualizar']);
    $routes->get('delete/(:num)', [ProcesoCalendario::class, 'eliminar']);
    $routes->post('change_date/', [ProcesoCalendario::class, 'guardar']);
});

/***** MODULO DE TELEMETRIA *****/
$routes->group('/telemetria/accion', static function ($routes) {
    $routes->get('/', [Accion::class, 'inicio']);
    $routes->get('new/', [Accion::class, 'nuevo']);
    $routes->post('save/', [Accion::class, 'guardar']);
    $routes->get('edit/(:num)', [Accion::class, 'editar']);
    $routes->post('update/', [Accion::class, 'actualizar']);
    $routes->get('delete/(:num)', [Accion::class, 'eliminar']);
});

$routes->group('/telemetria/estacion', static function ($routes) {
    $routes->get('/', [Estacion::class, 'inicio']);
    $routes->get('new/', [Estacion::class, 'nuevo']);
    $routes->post('save/', [Estacion::class, 'guardar']);
    $routes->get('edit/(:num)', [Estacion::class, 'editar']);
    $routes->post('update/', [Estacion::class, 'actualizar']);
    $routes->get('delete/(:num)', [Estacion::class, 'eliminar']);
});

$routes->group('/telemetria/proceso', static function ($routes) {
    $routes->get('/', [Proceso::class, 'inicio']);
    $routes->get('new/', [Proceso::class, 'nuevo']);
    $routes->post('save/', [Proceso::class, 'guardar']);
    $routes->get('edit/(:num)', [Proceso::class, 'editar']);
    $routes->post('update/', [Proceso::class, 'actualizar']);
    $routes->get('delete/(:num)', [Proceso::class, 'eliminar']);
    $routes->get('estacion/(:num)', [ProcesoEstacion::class, 'inicio']);
    $routes->get('estacion/new/(:num)', [ProcesoEstacion::class, 'nuevo']);
    $routes->post('estacion/save/', [ProcesoEstacion::class, 'guardar']);
    $routes->get('estacion/edit/(:num)', [ProcesoEstacion::class, 'editar']);
    $routes->post('estacion/update/', [ProcesoEstacion::class, 'actualizar']);
    $routes->get('estacion/delete/(:num)', [ProcesoEstacion::class, 'eliminar']);
    $routes->get('estacion/accion/(:num)', [ProcesoEstacionAccion::class, 'inicio']);   
    $routes->post('estacion/accion/save/', [ProcesoEstacionAccion::class, 'guardar']);
    $routes->get('estacion/accion/delete/(:num)', [ProcesoEstacionAccion::class, 'eliminar']);    
    
});



