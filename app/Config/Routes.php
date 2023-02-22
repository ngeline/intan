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
$routes->get('/dashboard', 'Dashboard::index', ['as' => 'dashboard', 'filter' => 'role:wali santri, admin']);

// Santri
$routes->group('santri', static function($routes){
    $routes->get('', 'Santri::index', ['filter' => 'role:admin', 'as' => 'santri']);
    $routes->get('tambah', 'Santri::create', ['filter' => 'role:admin', 'as' => 'create.santri']);
    $routes->post('tambah-santri', 'Santri::store', ['filter' => 'role:admin', 'as' => 'store.santri']);
    $routes->get('(:num)', 'Santri::edit/$1', ['filter' => 'role:admin', 'as' => 'edit.santri']);
    $routes->post('update/(:num)', 'Santri::update/$1', ['filter' => 'role:admin', 'as' => 'update.santri']);
    $routes->delete('(:num)', 'Santri::delete/$1', ['filter' => 'role:admin', 'as' => 'delete.santri']);
});

// Wali Santri
$routes->group('wali-santri', static function($routes){
    $routes->get('', 'WaliSantri::index', ['filter' => 'role:admin', 'as' => 'walisantri']);
    $routes->get('tambah-walisantri', 'WaliSantri::create', ['filter' => 'role:admin', 'as' => 'create.walisantri']);
    $routes->post('tambah', 'WaliSantri::store', ['filter' => 'role:admin', 'as' => 'store.walisantri']);
    $routes->get('(:num)', 'WaliSantri::edit/$1', ['filter' => 'role:admin', 'as' => 'edit.walisantri']);
    $routes->post('update/(:num)', 'WaliSantri::update/$1', ['filter' => 'role:admin', 'as' => 'update.walisantri']);
    $routes->delete('(:num)', 'WaliSantri::delete/$1', ['filter' => 'role:admin', 'as' => 'delete.walisantri']);
});

// Kelas
$routes->group('kelas', static function($routes){
    $routes->get('', 'Kelas::index', ['filter' => 'role:admin', 'as' => 'kelas']);
    $routes->get('tambah-kelas', 'Kelas::create', ['filter' => 'role:admin', 'as' => 'create.kelas']);
    $routes->post('tambah-kelas', 'Kelas::store', ['filter' => 'role:admin', 'as' => 'store.kelas']);
    $routes->get('(:num)', 'Kelas::edit/$1', ['filter' => 'role:admin', 'as' => 'edit.kelas']);
    $routes->post('update/(:num)', 'Kelas::update/$1', ['filter' => 'role:admin', 'as' => 'update.kelas']);
    $routes->delete('(:num)', 'kelas::delete/$1', ['filter' => 'role:admin', 'as' => 'delete.kelas']);
});

// SPP
$routes->group('sumbangan-pembinaan-pendidikan', static function($routes){
    $routes->get('', 'SPP::index', ['filter' => 'role:admin,wali santri', 'as' => 'spp']);
    $routes->get('tambah-spp', 'SPP::create', ['filter' => 'role:admin,wali santri', 'as' => 'create.spp']);
    $routes->post('tambah-spp', 'SPP::store', ['filter' => 'role:admin,wali santri', 'as' => 'store.spp']);
    $routes->get('(:num)', 'SPP::edit/$1', ['filter' => 'role:admin,wali santri', 'as' => 'edit.spp']);
    $routes->post('update/(:num)', 'SPP::update/$1', ['filter' => 'role:admin,wali santri', 'as' => 'update.spp']);
    $routes->delete('(:num)', 'SPP::delete/$1', ['filter' => 'role:admin,wali santri', 'as' => 'delete.spp']);

    //search
    $routes->post('', 'SPP::search', ['filter' => 'role:admin,wali santri', 'as' => 'spp.search']);
    $routes->get('konfirmasi/(:num)', 'SPP::konfirmasi/$1', ['filter' => 'role:admin,wali santri', 'as' => 'konfirmasi.spp']);
});

// User
$routes->group('user', static function($routes){
    $routes->get('/', 'User::index', ['filter' => 'role:admin', 'as' => 'user']);
    $routes->get('aktivasi/(:num)', 'User::aktivasi/$1', ['filter' => 'role:admin', 'as' => 'user.aktivasi']);
    $routes->get('blokir/(:num)', 'User::blokir/$1', ['filter' => 'role:admin', 'as' => 'user.blokir']);
});

// Laporan
$routes->group('laporan', static function($routes){
    $routes->get('/', 'Report::index', ['filter' => 'role:admin', 'as' => 'laporan']);
    $routes->post('report-data-kelas', 'Report::reportKelas', ['filter' => 'role:admin', 'as' => 'laporanKelas']);
    $routes->post('report-data-spp', 'Report::reportSPP', ['filter' => 'role:admin', 'as' => 'laporanSPP']);
});

// Profile
$routes->group('profile', static function($routes){
    $routes->get('(:num)', 'Profile::index/$1', ['filter' => 'role:admin, wali santri', 'as' => 'profile']);
    $routes->post('(:num)', 'Profile::update/$1', ['filter' => 'role:admin, wali santri', 'as' => 'update.profile']);
    $routes->post('update-insert/(:num)', 'Profile::updateInsert/$1', ['filter' => 'role:wali santri', 'as' => 'updateInsert.profile']);
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
