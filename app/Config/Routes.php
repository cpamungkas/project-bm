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

//Master page
$routes->get('level', 'CMaster::indexLevel');
$routes->get('level/saveLevel', 'CMaster::saveLevel');
$routes->post('level/saveLevel', 'CMaster::saveLevel');
$routes->get('level/updateLevel/(:num)', 'CMaster::updateLevel/$1');
$routes->post('level/updateLevel/(:num)', 'CMaster::updateLevel/$1');
$routes->get('level/deleteLevel/(:num)', 'CMaster::deleteLevel/$1');
$routes->post('level/deleteLevel/(:num)', 'CMaster::deleteLevel/$1');

$routes->get('role', 'CMaster::indexRole');
$routes->get('superior', 'CMaster::indexSuperior');

//Store
$routes->get('store', 'CStore::index');
$routes->get('store/saveStore', 'CStore::saveStore');
$routes->post('store/saveStore', 'CStore::saveStore');
$routes->get('store/updateStore/(:num)', 'CStore::updateStore/$1');
$routes->post('store/updateStore/(:num)', 'CStore::updateStore/$1');
$routes->get('store/deleteStore/(:num)', 'CStore::deleteStore/$1');
$routes->post('store/deleteStore/(:num)', 'CStore::deleteStore/$1');

//employee (worker)
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
//get data employee from selectbox
$routes->get('employee/getDataSuperiorNameFilter', 'CWorker::getDataSuperiorNameFilter');
$routes->post('employee/getDataSuperiorNameFilter', 'CWorker::getDataSuperiorNameFilter');

$routes->get('employee/checkSuperiorRoleAjax', 'CWorker::checkSuperiorRoleAjax');
$routes->post('employee/checkSuperiorRoleAjax', 'CWorker::checkSuperiorRoleAjax');

$routes->get('employee/checkFilterSuperiorRoleByEmployeeRole', 'CWorker::checkFilterSuperiorRoleByEmployeeRole');
$routes->post('employee/checkFilterSuperiorRoleByEmployeeRole', 'CWorker::checkFilterSuperiorRoleByEmployeeRole');

$routes->get('employee/checkSuperiorNameAjax', 'CWorker::checkSuperiorNameAjax');
$routes->post('employee/checkSuperiorNameAjax', 'CWorker::checkSuperiorNameAjax');

//Schedule :: Operational Technical
$routes->get('schedule', 'CSchedule::index');
$routes->get('schedule/add', 'CSchedule::add');
$routes->post('schedule/add', 'CSchedule::add');

//Schedule :: Operational Technical :: Shift
$routes->get('techshift', 'CSchedule::techshift');
$routes->post('techshift', 'CSchedule::techshift');
$routes->get('techshift/userTbTechShift', 'CSchedule::userTbTechShift');
$routes->post('techshift/userTbTechShift', 'CSchedule::userTbTechShift');
$routes->get('techshift/saveTechShift', 'CSchedule::saveTechShift');
$routes->post('techshift/saveTechShift', 'CSchedule::saveTechShift');
$routes->get('techshift/editTechShift/(:num)', 'CSchedule::editTechShift/$1');
$routes->post('techshift/editTechShift/(:num)', 'CSchedule::editTechShift/$1');
$routes->get('techshift/deleteTechShift/(:num)', 'CSchedule::deleteTechShift/$1');
$routes->post('techshift/deleteTechShift/(:num)', 'CSchedule::deleteTechShift/$1');
$routes->get('techshift/checkWorkerShiftAjax', 'CSchedule::checkWorkerShiftAjax');
$routes->post('techshift/checkWorkerShiftAjax', 'CSchedule::checkWorkerShiftAjax');

//Schedule :: Operational Technical :: Job Assignment Out
$routes->get('techjobout', 'CSchedule::techjobout');
$routes->post('techjobout', 'CSchedule::techjobout');
$routes->get('techjobout/saveTechJobOut', 'CSchedule::saveTechJobOut');
$routes->post('techjobout/saveTechJobOut', 'CSchedule::saveTechJobOut');
$routes->get('techjobout/editTechJobOut/(:num)', 'CSchedule::editTechJobOut/$1');
$routes->post('techjobout/editTechJobOut/(:num)', 'CSchedule::editTechJobOut/$1');
$routes->get('techjobout/deleteTechJobOut/(:num)', 'CSchedule::deleteTechJobOut/$1');
$routes->post('techjobout/deleteTechJobOut/(:num)', 'CSchedule::deleteTechJobOut/$1');
$routes->get('techjobout/checkWorkerTechJobAjax', 'CSchedule::checkWorkerTechJobAjax');
$routes->post('techjobout/checkWorkerTechJobAjax', 'CSchedule::checkWorkerTechJobAjax');

//Schedule :: Operational Technical :: Job Assignment In
$routes->get('techjobin', 'CSchedule::techjobin');
$routes->get('techjobin/submitTechJobIn/(:num)', 'CSchedule::submitTechJobIn/$1');
$routes->post('techjobin/submitTechJobIn/(:num)', 'CSchedule::submitTechJobIn/$1');

//Schedule :: Operational Troubleshoot
$routes->get('troubleshift', 'CSchedule::troubleshift');
$routes->get('troublejobout', 'CSchedule::troublejobout');
$routes->get('troublejobin', 'CSchedule::troublejobin');

$routes->get('troubleshift/saveShift', 'CSchedule::saveShift');
$routes->post('troubleshift/saveShift', 'CSchedule::saveShift');
$routes->get('troubleshift/updateShift/(:num)', 'CSchedule::updateShift/$1');
$routes->post('troubleshift/updateShift/(:num)', 'CSchedule::updateShift/$1');
$routes->get('troubleshift/deleteShift/(:num)', 'CSchedule::deleteShift/$1');
$routes->post('troubleshift/deleteShift/(:num)', 'CSchedule::deleteShift/$1');

$routes->get('troublejobout/saveSchedule', 'CSchedule::saveSchedule');
$routes->post('troublejobout/saveSchedule', 'CSchedule::saveSchedule');
$routes->get('troublejobout/updateSchedule/(:num)', 'CSchedule::updateSchedule/$1');
$routes->post('troublejobout/updateSchedule/(:num)', 'CSchedule::updateSchedule/$1');
$routes->get('troublejobout/deleteSchedule/(:num)', 'CSchedule::deleteSchedule/$1');
$routes->post('troublejobout/deleteSchedule/(:num)', 'CSchedule::deleteSchedule/$1');

$routes->get('troublejobin/approverejectschedule/(:num)', 'CSchedule::approveRejectSchedule/$1');
$routes->post('troublejobin/approverejectschedule/(:num)', 'CSchedule::approveRejectSchedule/$1');

$routes->get('equipment', 'CEquipment::index');

$routes->get('trafocubicle', 'CEquipment::trafocubicle');
$routes->get('kwhmeter', 'CEquipment::kwhmeter');
$routes->get('panellvmdp', 'CEquipment::panellvmdp');
$routes->get('panelcapacitorbank', 'CEquipment::panelcapacitorbank');
$routes->get('dieselhydrant', 'CEquipment::dieselhydrant');
$routes->get('acchiller', 'CEquipment::acchiller');
$routes->get('accoolingtower', 'CEquipment::accoolingtower');
$routes->get('acahu', 'CEquipment::acahu');
$routes->get('acsplitwallduckcassettevrv', 'CEquipment::acsplitwallduckcassettevrv');







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
