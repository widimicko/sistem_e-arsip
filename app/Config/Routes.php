<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/archive', 'Home::index');
$routes->get('/category', 'Home::category');

// =============== Archives ===================
$routes->get('/archive/add', 'Archive::add');
$routes->post('/archive/create', 'Archive::create');
$routes->get('/archive/edit/(:num)', 'Archive::edit/$1');
$routes->post('/archive/update/(:num)', 'Archive::update/$1');
$routes->get('/archive/delete/(:num)', 'Archive::delete/$1');
$routes->get('/archive/detail/(:num)', 'Archive::detail/$1');
$routes->get('/archive/download/(:num)', 'Archive::download/$1');

// =============== Categorys ===================
$routes->post('/category/create', 'Category::create');
$routes->post('/category/update/(:num)', 'Category::update/$1');
$routes->get('/category/delete/(:num)', 'Category::delete/$1');
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
