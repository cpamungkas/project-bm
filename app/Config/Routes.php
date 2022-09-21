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

$routes->get('userguide', 'CGuide::index');

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
$routes->get('techjobin/(:num)', 'CSchedule::techjobin/$1');

$routes->get('troubleshift', 'CSchedule::troubleshift');
$routes->get('troublejobout', 'CSchedule::troublejobout');
$routes->get('troublejobin', 'CSchedule::troublejobin');

$routes->get('troubleshift/checkWorkerShiftAjax', 'CSchedule::checkWorkerShiftAjax');
$routes->post('troubleshift/checkWorkerShiftAjax', 'CSchedule::checkWorkerShiftAjax');
// $routes->get('troubleshift/checkEditWorkerShiftAjax', 'CSchedule::checkEditWorkerShiftAjax');
// $routes->post('troubleshift/checkEditWorkerShiftAjax', 'CSchedule::checkEditWorkerShiftAjax');

$routes->get('troublejobout/checkWorkerJobAjax', 'CSchedule::checkWorkerJobAjax');
$routes->post('troublejobout/checkWorkerJobAjax', 'CSchedule::checkWorkerJobAjax');

$routes->get('troubleshift/applyShiftFilter', 'CSchedule::applyShiftFilter');
$routes->post('troubleshift/applyShiftFilter', 'CSchedule::applyShiftFilter');
$routes->get('troublejobout/applyScheduleOutFilter', 'CSchedule::applyScheduleOutFilter');
$routes->post('troublejobout/applyScheduleOutFilter', 'CSchedule::applyScheduleOutFilter');
$routes->get('troublejobin/applyScheduleInFilter', 'CSchedule::applyScheduleInFilter');
$routes->post('troublejobin/applyScheduleInFilter', 'CSchedule::applyScheduleInFilter');

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

$routes->get('trafocubicle', 'CEquipment::trafocubicle');
$routes->get('trafocubicle/saveTrafoCubicle', 'CEquipment::saveTrafoCubicle');
$routes->post('trafocubicle/saveTrafoCubicle', 'CEquipment::saveTrafoCubicle');
$routes->get('trafocubicle/updateTrafoCubicle/(:num)', 'CEquipment::updateTrafoCubicle/$1');
$routes->post('trafocubicle/updateTrafoCubicle/(:num)', 'CEquipment::updateTrafoCubicle/$1');
$routes->get('trafocubicle/deleteTrafoCubicle/(:num)', 'CEquipment::deleteTrafoCubicle/$1');
$routes->post('trafocubicle/deleteTrafoCubicle/(:num)', 'CEquipment::deleteTrafoCubicle/$1');

$routes->get('kwhmeter', 'CEquipment::kwhmeter');
$routes->get('kwhmeter/saveKwhMeter', 'CEquipment::saveKwhMeter');
$routes->post('kwhmeter/saveKwhMeter', 'CEquipment::saveKwhMeter');
$routes->get('kwhmeter/updateKwhMeter/(:num)', 'CEquipment::updateKwhMeter/$1');
$routes->post('kwhmeter/updateKwhMeter/(:num)', 'CEquipment::updateKwhMeter/$1');
$routes->get('kwhmeter/deleteKwhMeter/(:num)', 'CEquipment::deleteKwhMeter/$1');
$routes->post('kwhmeter/deleteKwhMeter/(:num)', 'CEquipment::deleteKwhMeter/$1');

$routes->get('panellvmdp', 'CEquipment::panellvmdp');
$routes->get('panellvmdp/savePanelLvmdp', 'CEquipment::savePanelLvmdp');
$routes->post('panellvmdp/savePanelLvmdp', 'CEquipment::savePanelLvmdp');
$routes->get('panellvmdp/updatePanelLvmdp/(:num)', 'CEquipment::updatePanelLvmdp/$1');
$routes->post('panellvmdp/updatePanelLvmdp/(:num)', 'CEquipment::updatePanelLvmdp/$1');
$routes->get('panellvmdp/deletePanelLvmdp/(:num)', 'CEquipment::deletePanelLvmdp/$1');
$routes->post('panellvmdp/deletePanelLvmdp/(:num)', 'CEquipment::deletePanelLvmdp/$1');

$routes->get('panelcapacitorbank', 'CEquipment::panelcapacitorbank');
$routes->get('panelcapacitorbank/savePanelCapacitorBank', 'CEquipment::savePanelCapacitorBank');
$routes->post('panelcapacitorbank/savePanelCapacitorBank', 'CEquipment::savePanelCapacitorBank');
$routes->get('panelcapacitorbank/updatePanelCapacitorBank/(:num)', 'CEquipment::updatePanelCapacitorBank/$1');
$routes->post('panelcapacitorbank/updatePanelCapacitorBank/(:num)', 'CEquipment::updatePanelCapacitorBank/$1');
$routes->get('panelcapacitorbank/deletePanelCapacitorBank/(:num)', 'CEquipment::deletePanelCapacitorBank/$1');
$routes->post('panelcapacitorbank/deletePanelCapacitorBank/(:num)', 'CEquipment::deletePanelCapacitorBank/$1');

