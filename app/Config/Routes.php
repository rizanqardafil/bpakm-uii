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
$routes->setDefaultController('BerandaController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'BerandaController::index');
$routes->get('/beranda', 'BerandaController::index');
$routes->get('/produk', 'ProdukController::index');
$routes->get('/produk/detail/(:any)', 'ProdukController::detail/$1');
$routes->get('/investor', 'InvestorController::index');
$routes->post('/investor/download', 'InvestorController::download');
$routes->get('/galeri', 'GaleriController::index');
$routes->get('/galeri/foto', 'GaleriController::foto');
$routes->get('/galeri/video', 'GaleriController::video');
$routes->get('/artikel', 'ArtikelController::index');
$routes->get('/artikel/detail/(:any)', 'ArtikelController::detail/$1');
$routes->get('/tentang', 'TentangController::index');

// Routes Auth
$routes->get('/admin/login', 'Admin\Auth::index');
$routes->post('/admin/auth', 'Admin\Auth::auth');
$routes->get('/admin/logout', 'Admin\Auth::logout', ['filter' => 'auth']);
$routes->get('/admin/dashboard', 'Admin\Auth::dashboard', ['filter' => 'auth']);

// Routes CRUD Config
$routes->get('/admin/config', 'Admin\Config::index', ['filter' => 'auth']);
$routes->post('/admin/config/save-config', 'Admin\Config::save_config', ['filter' => 'auth']);
$routes->get('/admin/logo-config', 'Admin\Config::logo_config', ['filter' => 'auth']);
$routes->post('/admin/logo-config/save-logo', 'Admin\Config::save_logo', ['filter' => 'auth']);
$routes->get('/admin/icon-config', 'Admin\Config::icon_config', ['filter' => 'auth']);
$routes->post('/admin/icon-config/save-icon', 'Admin\Config::save_icon', ['filter' => 'auth']);

// Routes CRUD Admin
$routes->get('/admin/users', 'Admin\Users::index', ['filter' => 'auth']);
$routes->get('/admin/users/tambah', 'Admin\Users::tambah', ['filter' => 'auth']);
$routes->get('/admin/users/(:segment)', 'Admin\Users::edit/$1', ['filter' => 'auth']);
$routes->post('/admin/users/save', 'Admin\Auth::save', ['filter' => 'auth']);
$routes->post('/admin/users/update/(:segment)', 'Admin\Auth::update/$1', ['filter' => 'auth']);
$routes->post('/admin/users/delete', 'Admin\Auth::delete', ['filter' => 'auth']);

// Admin Produk Kami Routes
$routes->get('/admin/produk', 'Admin\Produk_Kami\Produk::index', ['filter' => 'auth']);
$routes->get('/admin/produk/tambah', 'Admin\Produk_Kami\Produk::tambah', ['filter' => 'auth']);
$routes->post('/admin/produk/save', 'Admin\Produk_Kami\Produk::save', ['filter' => 'auth']);
$routes->post('/admin/produk/update', 'Admin\Produk_Kami\Produk::update', ['filter' => 'auth']);
$routes->delete('/admin/produk/delete/(:num)', 'Admin\Produk_Kami\Produk::delete/$1', ['filter' => 'auth']);
$routes->get('/admin/produk/edit/(:any)', 'Admin\Produk_Kami\Produk::edit/$1', ['filter' => 'auth']);

$routes->get('/admin/gambar', 'Admin\Produk_Kami\Gambar::index', ['filter' => 'auth']);
$routes->get('/admin/gambar/tambah', 'Admin\Produk_Kami\Gambar::tambah', ['filter' => 'auth']);
$routes->get('/admin/gambar/edit/(:any)', 'Admin\Produk_Kami\Gambar::edit/$1', ['filter' => 'auth']);
$routes->post('/admin/gambar/update', 'Admin\Produk_Kami\Gambar::update', ['filter' => 'auth']);
$routes->delete('/admin/gambar/delete/(:num)', 'Admin\Produk_Kami\Gambar::delete/$1', ['filter' => 'auth']);
$routes->post('/admin/gambar/save', 'Admin\Produk_Kami\Gambar::save', ['filter' => 'auth']);

$routes->get('/admin/paket', 'Admin\Produk_Kami\Paket::index', ['filter' => 'auth']);
$routes->get('/admin/paket/tambah', 'Admin\Produk_Kami\Paket::tambah', ['filter' => 'auth']);
$routes->post('/admin/paket/save', 'Admin\Produk_Kami\Paket::save', ['filter' => 'auth']);
$routes->post('/admin/paket/update', 'Admin\Produk_Kami\Paket::update', ['filter' => 'auth']);
$routes->delete('/admin/paket/delete/(:num)', 'Admin\Produk_Kami\Paket::delete/$1', ['filter' => 'auth']);
$routes->get('/admin/paket/edit/(:any)', 'Admin\Produk_Kami\Paket::edit/$1', ['filter' => 'auth']);

$routes->get('/admin/pesanan', 'Admin\Produk_Kami\Pesanan::index', ['filter' => 'auth']);
$routes->get('/admin/pesanan/tambah', 'Admin\Produk_Kami\Pesanan::tambah', ['filter' => 'auth']);
$routes->post('/admin/pesanan/save', 'Admin\Produk_Kami\Pesanan::save', ['filter' => 'auth']);
$routes->post('/admin/pesanan/update', 'Admin\Produk_Kami\Pesanan::update', ['filter' => 'auth']);
$routes->delete('/admin/pesanan/delete/(:num)', 'Admin\Produk_Kami\Pesanan::delete/$1', ['filter' => 'auth']);
$routes->get('/admin/pesanan/edit/(:num)', 'Admin\Produk_Kami\Pesanan::edit/$1', ['filter' => 'auth']);


// Admin Investor routes
$routes->get('/admin/organisasi', 'Admin\Investor\Organisasi::index', ['filter' => 'auth']);
$routes->post('/admin/organisasi/save', 'Admin\Investor\Organisasi::save', ['filter' => 'auth']);

$routes->get('/admin/laporan', 'Admin\Investor\Laporan::index', ['filter' => 'auth']);
$routes->get('/admin/laporan/tambah', 'Admin\Investor\Laporan::tambah', ['filter' => 'auth']);
$routes->post('/admin/laporan/save', 'Admin\Investor\Laporan::save', ['filter' => 'auth']);
$routes->post('/admin/laporan/update', 'Admin\Investor\Laporan::update', ['filter' => 'auth']);
$routes->delete('/admin/laporan/delete/(:num)', 'Admin\Investor\Laporan::delete/$1', ['filter' => 'auth']);
$routes->get('/admin/laporan/edit/(:any)', 'Admin\Investor\Laporan::edit/$1', ['filter' => 'auth']);

$routes->get('/admin/gambar_laporan', 'Admin\Investor\Gambar::index', ['filter' => 'auth']);
$routes->get('/admin/gambar_laporan/tambah', 'Admin\Investor\Gambar::tambah', ['filter' => 'auth']);
$routes->post('/admin/gambar_laporan/save', 'Admin\Investor\Gambar::save', ['filter' => 'auth']);
$routes->post('/admin/gambar_laporan/update', 'Admin\Investor\Gambar::update', ['filter' => 'auth']);
$routes->delete('/admin/gambar_laporan/delete/(:num)', 'Admin\Investor\Gambar::delete/$1', ['filter' => 'auth']);
$routes->get('/admin/gambar_laporan/edit/(:any)', 'Admin\Investor\Gambar::edit/$1', ['filter' => 'auth']);


// Admin Tentang kami
$routes->get('/admin/tentang-kami', 'Admin\Tentang\VisiMisi::index', ['filter' => 'auth']);
$routes->post('/admin/tentang-kami/save', 'Admin\Tentang\VisiMisi::save', ['filter' => 'auth']);

$routes->get('/admin/sejarah', 'Admin\Tentang\Sejarah::index', ['filter' => 'auth']);
$routes->post('/admin/sejarah/save', 'Admin\Tentang\Sejarah::save', ['filter' => 'auth']);

// Admin Galeri routes
$routes->get('/admin/foto', 'Admin\Galeri\Foto::index', ['filter' => 'auth']);
$routes->get('/admin/foto/tambah', 'Admin\Galeri\Foto::tambah', ['filter' => 'auth']);
$routes->post('/admin/foto/save', 'Admin\Galeri\Foto::save', ['filter' => 'auth']);
$routes->post('/admin/foto/update', 'Admin\Galeri\Foto::update', ['filter' => 'auth']);
$routes->delete('/admin/foto/delete/(:num)', 'Admin\Galeri\Foto::delete/$1', ['filter' => 'auth']);
$routes->get('/admin/foto/edit/(:any)', 'Admin\Galeri\Foto::edit/$1', ['filter' => 'auth']);

$routes->get('/admin/album', 'Admin\Galeri\Album::index', ['filter' => 'auth']);
$routes->get('/admin/album/tambah', 'Admin\Galeri\Album::tambah', ['filter' => 'auth']);
$routes->post('/admin/album/save', 'Admin\Galeri\Album::save', ['filter' => 'auth']);
$routes->post('/admin/album/update', 'Admin\Galeri\Album::update', ['filter' => 'auth']);
$routes->delete('/admin/album/delete/(:num)', 'Admin\Galeri\Album::delete/$1', ['filter' => 'auth']);
$routes->get('/admin/album/edit/(:any)', 'Admin\Galeri\Album::edit/$1', ['filter' => 'auth']);

$routes->get('/admin/video', 'Admin\Galeri\Video::index', ['filter' => 'auth']);
$routes->get('/admin/video/tambah', 'Admin\Galeri\Video::tambah', ['filter' => 'auth']);
$routes->post('/admin/video/save', 'Admin\Galeri\Video::save', ['filter' => 'auth']);
$routes->post('/admin/video/update', 'Admin\Galeri\Video::update', ['filter' => 'auth']);
$routes->delete('/admin/video/delete/(:num)', 'Admin\Galeri\Video::delete/$1', ['filter' => 'auth']);
$routes->get('/admin/video/edit/(:any)', 'Admin\Galeri\Video::edit/$1', ['filter' => 'auth']);

// Admin Artikel routes
$routes->get('/admin/artikel', 'Admin\Artikel\Artikel::index', ['filter' => 'auth']);
$routes->get('/admin/artikel/tambah', 'Admin\Artikel\Artikel::tambah', ['filter' => 'auth']);
$routes->post('/admin/artikel/save', 'Admin\Artikel\Artikel::save', ['filter' => 'auth']);
$routes->post('/admin/artikel/update', 'Admin\Artikel\Artikel::update', ['filter' => 'auth']);
$routes->delete('/admin/artikel/delete/(:num)', 'Admin\Artikel\Artikel::delete/$1', ['filter' => 'auth']);
$routes->get('/admin/artikel/edit/(:any)', 'Admin\Artikel\Artikel::edit/$1', ['filter' => 'auth']);

$routes->get('/admin/penulis', 'Admin\Artikel\Penulis::index', ['filter' => 'auth']);
$routes->get('/admin/penulis/tambah', 'Admin\Artikel\Penulis::tambah', ['filter' => 'auth']);
$routes->post('/admin/penulis/save', 'Admin\Artikel\Penulis::save', ['filter' => 'auth']);
$routes->post('/admin/penulis/update', 'Admin\Artikel\Penulis::update', ['filter' => 'auth']);
$routes->delete('/admin/penulis/delete/(:num)', 'Admin\Artikel\Penulis::delete/$1', ['filter' => 'auth']);
$routes->get('/admin/penulis/edit/(:any)', 'Admin\Artikel\Penulis::edit/$1', ['filter' => 'auth']);

// Admin Kegiatan kami
$routes->get('/admin/kegiatan-kami', 'Admin\Kegiatan_Kami\Kegiatan::index', ['filter' => 'auth']);
$routes->get('/admin/kegiatan-kami/tambah', 'Admin\Kegiatan_Kami\Kegiatan::tambah', ['filter' => 'auth']);
$routes->post('/admin/kegiatan-kami/save', 'Admin\Kegiatan_Kami\Kegiatan::save', ['filter' => 'auth']);
$routes->post('/admin/kegiatan-kami/update', 'Admin\Kegiatan_Kami\Kegiatan::update', ['filter' => 'auth']);
$routes->delete('/admin/kegiatan-kami/delete/(:num)', 'Admin\Kegiatan_Kami\Kegiatan::delete/$1', ['filter' => 'auth']);
$routes->get('/admin/kegiatan-kami/edit/(:any)', 'Admin\Kegiatan_Kami\Kegiatan::edit/$1', ['filter' => 'auth']);

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
