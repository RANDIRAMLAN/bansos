<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'JGK::masuk');
$routes->get('/JGK/daftar', 'JGK::daftar');
$routes->get('/JGK/verifikasi', 'JGK::verifikasi');
$routes->get('/JGK/lupa_sandi', 'JGK::lupa_sandi');
$routes->get('/JGK/buat_sandi_baru', 'JGK::buat_sandi_baru');
$routes->get('/user/index', 'User::index');
$routes->get('/user/buat_data_keluarga', 'User::buat_data_keluarga');
$routes->get('/user/ubah_data_keluarga', 'User::ubah_data_keluarga');
$routes->get('/user/ubah_data_anggota_keluarga', 'User::ubah_data_anggota_keluarga');
$routes->delete('/user/hapus_data_anggota_keluarga/$1', 'User::hapus_data_anggota_keluarga/$1');
$routes->get('/admin/bansosku', 'Admin::bansosku');
$routes->get('/admin/dashboard', 'Admin::dashboard');
$routes->get('/admin/persetujuan', 'Admin::persetujuan');
$routes->get('/admin/data', 'Admin::data');
$routes->get('/admin/anggota_keluarga', 'Admin::anggota_keluarga');
$routes->get('/admin/bansos', 'Admin::bansos');
$routes->get('/admin/data_bansos', 'Admin::data_bansos');
$routes->get('/admin/penerima_bansos', 'Admin::penerima_bansos');
$routes->delete('/admin/hapus_banyak', 'admin::hapus_banyak');
$routes->get('/admin/import', 'Admin::import');
$routes->get('/admin/tambah_data', 'Admin::tambah_data');


/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
