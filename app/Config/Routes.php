<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', static function(){
    return redirect()->route('dashboard');
});

// Dashboard
$routes->get('/dashboard', 'Dashboard::index', ['as' => 'dashboard']);

// Santri
$routes->group('santri', static function($routes){
    $routes->get('', 'Santri::index');
    $routes->get('tambah', 'Santri::create');
    $routes->post('tambah', 'Santri::store');
    $routes->get('(:num)', 'Santri::edit/$1');
    $routes->get('update/(:num)', 'Santri::update/$1');
    $routes->delete('(:num)', 'Santri::delete/$1');
});

// Wali Santri
$routes->group('wali-santri', static function($routes){
    $routes->get('', 'WaliSantri::index');
    $routes->get('tambah', 'WaliSantri::create');
    $routes->post('tambah', 'WaliSantri::store');
    $routes->get('(:num)', 'WaliSantri::edit/$1');
    $routes->get('update/(:num)', 'WaliSantri::update/$1');
    $routes->delete('(:num)', 'WaliSantri::delete/$1');
});

// Kelas
$routes->group('kelas', static function($routes){
    $routes->get('', 'Kelas::index');
    $routes->get('tambah-kelas', 'Kelas::create');
    $routes->post('tambah-kelas', 'Kelas::store');
    $routes->get('(:num)', 'Kelas::edit/$1');
    $routes->post('update/(:num)', 'Kelas::update/$1');
    $routes->delete('(:num)', 'kelas::delete/$1');
});

// SPP
$routes->group('sumbangan-pembinaan-pendidikan', static function($routes){
    $routes->get('', 'SPP::index');
});

// User
$routes->group('user', static function($routes){
    $routes->get('/', 'User::index');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