$routes->get('genset([1-2])', 'CEquipment::genset/$1');
$routes->get('genset([1-2])/saveGenset', 'CEquipment::saveGenset/$1');
$routes->post('genset([1-2])/saveGenset', 'CEquipment::saveGenset/$1');
$routes->get('genset([1-2])/updateGenset/(:num)', 'CEquipment::updateGenset/$1/$2');
$routes->post('genset([1-2])/updateGenset/(:num)', 'CEquipment::updateGenset/$1/$2');
$routes->get('genset([1-2])/deleteGenset/(:num)', 'CEquipment::deleteGenset/$1/$2');
$routes->post('genset([1-2])/deleteGenset/(:num)', 'CEquipment::deleteGenset/$1/$2');

$routes->get('dieselhydrant', 'CEquipment::dieselhydrant');
$routes->get('dieselhydrant/saveDieselHydrant', 'CEquipment::saveDieselHydrant');
$routes->post('dieselhydrant/saveDieselHydrant', 'CEquipment::saveDieselHydrant');
$routes->get('dieselhydrant/updateDieselHydrant/(:num)', 'CEquipment::updateDieselHydrant/$1');
$routes->post('dieselhydrant/updateDieselHydrant/(:num)', 'CEquipment::updateDieselHydrant/$1');
$routes->get('dieselhydrant/deleteDieselHydrant/(:num)', 'CEquipment::deleteDieselHydrant/$1');
$routes->post('dieselhydrant/deleteDieselHydrant/(:num)', 'CEquipment::deleteDieselHydrant/$1');

$routes->get('acchiller', 'CEquipment::acchiller');
$routes->get('acchiller/saveAcChiller', 'CEquipment::saveAcChiller');
$routes->post('acchiller/saveAcChiller', 'CEquipment::saveAcChiller');
$routes->get('acchiller/updateAcChiller/(:num)', 'CEquipment::updateAcChiller/$1');
$routes->post('acchiller/updateAcChiller/(:num)', 'CEquipment::updateAcChiller/$1');
$routes->get('acchiller/deleteAcChiller/(:num)', 'CEquipment::deleteAcChiller/$1');
$routes->post('acchiller/deleteAcChiller/(:num)', 'CEquipment::deleteAcChiller/$1');

$routes->get('accoolingtower', 'CEquipment::accoolingtower');
$routes->get('accoolingtower/saveAcCoolingTower', 'CEquipment::saveAcCoolingTower');
$routes->post('accoolingtower/saveAcCoolingTower', 'CEquipment::saveAcCoolingTower');
$routes->get('accoolingtower/updateAcCoolingTower/(:num)', 'CEquipment::updateAcCoolingTower/$1');
$routes->post('accoolingtower/updateAcCoolingTower/(:num)', 'CEquipment::updateAcCoolingTower/$1');
$routes->get('accoolingtower/deleteAcCoolingTower/(:num)', 'CEquipment::deleteAcCoolingTower/$1');
$routes->post('accoolingtower/deleteAcCoolingTower/(:num)', 'CEquipment::deleteAcCoolingTower/$1');

$routes->get('acahu', 'CEquipment::acahu');
$routes->get('acahu/saveAcAhu', 'CEquipment::saveAcAhu');
$routes->post('acahu/saveAcAhu', 'CEquipment::saveAcAhu');
$routes->get('acahu/updateAcAhu/(:num)', 'CEquipment::updateAcAhu/$1');
$routes->post('acahu/updateAcAhu/(:num)', 'CEquipment::updateAcAhu/$1');
$routes->get('acahu/deleteAcAhu/(:num)', 'CEquipment::deleteAcAhu/$1');
$routes->post('acahu/deleteAcAhu/(:num)', 'CEquipment::deleteAcAhu/$1');

