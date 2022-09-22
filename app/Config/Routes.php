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


//? Store Equipment
$routes->get('storeEquipment', 'CEquipment::index');
$routes->post('storeEquipment', 'CEquipment::index');
$routes->get('storeEquipment/saveStoreEquipment', 'CEquipment::saveStoreEquipment');
$routes->post('storeEquipment/saveStoreEquipment', 'CEquipment::saveStoreEquipment');
$routes->get('storeEquipment/editStoreEquipment', 'CEquipment::editStoreEquipment');
$routes->post('storeEquipment/editStoreEquipment', 'CEquipment::editStoreEquipment');
$routes->get('storeEquipment/deleteStoreEquipment', 'CEquipment::deleteStoreEquipment');
$routes->post('storeEquipment/deleteStoreEquipment', 'CEquipment::deleteStoreEquipment');
$routes->get('storeEquipment/ajaxDataStoreEquipment', 'CEquipment::ajaxDataStoreEquipment');
$routes->post('storeEquipment/ajaxDataStoreEquipment', 'CEquipment::ajaxDataStoreEquipment');

//? Equipment UPS
$routes->get('ups', 'CEquipment::ups');
$routes->get('ups/saveups', 'CEquipment::saveUps');
$routes->post('ups/saveups', 'CEquipment::saveUps');
$routes->get('ups/updateups/(:num)', 'CEquipment::updateUps/$1');
$routes->post('ups/updateups/(:num)', 'CEquipment::updateUps/$1');
$routes->get('ups/deleteups', 'CEquipment::deleteUps');
$routes->post('ups/deleteups', 'CEquipment::deleteUps');
$routes->get('ups/ajaxDataUps', 'CEquipment::ajaxDataUps');
$routes->post('ups/ajaxDataUps', 'CEquipment::ajaxDataUps');

//? Equipment Gas Station
$routes->get('gasstation', 'CEquipment::gasStation');
$routes->get('gasstation/savegasstation', 'CEquipment::saveGasStation');
$routes->post('gasstation/savegasstation', 'CEquipment::saveGasStation');
$routes->get('gasstation/updategasstation/(:num)', 'CEquipment::updateGasStation/$1');
$routes->post('gasstation/updategasstation/(:num)', 'CEquipment::updateGasStation/$1');
$routes->get('gasstation/deletegasstation', 'CEquipment::deleteGasStation');
$routes->post('gasstation/deletegasstation', 'CEquipment::deleteGasStation');
$routes->get('gasstation/ajaxDatagasstation', 'CEquipment::ajaxDataGasStation');
$routes->post('gasstation/ajaxDatagasstation', 'CEquipment::ajaxDataGasStation');

//? Equipment STP
$routes->get('stp', 'CEquipment::stp');
$routes->get('stp/saveStp', 'CEquipment::saveStp');
$routes->post('stp/saveStp', 'CEquipment::saveStp');
$routes->get('stp/updateStp/(:num)', 'CEquipment::updateStp/$1');
$routes->post('stp/updateStp/(:num)', 'CEquipment::updateStp/$1');
$routes->get('stp/deleteStp', 'CEquipment::deleteStp');
$routes->post('stp/deleteStp', 'CEquipment::deleteStp');
$routes->get('stp/ajaxDataStp', 'CEquipment::ajaxDataStp');
$routes->post('stp/ajaxDataStp', 'CEquipment::ajaxDataStp');

//? Equipment CCTV
$routes->get('cctv', 'CEquipment::cctv');
$routes->get('cctv/saveCctv', 'CEquipment::saveCctv');
$routes->post('cctv/saveCctv', 'CEquipment::saveCctv');
$routes->get('cctv/updateCctv/(:num)', 'CEquipment::updateCctv/$1');
$routes->post('cctv/updateCctv/(:num)', 'CEquipment::updateCctv/$1');
$routes->get('cctv/deleteCctv', 'CEquipment::deleteCctv');
$routes->post('cctv/deleteCctv', 'CEquipment::deleteCctv');
$routes->get('cctv/ajaxDataCctv', 'CEquipment::ajaxDataCctv');
$routes->post('cctv/ajaxDataCctv', 'CEquipment::ajaxDataCctv');

