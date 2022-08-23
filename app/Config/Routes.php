<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
// $routes->set404Override();
$routes->set404Override(function () {
    return view("404");
});
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

//custom route for login
$routes->get('signin', 'CLogin::index');
$routes->post('login', 'CLogin::loginAuth');
//custom route for logout
$routes->get('signout', 'CLogin::logout');

//custom route for dashboard
$routes->get('dashboard', 'CDashboard::index');
$routes->get('worker', 'CWorker::index');
$routes->get('supervisor', 'CSupervisor::index');
$routes->get('manager', 'CManager::index');
$routes->get('admin', 'CAdmin::index');

$routes->get('store', 'CStore::index');
$routes->get('store/saveStore', 'CStore::saveStore');
$routes->post('store/saveStore', 'CStore::saveStore');
$routes->get('store/updateStore/(:num)', 'CStore::updateStore/$1');
$routes->post('store/updateStore/(:num)', 'CStore::updateStore/$1');
$routes->get('store/deleteStore/(:num)', 'CStore::deleteStore/$1');
$routes->post('store/deleteStore/(:num)', 'CStore::deleteStore/$1');

$routes->get('employee', 'CWorker::employee');
$routes->get('employee/saveEmployee', 'CWorker::saveEmployee');
$routes->post('employee/saveEmployee', 'CWorker::saveEmployee');
$routes->get('employee/updateEmployee/(:num)', 'CWorker::updateEmployee/$1');
$routes->post('employee/updateEmployee/(:num)', 'CWorker::updateEmployee/$1');
$routes->get('employee/deleteEmployee/(:num)', 'CWorker::deleteEmployee/$1');
$routes->post('employee/deleteEmployee/(:num)', 'CWorker::deleteEmployee/$1');

//get data employee from selectbox
$routes->get('employee/getDataSuperiorName2', 'CWorker::getDataSuperiorName2');
$routes->post('employee/getDataSuperiorName2', 'CWorker::getDataSuperiorName2');


$routes->get('schedule', 'CSchedule::index');
$routes->get('schedule/add', 'CSchedule::add');
$routes->post('schedule/add', 'CSchedule::add');

$routes->get('techshift', 'CSchedule::techshift');
$routes->get('techjobout', 'CSchedule::techjobout');
$routes->get('techjobin', 'CSchedule::techjobin');

$routes->get('troubleshift', 'CSchedule::troubleshift');
$routes->get('troublejobout', 'CSchedule::troublejobout');
$routes->get('troublejobin', 'CSchedule::troublejobin');







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