$routes->get('acsplitwallduckcassettevrv', 'CEquipment::acsplitwallduckcassettevrv');
$routes->get('acsplitwallduckcassettevrv/saveAcSplitWallDuckCassetteVrv', 'CEquipment::saveAcSplitWallDuckCassetteVrv');
$routes->post('acsplitwallduckcassettevrv/saveAcSplitWallDuckCassetteVrv', 'CEquipment::saveAcSplitWallDuckCassetteVrv');
$routes->get('acsplitwallduckcassettevrv/updateAcSplitWallDuckCassetteVrv/(:num)', 'CEquipment::updateAcSplitWallDuckCassetteVrv/$1');
$routes->post('acsplitwallduckcassettevrv/updateAcSplitWallDuckCassetteVrv/(:num)', 'CEquipment::updateAcSplitWallDuckCassetteVrv/$1');
$routes->get('acsplitwallduckcassettevrv/deleteAcSplitWallDuckCassetteVrv/(:num)', 'CEquipment::deleteAcSplitWallDuckCassetteVrv/$1');
$routes->post('acsplitwallduckcassettevrv/deleteAcSplitWallDuckCassetteVrv/(:num)', 'CEquipment::deleteAcSplitWallDuckCassetteVrv/$1');

$routes->get('temperature', 'CEquipment::temperature');
$routes->get('temperature/saveTemperature', 'CEquipment::saveTemperature');
$routes->post('temperature/saveTemperature', 'CEquipment::saveTemperature');
$routes->get('temperature/updateTemperature/(:num)', 'CEquipment::updateTemperature/$1');
$routes->post('temperature/updateTemperature/(:num)', 'CEquipment::updateTemperature/$1');
$routes->get('temperature/deleteTemperature/(:num)', 'CEquipment::deleteTemperature/$1');
$routes->post('temperature/deleteTemperature/(:num)', 'CEquipment::deleteTemperature/$1');

$routes->get('lighting', 'CEquipment::lighting');
$routes->get('lighting/saveLighting', 'CEquipment::saveLighting');
$routes->post('lighting/saveLighting', 'CEquipment::saveLighting');
$routes->get('lighting/updateLighting/(:num)', 'CEquipment::updateLighting/$1');
$routes->post('lighting/updateLighting/(:num)', 'CEquipment::updateLighting/$1');
$routes->get('lighting/deleteLighting/(:num)', 'CEquipment::deleteLighting/$1');
$routes->post('lighting/deleteLighting/(:num)', 'CEquipment::deleteLighting/$1');

$routes->get('escalator', 'CEquipment::escalator');
$routes->get('escalator/saveEscalator', 'CEquipment::saveEscalator');
$routes->post('escalator/saveEscalator', 'CEquipment::saveEscalator');
$routes->get('escalator/updateEscalator/(:num)', 'CEquipment::updateEscalator/$1');
$routes->post('escalator/updateEscalator/(:num)', 'CEquipment::updateEscalator/$1');
$routes->get('escalator/deleteEscalator/(:num)', 'CEquipment::deleteEscalator/$1');
$routes->post('escalator/deleteEscalator/(:num)', 'CEquipment::deleteEscalator/$1');

$routes->get('elevator', 'CEquipment::elevator');
$routes->get('elevator/saveElevator', 'CEquipment::saveElevator');
$routes->post('elevator/saveElevator', 'CEquipment::saveElevator');
$routes->get('elevator/updateElevator/(:num)', 'CEquipment::updateElevator/$1');
$routes->post('elevator/updateElevator/(:num)', 'CEquipment::updateElevator/$1');
$routes->get('elevator/deleteElevator/(:num)', 'CEquipment::deleteElevator/$1');
$routes->post('elevator/deleteElevator/(:num)', 'CEquipment::deleteElevator/$1');

$routes->get('dumbwaiter', 'CEquipment::dumbwaiter');
$routes->get('dumbwaiter/saveDumbwaiter', 'CEquipment::saveDumbwaiter');
$routes->post('dumbwaiter/saveDumbwaiter', 'CEquipment::saveDumbwaiter');
$routes->get('dumbwaiter/updateDumbwaiter/(:num)', 'CEquipment::updateDumbwaiter/$1');
$routes->post('dumbwaiter/updateDumbwaiter/(:num)', 'CEquipment::updateDumbwaiter/$1');
$routes->get('dumbwaiter/deleteDumbwaiter/(:num)', 'CEquipment::deleteDumbwaiter/$1');
$routes->post('dumbwaiter/deleteDumbwaiter/(:num)', 'CEquipment::deleteDumbwaiter/$1');

$routes->get('sanitary', 'CEquipment::sanitary');
$routes->get('sanitary/saveSanitary', 'CEquipment::saveSanitary');
$routes->post('sanitary/saveSanitary', 'CEquipment::saveSanitary');
$routes->get('sanitary/updateSanitary/(:num)', 'CEquipment::updateSanitary/$1');
$routes->post('sanitary/updateSanitary/(:num)', 'CEquipment::updateSanitary/$1');
$routes->get('sanitary/deleteSanitary/(:num)', 'CEquipment::deleteSanitary/$1');
$routes->post('sanitary/deleteSanitary/(:num)', 'CEquipment::deleteSanitary/$1');


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