//? Equipment Plumbing
$routes->get('plumbing', 'CEquipment::plumbing');
$routes->get('plumbing/savePlumbing', 'CEquipment::savePlumbing');
$routes->post('plumbing/savePlumbing', 'CEquipment::saveplumbing');
$routes->get('plumbing/updatePlumbing/(:num)', 'CEquipment::updatePlumbing/$1');
$routes->post('plumbing/updatePlumbing/(:num)', 'CEquipment::updatePlumbing/$1');
$routes->get('plumbing/deletePlumbing', 'CEquipment::deletePlumbing');
$routes->post('plumbing/deletePlumbing', 'CEquipment::deletePlumbing');
$routes->get('plumbing/ajaxDataPlumbing', 'CEquipment::ajaxDataPlumbing');
$routes->post('plumbing/ajaxDataPlumbing', 'CEquipment::ajaxDataPlumbing');

//? Equipment Meter Sumber dan Air Olahan
$routes->get('metersumber', 'CEquipment::metersumber');
$routes->get('metersumber/saveMeterSumber', 'CEquipment::saveMeterSumber');
$routes->post('metersumber/saveMeterSumber', 'CEquipment::saveMeterSumber');
$routes->get('metersumber/updateMeterSumber/(:num)', 'CEquipment::updateMeterSumber/$1');
$routes->post('metersumber/updateMeterSumber/(:num)', 'CEquipment::updateMeterSumber/$1');
$routes->get('metersumber/deleteMeterSumber', 'CEquipment::deleteMeterSumber');
$routes->post('metersumber/deleteMeterSumber', 'CEquipment::deleteMeterSumber');
$routes->get('metersumber/ajaxDataMeterSumber', 'CEquipment::ajaxDataMeterSumber');
$routes->post('metersumber/ajaxDataMeterSumber', 'CEquipment::ajaxDataMeterSumber');

//? Equipment Dinding Partisi
$routes->get('dindingpartisi', 'CEquipment::dindingpartisi');
$routes->get('dindingpartisi/saveDindingPartisi', 'CEquipment::saveDindingPartisi');
$routes->post('dindingpartisi/saveDindingPartisi', 'CEquipment::saveDindingPartisi');
$routes->get('dindingpartisi/updateDindingPartisi/(:num)', 'CEquipment::updateDindingPartisi/$1');
$routes->post('dindingpartisi/updateDindingPartisi/(:num)', 'CEquipment::updateDindingPartisi/$1');
$routes->get('dindingpartisi/deleteDindingPartisi', 'CEquipment::deleteDindingPartisi');
$routes->post('dindingpartisi/deleteDindingPartisi', 'CEquipment::deleteDindingPartisi');
$routes->get('dindingpartisi/ajaxDataDindingPartisi', 'CEquipment::ajaxDataDindingPartisi');
$routes->post('dindingpartisi/ajaxDataDindingPartisi', 'CEquipment::ajaxDataDindingPartisi');

//? Equipment Pintu
$routes->get('pintu', 'CEquipment::pintu');
$routes->get('pintu/savePintu', 'CEquipment::savePintu');
$routes->post('pintu/savePintu', 'CEquipment::savePintu');
$routes->get('pintu/updatePintu/(:num)', 'CEquipment::updatePintu/$1');
$routes->post('pintu/updatePintu/(:num)', 'CEquipment::updatePintu/$1');
$routes->get('pintu/deletePintu', 'CEquipment::deletePintu');
$routes->post('pintu/deletePintu', 'CEquipment::deletePintu');
$routes->get('pintu/ajaxDataPintu', 'CEquipment::ajaxDataPintu');
$routes->post('pintu/ajaxDataPintu', 'CEquipment::ajaxDataPintu');

//? Equipment Folding Gate
$routes->get('foldinggate', 'CEquipment::foldinggate');
$routes->get('foldinggate/saveFoldingGate', 'CEquipment::saveFoldingGate');
$routes->post('foldinggate/saveFoldingGate', 'CEquipment::saveFoldingGate');
$routes->get('foldinggate/updateFoldingGate/(:num)', 'CEquipment::updateFoldingGate/$1');
$routes->post('foldinggate/updateFoldingGate/(:num)', 'CEquipment::updateFoldingGate/$1');
$routes->get('foldinggate/deleteFoldingGate', 'CEquipment::deleteFoldingGate');
$routes->post('foldinggate/deleteFoldingGate', 'CEquipment::deleteFoldingGate');
$routes->get('foldinggate/ajaxDataFoldingGate', 'CEquipment::ajaxDataFoldingGate');
$routes->post('foldinggate/ajaxDataFoldingGate', 'CEquipment::ajaxDataFoldingGate');

//? Equipment Rolling Door
$routes->get('rollingdoor', 'CEquipment::rollingdoor');
$routes->get('rollingdoor/saveRollingDoor', 'CEquipment::saveRollingDoor');
$routes->post('rollingdoor/saveRollingDoor', 'CEquipment::saveRollingDoor');
$routes->get('rollingdoor/updateRollingDoor/(:num)', 'CEquipment::updateRollingDoor/$1');
$routes->post('rollingdoor/updateRollingDoor/(:num)', 'CEquipment::updateRollingDoor/$1');
$routes->get('rollingdoor/deleteRollingDoor', 'CEquipment::deleteRollingDoor');
$routes->post('rollingdoor/deleteRollingDoor', 'CEquipment::deleteRollingDoor');
$routes->get('rollingdoor/ajaxDataRollingDoor', 'CEquipment::ajaxDataRollingDoor');
$routes->post('rollingdoor/ajaxDataRollingDoor', 'CEquipment::ajaxDataRollingDoor');

//? Equipment Fire Fighting
$routes->get('firefighting', 'CEquipment::firefighting');
$routes->get('firefighting/saveFireFighting', 'CEquipment::saveFireFighting');
$routes->post('firefighting/saveFireFighting', 'CEquipment::saveFireFighting');
$routes->get('firefighting/updateFireFighting/(:num)', 'CEquipment::updateFireFighting/$1');
$routes->post('firefighting/updateFireFighting/(:num)', 'CEquipment::updateFireFighting/$1');
$routes->get('firefighting/deleteFireFighting', 'CEquipment::deleteFireFighting');
$routes->post('firefighting/deleteFireFighting', 'CEquipment::deleteFireFighting');
$routes->get('firefighting/ajaxDataFireFighting', 'CEquipment::ajaxDataFireFighting');
$routes->post('firefighting/ajaxDataFireFighting', 'CEquipment::ajaxDataFireFighting');

//? Equipment Telephone & PABX
$routes->get('telppabx', 'CEquipment::telppabx');
$routes->get('telppabx/saveTelpPabx', 'CEquipment::saveTelpPabx');
$routes->post('telppabx/saveTelpPabx', 'CEquipment::saveTelpPabx');
$routes->get('telppabx/updateTelpPabx/(:num)', 'CEquipment::updateTelpPabx/$1');
$routes->post('telppabx/updateTelpPabx/(:num)', 'CEquipment::updateTelpPabx/$1');
$routes->get('telppabx/deleteTelpPabx', 'CEquipment::deleteTelpPabx');
$routes->post('telppabx/deleteTelpPabx', 'CEquipment::deleteTelpPabx');
$routes->get('telppabx/ajaxDataTelpPabx', 'CEquipment::ajaxDataTelpPabx');
$routes->post('telppabx/ajaxDataTelpPabx', 'CEquipment::ajaxDataTelpPabx');

//? Equipment Housekeeping
$routes->get('housekeeping', 'CEquipment::housekeeping');
$routes->get('housekeeping/saveHousekeeping', 'CEquipment::saveHousekeeping');
$routes->post('housekeeping/saveHousekeeping', 'CEquipment::saveHousekeeping');
$routes->get('housekeeping/updateHousekeeping/(:num)', 'CEquipment::updateHousekeeping/$1');
$routes->post('housekeeping/updateHousekeeping/(:num)', 'CEquipment::updateHousekeeping/$1');
$routes->get('housekeeping/deleteHousekeeping', 'CEquipment::deleteHousekeeping');
$routes->post('housekeeping/deleteHousekeeping', 'CEquipment::deleteHousekeeping');
$routes->get('housekeeping/ajaxDataHousekeeping', 'CEquipment::ajaxDataHousekeeping');
$routes->post('housekeeping/ajaxDataHousekeeping', 'CEquipment::ajaxDataHousekeeping');

//? Equipment Gondola
$routes->get('gondola', 'CEquipment::gondola');
$routes->get('gondola/saveGondola', 'CEquipment::saveGondola');
$routes->post('gondola/saveGondola', 'CEquipment::saveGondola');
$routes->get('gondola/updateGondola/(:num)', 'CEquipment::updateGondola/$1');
$routes->post('gondola/updateGondola/(:num)', 'CEquipment::updateGondola/$1');
$routes->get('gondola/deleteGondola', 'CEquipment::deleteGondola');
$routes->post('gondola/deleteGondola', 'CEquipment::deleteGondola');
$routes->get('gondola/ajaxDataGondola', 'CEquipment::ajaxDataGondola');
$routes->post('gondola/ajaxDataGondola', 'CEquipment::ajaxDataGondola');





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
