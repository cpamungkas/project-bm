<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MUser;
use App\Models\MStore;
use App\Models\MSchedule;
use App\Models\MEquipment;
use App\Models\MTrafocubicle;
use App\Models\MKwhmeter;
use App\Models\MPanellvmdp;
use App\Models\MPanelcapacitorbank;
use App\Models\MGenset;
use App\Models\MDieselhydrant;
use App\Models\MAcchiller;
use App\Models\MAccoolingtower;
use App\Models\MAcahu;
use App\Models\MAcsplitwallduckcassettevrv;
use App\Models\MTemperature;
use App\Models\MLighting;
use App\Models\MEscalator;
use App\Models\MElevator;
use App\Models\MDumbwaiter;
use App\Models\MSanitary;
use CodeIgniter\HTTP\Request;

class CEquipment extends BaseController {
    public function __construct() {
        $this->mUser = new MUser();
        $this->mStore = new MStore();
        $this->mSchedule = new MSchedule();
        $this->mEquipment = new MEquipment();
        $this->mTrafocubicle = new MTrafocubicle();
        $this->mKwhmeter = new MKwhmeter();
        $this->mPanellvmdp = new MPanellvmdp();
        $this->mPanelcapacitorbank = new MPanelcapacitorbank();
        $this->mGenset = new MGenset();
        $this->mDieselhydrant = new MDieselhydrant();
        $this->mAcchiller = new MAcchiller();
        $this->mAccoolingtower = new MAccoolingtower();
        $this->mAcahu = new MAcahu();
        $this->mAcsplitwallduckcassettevrv = new MAcsplitwallduckcassettevrv();
        $this->mTemperature = new MTemperature();
        $this->mLighting = new MLighting();
        $this->mEscalator = new MEscalator();
        $this->mElevator = new MElevator();
        $this->mDumbwaiter = new MDumbwaiter();
        $this->mSanitary = new MSanitary();
        helper(['form', 'url']);
    }

    public function index() {
        $data['url'] = $this->request->uri->getSegment(1);
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data['title'] = 'Equipment | B.M Apps &copy; Gramedia ' . date('Y');
            $data['isLoggedIn'] = session()->get('isLoggedIn');
            $data['id'] = session()->get('id');
            $data['username'] = session()->get('username');
            $data['name'] = session()->get('name');
            $data['email'] = session()->get('email');
            $data['image'] = session()->get('image');
            $data['is_active'] = session()->get('is_active');
            $data['role_id'] = session()->get('role_id');
            $data['roleuser'] = session()->get('roleuser');
            $data['superior_role_id'] = session()->get('superior_role_id');
            $data['location'] = session()->get('location');
            $data['level'] = session()->get('level');
            $data['status_deleted'] = session()->get('status_deleted');
            $data['validation'] = \Config\Services::validation();

            return view('vEquipment', $data);
        }
    }

    public function trafocubicle() {
        $data['url'] = $this->request->uri->getSegment(1);
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data['title'] = 'Trafo & Cubicle | B.M Apps &copy; Gramedia ' . date('Y');
            $data['isLoggedIn'] = session()->get('isLoggedIn');
            $data['id'] = session()->get('id');
            $data['username'] = session()->get('username');
            $data['name'] = session()->get('name');
            $data['email'] = session()->get('email');
            $data['image'] = session()->get('image');
            $data['is_active'] = session()->get('is_active');
            $data['role_id'] = session()->get('role_id');
            $data['roleuser'] = session()->get('roleuser');
            $data['superior_role_id'] = session()->get('superior_role_id');
            $data['idstore'] = session()->get('idstore');
            $data['location'] = session()->get('location');
            $data['level'] = session()->get('level');
            $data['status_deleted'] = session()->get('status_deleted');

            $data['getStoreEquipmentByStore'] = $this->mEquipment->getStoreEquipmentByStore(session()->get('idstore'));
            $data['getStoreEquipmentByStoreEquipment'] = $this->mEquipment->getStoreEquipmentByStoreEquipment(session()->get('idstore'), 1);

            $data['getTrafoCubicleByStore'] = $this->mTrafocubicle->getTrafoCubicleByStore(session()->get('idstore'));
            $data['getTrafoCubicleByStoreDate'] = $this->mTrafocubicle->getTrafoCubicleByStoreDate(session()->get('idstore'));

            $data['validation'] = \Config\Services::validation();

            if($data['getStoreEquipmentByStoreEquipment']) {
                return view('vTrafocubicle', $data);
            }
            else {
                return redirect()->to('/storeEquipment');
            }
        }
    }

    public function saveTrafoCubicle() {
        session();

        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'time' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Time'
                ],
                'oil_temperature' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be a decimal number',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Suhu Oli'
                ],
                'trafo_cleanliness' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Trafo: Kebersihan Trafo'
                ],
                'trafo_temperature' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be a decimal number',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Trafo: Suhu Ruang'
                ],
                'trafo_oil_leak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Trafo: Oli Rembes'
                ],
                'cubicle_cleanliness' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Cubicle: Kebersihan Cubicle'
                ],
                'cubicle_temperature' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be a decimal number',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Cubicle: Suhu Ruang'
                ],
                'cubicle_noise' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Cubicle: Noise'
                ],
                'cubicle_ozone' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Cubicle: Tercium Bau Ozone'
                ]
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/trafocubicle')->withInput()->with('validation', $validation);
            }

            $data['url'] = $this->request->uri->getSegment(1);
            $data = [
                'location' => $this->request->getPost('location'),
                'date' => $this->request->getPost('date'),
                'time' => $this->request->getPost('time'),
                'worker' => $this->request->getPost('worker'),
                'oil_temperature' => $this->request->getPost('oil_temperature'),
                'trafo_cleanliness' => $this->request->getPost('trafo_cleanliness'),
                'trafo_temperature' => $this->request->getPost('trafo_temperature'),
                'trafo_oil_leak' => $this->request->getPost('trafo_oil_leak'),
                'cubicle_cleanliness' => $this->request->getPost('cubicle_cleanliness'),
                'cubicle_temperature' => $this->request->getPost('cubicle_temperature'),
                'cubicle_noise' => $this->request->getPost('cubicle_noise'),
                'cubicle_ozone' => $this->request->getPost('cubicle_ozone'),
                'date_created' => time(),
                'date_updated' => time(),
                'status_deleted' => 0
            ];

            if($this->mTrafocubicle->insert($data)) {
                session()->setFlashdata('success', 'Trafo & cubicle data has been added');
                return redirect()->to('/trafocubicle');
            }
            else {
                session()->setFlashdata('error', 'Fail to add trafo & cubicle data');
                return redirect()->to('/trafocubicle');
            }
        }
    }

    public function updateTrafoCubicle($id) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'edittime' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Time'
                ],
                'editoiltemperature' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be a decimal number',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Suhu Oli'
                ],
                'edittrafocleanliness' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Trafo: Kebersihan Trafo'
                ],
                'edittrafotemperature' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be a decimal number',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Trafo: Suhu Ruang'
                ],
                'edittrafooilleak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Trafo: Oli Rembes'
                ],
                'editcubiclecleanliness' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Cubicle: Kebersihan Cubicle'
                ],
                'editcubicletemperature' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be a decimal number',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Cubicle: Suhu Ruang'
                ],
                'editcubiclenoise' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Cubicle: Noise'
                ],
                'editcubicleozone' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Cubicle: Tercium Bau Ozone'
                ]
            ])) {
                $validation = \Config\Services::validation();
                session()->setFlashdata('error', 'Fail to update trafo & cubicle data, input invalid');
                return redirect()->to('/trafocubicle')->withInput()->with('validation', $validation);
            }

            $data = [
                'time' => $this->request->getVar('edittime'),
                'worker' => $this->request->getVar('editworker'),
                'oil_temperature' => $this->request->getVar('editoiltemperature'),
                'trafo_cleanliness' => $this->request->getVar('edittrafocleanliness'),
                'trafo_temperature' => $this->request->getVar('edittrafotemperature'),
                'trafo_oil_leak' => $this->request->getVar('edittrafooilleak'),
                'cubicle_cleanliness' => $this->request->getVar('editcubiclecleanliness'),
                'cubicle_temperature' => $this->request->getVar('editcubicletemperature'),
                'cubicle_noise' => $this->request->getVar('editcubiclenoise'),
                'cubicle_ozone' => $this->request->getVar('editcubicleozone'),
                'date_updated' => time()
            ];

            if($this->mTrafocubicle->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Trafo & cubicle data has been updated');
                return redirect()->to('/trafocubicle');
            }
            else {
                session()->setFlashdata('error', 'Fail to update trafo & cubicle data');
                return redirect()->to('/trafocubicle');
            }
        }
    }

    public function deleteTrafoCubicle($id = 0) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data = [
                'date_updated' => time(),
                'status_deleted' => 1
            ];

            if($this->mTrafocubicle->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Trafo & cubicle data has been deleted');
                return redirect()->to('/trafocubicle');
            }
            else {
                session()->setFlashdata('warning', 'Fail to delete trafo & cubicle data');
                return redirect()->to('/trafocubicle');
            }
        }
    }

    public function kwhmeter() {
        $data['url'] = $this->request->uri->getSegment(1);

        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data['title'] = 'KWH Meter | B.M Apps &copy; Gramedia ' . date('Y');
            $data['isLoggedIn'] = session()->get('isLoggedIn');
            $data['id'] = session()->get('id');
            $data['username'] = session()->get('username');
            $data['name'] = session()->get('name');
            $data['email'] = session()->get('email');
            $data['image'] = session()->get('image');
            $data['is_active'] = session()->get('is_active');
            $data['role_id'] = session()->get('role_id');
            $data['roleuser'] = session()->get('roleuser');
            $data['superior_role_id'] = session()->get('superior_role_id');
            $data['idstore'] = session()->get('idstore');
            $data['location'] = session()->get('location');
            $data['level'] = session()->get('level');
            $data['status_deleted'] = session()->get('status_deleted');

            $data['getStoreEquipmentByStore'] = $this->mEquipment->getStoreEquipmentByStore(session()->get('idstore'));
            $data['getStoreEquipmentByStoreEquipment'] = $this->mEquipment->getStoreEquipmentByStoreEquipment(session()->get('idstore'), 2);

            $data['getKwhMeterByStore'] = $this->mKwhmeter->getKwhMeterByStore(session()->get('idstore'));
            $data['getKwhMeterByStoreDate'] = $this->mKwhmeter->getKwhMeterByStoreDate(session()->get('idstore'));
            $data['getKwhMeterIdPlnByStore'] = $this->mKwhmeter->getKwhMeterIdPlnByStore(session()->get('idstore'));

            $data['validation'] = \Config\Services::validation();

            if($data['getStoreEquipmentByStoreEquipment']) {
                return view('vKwhmeter', $data);
            }
            else {
                return redirect()->to('/storeEquipment');
            }
        }
    }

    public function saveKwhMeter() {
        session();

        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'time' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Time'
                ],
                'id_pln' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'ID PLN'
                ],
                'cos_phi' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be a decimal number',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Cos Phi'
                ],
                'kw' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be a decimal number',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'KW'
                ],
                'lwbp' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be a decimal number',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'LWBP'
                ],
                'wbp' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be a decimal number',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'WBP'
                ],
                'kvarh' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be a decimal number',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'KVARH'
                ]
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/kwhmeter')->withInput()->with('validation', $validation);
            }

            $data['url'] = $this->request->uri->getSegment(1);
            $data = [
                'location' => $this->request->getPost('location'),
                'date' => $this->request->getPost('date'),
                'time' => $this->request->getPost('time'),
                'worker' => $this->request->getPost('worker'),
                'kwh_meter' => $this->request->getPost('kwh_meter'),
                'id_pln' => $this->request->getPost('id_pln'),
                'cos_phi' => $this->request->getPost('cos_phi'),
                'kw' => $this->request->getPost('kw'),
                'lwbp' => $this->request->getPost('lwbp'),
                'wbp' => $this->request->getPost('wbp'),
                'kvarh' => $this->request->getPost('kvarh'),
                'date_created' => time(),
                'date_updated' => time(),
                'status_deleted' => 0
            ];

            if($this->mKwhmeter->insert($data)) {
                session()->setFlashdata('success', 'KWH meter data has been added');
                return redirect()->to('/kwhmeter');
            }
            else {
                session()->setFlashdata('error', 'Fail to add KWH meter data');
                return redirect()->to('/kwhmeter');
            }
        }
    }

    public function updateKwhMeter($id) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'edittime' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Time'
                ],
                'editidpln' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'ID PLN'
                ],
                'editcosphi' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be a decimal number',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Cos Phi'
                ],
                'editkw' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be a decimal number',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'KW'
                ],
                'editlwbp' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be a decimal number',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'LWBP'
                ],
                'editwbp' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be a decimal number',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'WBP'
                ],
                'editkvarh' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be a decimal number',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'KVARH'
                ]
            ])) {
                $validation = \Config\Services::validation();
                session()->setFlashdata('error', 'Fail to update KWH meter data, input invalid');
                return redirect()->to('/kwhmeter')->withInput()->with('validation', $validation);
            }

            $data = [
                'time' => $this->request->getVar('edittime'),
                'worker' => $this->request->getVar('editworker'),
                'kwh_meter' => $this->request->getVar('editkwhmeter'),
                'id_pln' => $this->request->getVar('editidpln'),
                'cos_phi' => $this->request->getVar('editcosphi'),
                'kw' => $this->request->getVar('editkw'),
                'lwbp' => $this->request->getVar('editlwbp'),
                'wbp' => $this->request->getVar('editwbp'),
                'kvarh' => $this->request->getVar('editkvarh'),
                'date_updated' => time()
            ];

            if($this->mKwhmeter->update($idUrl, $data)) {
                session()->setFlashdata('success', 'KWH meter data has been updated');
                return redirect()->to('/kwhmeter');
            }
            else {
                session()->setFlashdata('error', 'Fail to update KWH meter data');
                return redirect()->to('/kwhmeter');
            }
        }
    }

    public function deleteKwhMeter($id = 0) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data = [
                'date_updated' => time(),
                'status_deleted' => 1
            ];

            if($this->mKwhmeter->update($idUrl, $data)) {
                session()->setFlashdata('success', 'KWH meter data has been deleted');
                return redirect()->to('/kwhmeter');
            }
            else {
                session()->setFlashdata('warning', 'Fail to delete KWH meter data');
                return redirect()->to('/kwhmeter');
            }
        }
    }

    public function panellvmdp() {
        $data['url'] = $this->request->uri->getSegment(1);
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } 
        else {
            $data['title'] = 'Panel LVMDP | B.M Apps &copy; Gramedia ' . date('Y');
            $data['isLoggedIn'] = session()->get('isLoggedIn');
            $data['id'] = session()->get('id');
            $data['username'] = session()->get('username');
            $data['name'] = session()->get('name');
            $data['email'] = session()->get('email');
            $data['image'] = session()->get('image');
            $data['is_active'] = session()->get('is_active');
            $data['role_id'] = session()->get('role_id');
            $data['roleuser'] = session()->get('roleuser');
            $data['superior_role_id'] = session()->get('superior_role_id');
            $data['idstore'] = session()->get('idstore');
            $data['location'] = session()->get('location');
            $data['level'] = session()->get('level');
            $data['status_deleted'] = session()->get('status_deleted');

            $data['getStoreEquipmentByStore'] = $this->mEquipment->getStoreEquipmentByStore(session()->get('idstore'));
            $data['getStoreEquipmentByStoreEquipment'] = $this->mEquipment->getStoreEquipmentByStoreEquipment(session()->get('idstore'), 4);

            $data['getPanelLvmdpByStore'] = $this->mPanellvmdp->getPanelLvmdpByStore(session()->get('idstore'));
            $data['getPanelLvmdpByStoreDate'] = $this->mPanellvmdp->getPanelLvmdpByStoreDate(session()->get('idstore'));

            $data['validation'] = \Config\Services::validation();

            if($data['getStoreEquipmentByStoreEquipment']) {
                return view('vPanellvmdp', $data);
            }
            else {
                return redirect()->to('/storeEquipment');
            }
        }
    }

    public function savePanelLvmdp() {
        session();

        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'time' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Time'
                ],
                'vac_rs' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Tegangan: R - S'
                ],
                'vac_st' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Tegangan: S - T'
                ],
                'vac_tn' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Tegangan: T - N'
                ],
                'vac_ng' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Tegangan: N - G'
                ],
                'cleanliness' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Kondisi: Kebersihan Panel'
                ],
                'temperature' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be a decimal number',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Kondisi: Suhu Ruang'
                ],
                'connection' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Kondisi: Koneksi Kabel'
                ],
                'in_r' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Arus: R'
                ],
                'in_s' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Arus: S'
                ],
                'in_t' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Arus: T'
                ],
                'description' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Keterangan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/panellvmdp')->withInput()->with('validation', $validation);
            }

            $data['url'] = $this->request->uri->getSegment(1);
            $data = [
                'location' => $this->request->getPost('location'),
                'date' => $this->request->getPost('date'),
                'time' => $this->request->getPost('time'),
                'worker' => $this->request->getPost('worker'),
                'vac_rs' => $this->request->getPost('vac_rs'),
                'vac_st' => $this->request->getPost('vac_st'),
                'vac_tn' => $this->request->getPost('vac_tn'),
                'vac_ng' => $this->request->getPost('vac_ng'),
                'cleanliness' => $this->request->getPost('cleanliness'),
                'temperature' => $this->request->getPost('temperature'),
                'connection' => $this->request->getPost('connection'),
                'in_r' => $this->request->getPost('in_r'),
                'in_s' => $this->request->getPost('in_s'),
                'in_t' => $this->request->getPost('in_t'),
                'description' => $this->request->getPost('description'),
                'date_created' => time(),
                'date_updated' => time(),
                'status_deleted' => 0
            ];

            if($this->mPanellvmdp->insert($data)) {
                session()->setFlashdata('success', 'Panel LVMDP data has been added');
                return redirect()->to('/panellvmdp');
            }
            else {
                session()->setFlashdata('error', 'Fail to add panel LVMDP data');
                return redirect()->to('/panellvmdp');
            }
        }
    }

    public function updatePanelLvmdp($id) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'edittime' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Time'
                ],
                'editvacrs' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Tegangan: R - S'
                ],
                'editvacst' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Tegangan: S - T'
                ],
                'editvactn' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Tegangan: T - N'
                ],
                'editvacng' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Tegangan: N - G'
                ],
                'editcleanliness' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Kondisi: Kebersihan Panel'
                ],
                'edittemperature' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be a decimal number',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Kondisi: Suhu Ruang'
                ],
                'editconnection' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Kondisi: Koneksi Kabel'
                ],
                'editinr' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Arus: R'
                ],
                'editins' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Arus: S'
                ],
                'editint' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Arus: T'
                ],
                'editdescription' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Keterangan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                session()->setFlashdata('error', 'Fail to update panel LVMDP data, input invalid');
                return redirect()->to('/panellvmdp')->withInput()->with('validation', $validation);
            }

            $data = [
                'time' => $this->request->getVar('edittime'),
                'worker' => $this->request->getVar('editworker'),
                'vac_rs' => $this->request->getVar('editvacrs'),
                'vac_st' => $this->request->getVar('editvacst'),
                'vac_tn' => $this->request->getVar('editvactn'),
                'vac_ng' => $this->request->getVar('editvacng'),
                'cleanliness' => $this->request->getVar('editcleanliness'),
                'temperature' => $this->request->getVar('edittemperature'),
                'connection' => $this->request->getVar('editconnection'),
                'in_r' => $this->request->getVar('editinr'),
                'in_s' => $this->request->getVar('editins'),
                'in_t' => $this->request->getVar('editint'),
                'description' => $this->request->getVar('editdescription'),
                'date_updated' => time()
            ];

            if($this->mPanellvmdp->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Panel LVMDP data has been updated');
                return redirect()->to('/panellvmdp');
            }
            else {
                session()->setFlashdata('error', 'Fail to update panel LVMDP data');
                return redirect()->to('/panellvmdp');
            }
        }
    }

    public function deletePanelLvmdp($id = 0) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data = [
                'date_updated' => time(),
                'status_deleted' => 1
            ];

            if($this->mPanellvmdp->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Panel LVMDP data has been deleted');
                return redirect()->to('/panellvmdp');
            }
            else {
                session()->setFlashdata('warning', 'Fail to delete panel LVMDP data');
                return redirect()->to('/panellvmdp');
            }
        }
    }

    public function panelcapacitorbank() {
        $data['url'] = $this->request->uri->getSegment(1);
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } 
        else {
            $data['title'] = 'Panel Capacitor Bank | B.M Apps &copy; Gramedia ' . date('Y');
            $data['isLoggedIn'] = session()->get('isLoggedIn');
            $data['id'] = session()->get('id');
            $data['username'] = session()->get('username');
            $data['name'] = session()->get('name');
            $data['email'] = session()->get('email');
            $data['image'] = session()->get('image');
            $data['is_active'] = session()->get('is_active');
            $data['role_id'] = session()->get('role_id');
            $data['roleuser'] = session()->get('roleuser');
            $data['superior_role_id'] = session()->get('superior_role_id');
            $data['idstore'] = session()->get('idstore');
            $data['location'] = session()->get('location');
            $data['level'] = session()->get('level');
            $data['status_deleted'] = session()->get('status_deleted');

            $data['getStoreEquipmentByStore'] = $this->mEquipment->getStoreEquipmentByStore(session()->get('idstore'));
            $data['getStoreEquipmentByStoreEquipment'] = $this->mEquipment->getStoreEquipmentByStoreEquipment(session()->get('idstore'), 5);

            $data['getPanelCapacitorBankByStore'] = $this->mPanelcapacitorbank->getPanelCapacitorBankByStore(session()->get('idstore'));
            $data['getPanelCapacitorBankByStoreDate'] = $this->mPanelcapacitorbank->getPanelCapacitorBankByStoreDate(session()->get('idstore'));

            $data['validation'] = \Config\Services::validation();

            if($data['getStoreEquipmentByStoreEquipment']) {
                return view('vPanelcapacitorbank', $data);
            }
            else {
                return redirect()->to('/storeEquipment');
            }
        }
    }

    public function savePanelCapacitorBank() {
        session();

        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'time' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Time'
                ],
                'cos_phi' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be a decimal number',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Total Cos Phi'
                ],
                'kw' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be a decimal number',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Total KW'
                ],
                'kvar' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be a decimal number',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Total KVAR'
                ],
                'step' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Step Number'
                ],
                'in_r' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Arus: R'
                ],
                'in_s' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Arus: S'
                ],
                'in_t' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Arus: T'
                ],
                'cleanliness' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Kondisi: Kebersihan Panel'
                ],
                'temperature' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be a decimal number',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Kondisi: Suhu Ruang'
                ],
                'connection' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Kondisi: Koneksi Kabel'
                ],
                'description' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Keterangan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/panelcapacitorbank')->withInput()->with('validation', $validation);
            }

            $data['url'] = $this->request->uri->getSegment(1);
            $data = [
                'location' => $this->request->getPost('location'),
                'date' => $this->request->getPost('date'),
                'time' => $this->request->getPost('time'),
                'worker' => $this->request->getPost('worker'),
                'cos_phi' => $this->request->getPost('cos_phi'),
                'kw' => $this->request->getPost('kw'),
                'kvar' => $this->request->getPost('kvar'),
                'step' => $this->request->getPost('step'),
                'in_r' => $this->request->getPost('in_r'),
                'in_s' => $this->request->getPost('in_s'),
                'in_t' => $this->request->getPost('in_t'),
                'cleanliness' => $this->request->getPost('cleanliness'),
                'temperature' => $this->request->getPost('temperature'),
                'connection' => $this->request->getPost('connection'),
                'description' => $this->request->getPost('description'),
                'date_created' => time(),
                'date_updated' => time(),
                'status_deleted' => 0
            ];

            if($this->mPanelcapacitorbank->insert($data)) {
                session()->setFlashdata('success', 'Panel capacitor bank data has been added');
                return redirect()->to('/panelcapacitorbank');
            }
            else {
                session()->setFlashdata('error', 'Fail to add panel capacitor bank data');
                return redirect()->to('/panelcapacitorbank');
            }
        }
    }

    public function updatePanelCapacitorBank($id) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'edittime' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Time'
                ],
                'editcosphi' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Total Cos Phi'
                ],
                'editkw' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Total KW'
                ],
                'editkvar' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Total KVAR'
                ],
                'editstep' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Step Number'
                ],
                'editinr' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Arus: R'
                ],
                'editins' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Arus: S'
                ],
                'editint' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Arus: T'
                ],
                'editcleanliness' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Kondisi: Kebersihan Panel'
                ],
                'edittemperature' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be a decimal number',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Kondisi: Suhu Ruang'
                ],
                'editconnection' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Kondisi: Koneksi Kabel'
                ],
                'editdescription' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Keterangan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                session()->setFlashdata('error', 'Fail to update panel capacitor bank data, input invalid');
                return redirect()->to('/panelcapacitorbank')->withInput()->with('validation', $validation);
            }

            $data = [
                'time' => $this->request->getVar('edittime'),
                'worker' => $this->request->getVar('editworker'),
                'cos_phi' => $this->request->getVar('editcosphi'),
                'kw' => $this->request->getVar('editkw'),
                'kvar' => $this->request->getVar('editkvar'),
                'step' => $this->request->getVar('editstep'),
                'in_r' => $this->request->getVar('editinr'),
                'in_s' => $this->request->getVar('editins'),
                'in_t' => $this->request->getVar('editint'),
                'cleanliness' => $this->request->getVar('editcleanliness'),
                'temperature' => $this->request->getVar('edittemperature'),
                'connection' => $this->request->getVar('editconnection'),
                'description' => $this->request->getVar('editdescription'),
                'date_updated' => time()
            ];

            if($this->mPanelcapacitorbank->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Panel capacitor bank data has been updated');
                return redirect()->to('/panelcapacitorbank');
            }
            else {
                session()->setFlashdata('error', 'Fail to update panel capacitor bank data');
                return redirect()->to('/panelcapacitorbank');
            }
        }
    }

    public function deletePanelCapacitorBank($id = 0) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data = [
                'date_updated' => time(),
                'status_deleted' => 1
            ];

            if($this->mPanelcapacitorbank->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Panel capacitor bank data has been deleted');
                return redirect()->to('/panelcapacitorbank');
            }
            else {
                session()->setFlashdata('warning', 'Fail to delete panel capacitor bank data');
                return redirect()->to('/panelcapacitorbank');
            }
        }
    }

    public function genset($genset) {
        $data['url'] = $this->request->uri->getSegment(1);
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } 
        else {
            $data['title'] = 'Genset ' . $genset . ' | B.M Apps &copy; Gramedia ' . date('Y');
            $data['isLoggedIn'] = session()->get('isLoggedIn');
            $data['id'] = session()->get('id');
            $data['username'] = session()->get('username');
            $data['name'] = session()->get('name');
            $data['email'] = session()->get('email');
            $data['image'] = session()->get('image');
            $data['is_active'] = session()->get('is_active');
            $data['role_id'] = session()->get('role_id');
            $data['roleuser'] = session()->get('roleuser');
            $data['superior_role_id'] = session()->get('superior_role_id');
            $data['idstore'] = session()->get('idstore');
            $data['location'] = session()->get('location');
            $data['level'] = session()->get('level');
            $data['status_deleted'] = session()->get('status_deleted');

            $data['getStoreEquipmentByStore'] = $this->mEquipment->getStoreEquipmentByStore(session()->get('idstore'));
            $data['getStoreEquipmentByStoreEquipment'] = $this->mEquipment->getStoreEquipmentByStoreEquipment(session()->get('idstore'), 6);

            $data['genset'] = $genset;
            $data['getGensetByStore'] = $this->mGenset->getGensetByStore(session()->get('idstore'), $genset);
            $data['getGensetByStoreDate'] = $this->mGenset->getGensetByStoreDate(session()->get('idstore'), $genset);

            $data['validation'] = \Config\Services::validation();

            if($data['getStoreEquipmentByStoreEquipment']) {
                return view('vGenset', $data);
            }
            else {
                return redirect()->to('/storeEquipment');
            }
        }
    }

    public function saveGenset($genset) {
        session();

        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'time' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Time'
                ],
                'run_number' => [
                    'rules' => 'required|integer|greater_than[0]|less_than_equal_to[5]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'integer' => '{field} must be an integer',
                        'greater_than' => '{field} must be greater than {param}',
                        'less_than_equal_to'  => '{field} must be less than or equal to {param}'
                    ],
                    'label' => 'Genset Run Number'
                ],
                'pressure' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Tekanan Oli'
                ],
                'radiator' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Air Radiator'
                ],
                'start' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Engine Run Time: Start'
                ],
                'running' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Engine Run Time: Running'
                ],
                'vdc_12' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Tegangan Battery: 12 Vdc'
                ],
                'vdc_24' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Tegangan Battery: 24 Vdc'
                ],
                'solar' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Tangki Solar Harian'
                ],
                'rs' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'General Voltage Report: R - S'
                ],
                'st' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'General Voltage Report: S - T'
                ],
                'tn' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'General Voltage Report: T - N'
                ],
                'ln' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'General Voltage Report: L - N'
                ],
                'r' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'General Load Report: R'
                ],
                's' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'General Load Report: S'
                ],
                't' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'General Load Report: T'
                ],
                'kw' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'General Load Report: KW'
                ],
                'description' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Keterangan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/genset' . $genset)->withInput()->with('validation', $validation);
            }

            $data['url'] = $this->request->uri->getSegment(1);
            $data = [
                'location' => $this->request->getPost('location'),
                'date' => $this->request->getPost('date'),
                'time' => $this->request->getPost('time'),
                'worker' => $this->request->getPost('worker'),
                'genset' => $genset,
                'run_number' => $this->request->getPost('run_number'),
                'pressure' => $this->request->getPost('pressure'),
                'radiator' => $this->request->getPost('radiator'),
                'start' => $this->request->getPost('start'),
                'running' => $this->request->getPost('running'),
                'vdc_12' => $this->request->getPost('vdc_12'),
                'vdc_24' => $this->request->getPost('vdc_24'),
                'solar' => $this->request->getPost('solar'),
                'rs' => $this->request->getPost('rs'),
                'st' => $this->request->getPost('st'),
                'tn' => $this->request->getPost('tn'),
                'ln' => $this->request->getPost('ln'),
                'r' => $this->request->getPost('r'),
                's' => $this->request->getPost('s'),
                't' => $this->request->getPost('t'),
                'kw' => $this->request->getPost('kw'),
                'description' => $this->request->getPost('description'),
                'date_created' => time(),
                'date_updated' => time()
            ];

            if($this->mGenset->insert($data)) {
                session()->setFlashdata('success', 'Genset data has been added');
                return redirect()->to('/genset' . $genset);
            }
            else {
                session()->setFlashdata('error', 'Fail to add genset data');
                return redirect()->to('/genset' . $genset);
            }
        }
    }

    public function updateGenset($genset, $id) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'editrunnumber' => [
                    'rules' => 'required|integer|greater_than[0]|less_than_equal_to[5]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'integer' => '{field} must be an integer',
                        'greater_than' => '{field} must be greater than {param}',
                        'less_than_equal_to'  => '{field} must be less than or equal to {param}'
                    ],
                    'label' => 'Genset Run Number'
                ],
                'editpressure' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Tekanan Oli'
                ],
                'editradiator' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Air Radiator'
                ],
                'editstart' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Engine Run Time: Start'
                ],
                'editrunning' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Engine Run Time: Running'
                ],
                'editvdc12' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Tegangan Battery: 12 Vdc'
                ],
                'editvdc24' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Tegangan Battery: 24 Vdc'
                ],
                'editsolar' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Tangki Solar Harian'
                ],
                'editrs' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'General Voltage Report: R - S'
                ],
                'editst' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'General Voltage Report: S - T'
                ],
                'edittn' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'General Voltage Report: T - N'
                ],
                'editln' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'General Voltage Report: L - N'
                ],
                'editr' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'General Load Report: R'
                ],
                'edits' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'General Load Report: S'
                ],
                'editt' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'General Load Report: T'
                ],
                'editkw' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'General Load Report: KW'
                ],
                'editdescription' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Keterangan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                session()->setFlashdata('error', 'Fail to update genset data, input invalid');
                return redirect()->to('/genset' . $genset)->withInput()->with('validation', $validation);
            }

            $data = [
                'worker' => $this->request->getVar('editworker'),
                'run_number' => $this->request->getVar('editrunnumber'),
                'pressure' => $this->request->getVar('editpressure'),
                'radiator' => $this->request->getVar('editradiator'),
                'start' => $this->request->getVar('editstart'),
                'running' => $this->request->getVar('editrunning'),
                'vdc_12' => $this->request->getVar('editvdc12'),
                'vdc_24' => $this->request->getVar('editvdc24'),
                'solar' => $this->request->getVar('editsolar'),
                'rs' => $this->request->getVar('editrs'),
                'st' => $this->request->getVar('editst'),
                'tn' => $this->request->getVar('edittn'),
                'ln' => $this->request->getVar('editln'),
                'r' => $this->request->getVar('editr'),
                's' => $this->request->getVar('edits'),
                't' => $this->request->getVar('editt'),
                'kw' => $this->request->getVar('editkw'),
                'description' => $this->request->getVar('editdescription'),
                'date_updated' => time()
            ];

            if($this->mGenset->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Genset data has been updated');
                return redirect()->to('/genset' . $genset);
            }
            else {
                session()->setFlashdata('error', 'Fail to update genset data');
                return redirect()->to('/genset' . $genset);
            }
        }
    }

    public function deleteGenset($genset, $id = 0) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data = [
                'date_updated' => time(),
                'status_deleted' => 1
            ];

            if($this->mGenset->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Genset data has been deleted');
                return redirect()->to('/genset' . $genset);
            }
            else {
                session()->setFlashdata('warning', 'Fail to delete genset data');
                return redirect()->to('/genset' . $genset);
            }
        }
    }

    public function dieselhydrant() {
        $data['url'] = $this->request->uri->getSegment(1);
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } 
        else {
            $data['title'] = 'Diesel Hydrant | B.M Apps &copy; Gramedia ' . date('Y');
            $data['isLoggedIn'] = session()->get('isLoggedIn');
            $data['id'] = session()->get('id');
            $data['username'] = session()->get('username');
            $data['name'] = session()->get('name');
            $data['email'] = session()->get('email');
            $data['image'] = session()->get('image');
            $data['is_active'] = session()->get('is_active');
            $data['role_id'] = session()->get('role_id');
            $data['roleuser'] = session()->get('roleuser');
            $data['superior_role_id'] = session()->get('superior_role_id');
            $data['idstore'] = session()->get('idstore');
            $data['location'] = session()->get('location');
            $data['level'] = session()->get('level');
            $data['status_deleted'] = session()->get('status_deleted');

            $data['getStoreEquipmentByStore'] = $this->mEquipment->getStoreEquipmentByStore(session()->get('idstore'));
            $data['getStoreEquipmentByStoreEquipment'] = $this->mEquipment->getStoreEquipmentByStoreEquipment(session()->get('idstore'), 7);

            $data['getDieselHydrantByStore'] = $this->mDieselhydrant->getDieselHydrantByStore(session()->get('idstore'));
            $data['getDieselHydrantByStoreDate'] = $this->mDieselhydrant->getDieselHydrantByStoreDate(session()->get('idstore'));

            $data['validation'] = \Config\Services::validation();

            if($data['getStoreEquipmentByStoreEquipment']) {
                return view('vDieselhydrant', $data);
            }
            else {
                return redirect()->to('/storeEquipment');
            }
        }
    }

    public function saveDieselHydrant() {
        session();

        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'time' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Time'
                ],
                'oil_pressure' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Tekanan Oli'
                ],
                'radiator' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Air Radiator'
                ],
                'start' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Engine Run Time: Start'
                ],
                'running' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Engine Run Time: Running'
                ],
                'battery_1' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Tegangan Battery 1'
                ],
                'battery_2' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Tegangan Battery 2'
                ],
                'solar' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Tangki Solar Harian'
                ],
                'pipe_pressure' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Tekanan Air Pipa Header'
                ],
                'description' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Keterangan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/dieselhydrant')->withInput()->with('validation', $validation);
            }

            $data['url'] = $this->request->uri->getSegment(1);
            $data = [
                'location' => $this->request->getPost('location'),
                'date' => $this->request->getPost('date'),
                'time' => $this->request->getPost('time'),
                'worker' => $this->request->getPost('worker'),
                'oil_pressure' => $this->request->getPost('oil_pressure'),
                'radiator' => $this->request->getPost('radiator'),
                'start' => $this->request->getPost('start'),
                'running' => $this->request->getPost('running'),
                'battery_1' => $this->request->getPost('battery_1'),
                'battery_2' => $this->request->getPost('battery_2'),
                'solar' => $this->request->getPost('solar'),
                'pipe_pressure' => $this->request->getPost('pipe_pressure'),
                'description' => $this->request->getPost('description'),
                'date_created' => time(),
                'date_updated' => time()
            ];

            if($this->mDieselhydrant->insert($data)) {
                session()->setFlashdata('success', 'Diesel hydrant data has been added');
                return redirect()->to('/dieselhydrant');
            }
            else {
                session()->setFlashdata('error', 'Fail to add diesel hydrant data');
                return redirect()->to('/dieselhydrant');
            }
        }
    }

    public function updateDieselHydrant($id) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'editoilpressure' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Tekanan Oli'
                ],
                'editradiator' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Air Radiator'
                ],
                'editstart' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Engine Run Time: Start'
                ],
                'editrunning' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Engine Run Time: Running'
                ],
                'editbattery1' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Tegangan Battery 1'
                ],
                'editbattery2' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Tegangan Battery 2'
                ],
                'editsolar' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Tangki Solar Harian'
                ],
                'editpipepressure' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Tekanan Air Pipa Header'
                ],
                'editdescription' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Keterangan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                session()->setFlashdata('error', 'Fail to update diesel hydrant data, input invalid');
                return redirect()->to('/dieselhydrant')->withInput()->with('validation', $validation);
            }

            $data = [
                'worker' => $this->request->getVar('editworker'),
                'oil_pressure' => $this->request->getVar('editoilpressure'),
                'radiator' => $this->request->getVar('editradiator'),
                'start' => $this->request->getVar('editstart'),
                'running' => $this->request->getVar('editrunning'),
                'battery_1' => $this->request->getVar('editbattery1'),
                'battery_2' => $this->request->getVar('editbattery2'),
                'solar' => $this->request->getVar('editsolar'),
                'pipe_pressure' => $this->request->getVar('editpipepressure'),
                'description' => $this->request->getVar('editdescription'),
                'date_updated' => time()
            ];

            if($this->mDieselhydrant->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Diesel hydrant data has been updated');
                return redirect()->to('/dieselhydrant');
            }
            else {
                session()->setFlashdata('error', 'Fail to update diesel hydrant data');
                return redirect()->to('/dieselhydrant');
            }
        }
    }

    public function deleteDieselHydrant($id = 0) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data = [
                'date_updated' => time(),
                'status_deleted' => 1
            ];

            if($this->mDieselhydrant->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Diesel hydrant data has been deleted');
                return redirect()->to('/dieselhydrant');
            }
            else {
                session()->setFlashdata('warning', 'Fail to delete diesel hydrant data');
                return redirect()->to('/dieselhydrant');
            }
        }
    }

    public function acchiller() {
        $data['url'] = $this->request->uri->getSegment(1);
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } 
        else {
            $data['title'] = 'AC Chiller | B.M Apps &copy; Gramedia ' . date('Y');
            $data['isLoggedIn'] = session()->get('isLoggedIn');
            $data['id'] = session()->get('id');
            $data['username'] = session()->get('username');
            $data['name'] = session()->get('name');
            $data['email'] = session()->get('email');
            $data['image'] = session()->get('image');
            $data['is_active'] = session()->get('is_active');
            $data['role_id'] = session()->get('role_id');
            $data['roleuser'] = session()->get('roleuser');
            $data['superior_role_id'] = session()->get('superior_role_id');
            $data['idstore'] = session()->get('idstore');
            $data['location'] = session()->get('location');
            $data['level'] = session()->get('level');
            $data['status_deleted'] = session()->get('status_deleted');

            $data['getStoreEquipmentByStore'] = $this->mEquipment->getStoreEquipmentByStore(session()->get('idstore'));
            $data['getStoreEquipmentByStoreEquipment'] = $this->mEquipment->getStoreEquipmentByStoreEquipment(session()->get('idstore'), 8);

            $data['getAcChillerByStore'] = $this->mAcchiller->getAcChillerByStore(session()->get('idstore'));
            $data['getAcChillerByStoreDate'] = $this->mAcchiller->getAcChillerByStoreDate(session()->get('idstore'));

            $data['validation'] = \Config\Services::validation();

            if($data['getStoreEquipmentByStoreEquipment']) {
                return view('vAcchiller', $data);
            }
            else {
                return redirect()->to('/storeEquipment');
            }
        }
    }

    public function saveAcChiller() {
        session();

        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'time' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Time'
                ],
                'chiller_1' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Chiller No. 1'
                ],
                'chiller_2' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Chiller No. 2'
                ],
                'chwp_1' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'CHWP No. 1'
                ],
                'chwp_2' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'CHWP No. 2'
                ],
                'chwp_3' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'CHWP No. 3'
                ],
                'chwp_entering_temp' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'CHWP Water Report: Entering Water Temp.'
                ],
                'chwp_leaving_temp' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'CHWP Water Report: Leaving Water Temp.'
                ],
                'chwp_entering_pres' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'CHWP Water Report: Entering Water Pressure'
                ],
                'chwp_leaving_pres' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'CHWP Water Report: Leaving Water Pressure'
                ],
                'cwp_entering_temp' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'CWP Water Report: Entering Water Temp.'
                ],
                'cwp_leaving_temp' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'CWP Water Report: Leaving Water Temp.'
                ],
                'cwp_entering_pres' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'CWP Water Report: Entering Water Pressure'
                ],
                'cwp_leaving_pres' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'CWP Water Report: Leaving Water Pressure'
                ],
                'rs' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Chiller Load Report: R - S'
                ],
                'st' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Chiller Load Report: S - T'
                ],
                'tn' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Chiller Load Report: T - N'
                ],
                'r' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Chiller Load Report: R'
                ],
                's' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Chiller Load Report: S'
                ],
                't' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Chiller Load Report: T'
                ],
                'kw' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Chiller Load Report: KW'
                ],
                'eva_pres' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Chiller Report: Evaporator Refrigerant Pressure'
                ],
                'con_pres' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Chiller Report: Condensor Refrigerant Pressure'
                ],
                'eva_temp' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Chiller Report: Saturated Evaporator Refrigerant Temp.'
                ],
                'con_temp' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Chiller Report: Saturated Condensor Refrigerant Temp.'
                ],
                'rla' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Chiller Report: Compressor % RLA Average'
                ],
                'start' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Chiller Report: Compressor Start'
                ],
                'running' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Chiller Report: Compressor Running'
                ],
                'oil_temp' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Chiller Report: Oil Condensor Temp.'
                ],
                'set_point' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Chiller Report: Chiller Water Set Point'
                ],
                'description' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Keterangan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/acchiller')->withInput()->with('validation', $validation);
            }

            $data['url'] = $this->request->uri->getSegment(1);
            $data = [
                'location' => $this->request->getPost('location'),
                'date' => $this->request->getPost('date'),
                'time' => $this->request->getPost('time'),
                'worker' => $this->request->getPost('worker'),
                'chiller_1' => $this->request->getPost('chiller_1'),
                'chiller_2' => $this->request->getPost('chiller_2'),
                'chwp_1' => $this->request->getPost('chwp_1'),
                'chwp_2' => $this->request->getPost('chwp_2'),
                'chwp_3' => $this->request->getPost('chwp_3'),
                'chwp_entering_temp' => $this->request->getPost('chwp_entering_temp'),
                'chwp_leaving_temp' => $this->request->getPost('chwp_leaving_temp'),
                'chwp_entering_pres' => $this->request->getPost('chwp_entering_pres'),
                'chwp_leaving_pres' => $this->request->getPost('chwp_leaving_pres'),  
                'cwp_entering_temp' => $this->request->getPost('cwp_entering_temp'),
                'cwp_leaving_temp' => $this->request->getPost('cwp_leaving_temp'),
                'cwp_entering_pres' => $this->request->getPost('cwp_entering_pres'),
                'cwp_leaving_pres' => $this->request->getPost('cwp_leaving_pres'), 
                'rs' => $this->request->getPost('rs'),
                'st' => $this->request->getPost('st'),
                'tn' => $this->request->getPost('tn'),
                'r' => $this->request->getPost('r'),
                's' => $this->request->getPost('s'),
                't' => $this->request->getPost('t'),
                'kw' => $this->request->getPost('kw'),
                'eva_pres' => $this->request->getPost('eva_pres'),
                'con_pres' => $this->request->getPost('con_pres'),
                'eva_temp' => $this->request->getPost('eva_temp'),
                'con_temp' => $this->request->getPost('con_temp'),
                'rla' => $this->request->getPost('rla'),
                'start' => $this->request->getPost('start'),
                'running' => $this->request->getPost('running'),
                'oil_temp' => $this->request->getPost('oil_temp'),
                'set_point' => $this->request->getPost('set_point'),
                'description' => $this->request->getPost('description'),       
                'date_created' => time(),
                'date_updated' => time()
            ];

            if($this->mAcchiller->insert($data)) {
                session()->setFlashdata('success', 'AC chiller data has been added');
                return redirect()->to('/acchiller');
            }
            else {
                session()->setFlashdata('error', 'Fail to add AC chiller data');
                return redirect()->to('/acchiller');
            }
        }
    }

    public function updateAcChiller($id) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'edittime' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Time'
                ],
                'editchiller1' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Chiller No. 1'
                ],
                'editchiller2' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Chiller No. 2'
                ],
                'editchwp1' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'CHWP No. 1'
                ],
                'editchwp2' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'CHWP No. 2'
                ],
                'editchwp3' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'CHWP No. 3'
                ],
                'editchwpenteringtemp' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'CHWP Water Report: Entering Water Temp.'
                ],
                'editchwpleavingtemp' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'CHWP Water Report: Leaving Water Temp.'
                ],
                'editchwpenteringpres' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'CHWP Water Report: Entering Water Pressure'
                ],
                'editchwpleavingpres' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'CHWP Water Report: Leaving Water Pressure'
                ],
                'editcwpenteringtemp' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'CWP Water Report: Entering Water Temp.'
                ],
                'editcwpleavingtemp' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'CWP Water Report: Leaving Water Temp.'
                ],
                'editcwpenteringpres' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'CWP Water Report: Entering Water Pressure'
                ],
                'editcwpleavingpres' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'CWP Water Report: Leaving Water Pressure'
                ],
                'editrs' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Chiller Load Report: R - S'
                ],
                'editst' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Chiller Load Report: S - T'
                ],
                'edittn' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Chiller Load Report: T - N'
                ],
                'editr' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Chiller Load Report: R'
                ],
                'edits' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Chiller Load Report: S'
                ],
                'editt' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Chiller Load Report: T'
                ],
                'editkw' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Chiller Load Report: KW'
                ],
                'editevapres' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Chiller Report: Evaporator Refrigerant Pressure'
                ],
                'editconpres' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Chiller Report: Condensor Refrigerant Pressure'
                ],
                'editevatemp' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Chiller Report: Saturated Evaporator Refrigerant Temp.'
                ],
                'editcontemp' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Chiller Report: Saturated Condensor Refrigerant Temp.'
                ],
                'editrla' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Chiller Report: Compressor % RLA Average'
                ],
                'editstart' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Chiller Report: Compressor Start'
                ],
                'editrunning' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Chiller Report: Compressor Running'
                ],
                'editoiltemp' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Chiller Report: Oil Condensor Temp.'
                ],
                'editsetpoint' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Chiller Report: Chiller Water Set Point'
                ],
                'editdescription' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Keterangan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                session()->setFlashdata('error', 'Fail to update AC chiller data, input invalid');
                return redirect()->to('/acchiller')->withInput()->with('validation', $validation);
            }

            $data = [
                'time' => $this->request->getVar('edittime'),
                'worker' => $this->request->getVar('editworker'),
                'chiller_1' => $this->request->getVar('editchiller1'),
                'chiller_2' => $this->request->getVar('editchiller2'),
                'chwp_1' => $this->request->getVar('editchwp1'),
                'chwp_2' => $this->request->getVar('editchwp2'),
                'chwp_3' => $this->request->getVar('editchwp3'),
                'chwp_entering_temp' => $this->request->getVar('editchwpenteringtemp'),
                'chwp_leaving_temp' => $this->request->getVar('editchwpleavingtemp'),
                'chwp_entering_pres' => $this->request->getVar('editchwpenteringpres'),
                'chwp_leaving_pres' => $this->request->getVar('editchwpleavingpres'),  
                'cwp_entering_temp' => $this->request->getVar('editcwpenteringtemp'),
                'cwp_leaving_temp' => $this->request->getVar('editcwpleavingtemp'),
                'cwp_entering_pres' => $this->request->getVar('editcwpenteringpres'),
                'cwp_leaving_pres' => $this->request->getVar('editcwpleavingpres'), 
                'rs' => $this->request->getVar('editrs'),
                'st' => $this->request->getVar('editst'),
                'tn' => $this->request->getVar('edittn'),
                'r' => $this->request->getVar('editr'),
                's' => $this->request->getVar('edits'),
                't' => $this->request->getVar('editt'),
                'kw' => $this->request->getVar('editkw'),
                'eva_pres' => $this->request->getVar('editevapres'),
                'con_pres' => $this->request->getVar('editconpres'),
                'eva_temp' => $this->request->getVar('editevatemp'),
                'con_temp' => $this->request->getVar('editcontemp'),
                'rla' => $this->request->getVar('editrla'),
                'start' => $this->request->getVar('editstart'),
                'running' => $this->request->getVar('editrunning'),
                'oil_temp' => $this->request->getVar('editoiltemp'),
                'set_point' => $this->request->getVar('editsetpoint'),
                'description' => $this->request->getVar('editdescription'),
                'date_updated' => time()
            ];

            if($this->mAcchiller->update($idUrl, $data)) {
                session()->setFlashdata('success', 'AC chiller data has been updated');
                return redirect()->to('/acchiller');
            }
            else {
                session()->setFlashdata('error', 'Fail to update AC chiller data');
                return redirect()->to('/acchiller');
            }
        }
    }

    public function deleteAcChiller($id = 0) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data = [
                'date_updated' => time(),
                'status_deleted' => 1
            ];

            if($this->mAcchiller->update($idUrl, $data)) {
                session()->setFlashdata('success', 'AC chiller data has been deleted');
                return redirect()->to('/acchiller');
            }
            else {
                session()->setFlashdata('warning', 'Fail to delete AC chiller data');
                return redirect()->to('/acchiller');
            }
        }
    }

    public function accoolingtower() {
        $data['url'] = $this->request->uri->getSegment(1);
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data['title'] = 'AC Cooling Tower | B.M Apps &copy; Gramedia ' . date('Y');
            $data['isLoggedIn'] = session()->get('isLoggedIn');
            $data['id'] = session()->get('id');
            $data['username'] = session()->get('username');
            $data['name'] = session()->get('name');
            $data['email'] = session()->get('email');
            $data['image'] = session()->get('image');
            $data['is_active'] = session()->get('is_active');
            $data['role_id'] = session()->get('role_id');
            $data['roleuser'] = session()->get('roleuser');
            $data['superior_role_id'] = session()->get('superior_role_id');
            $data['idstore'] = session()->get('idstore');
            $data['location'] = session()->get('location');
            $data['level'] = session()->get('level');
            $data['status_deleted'] = session()->get('status_deleted');

            $data['getStoreEquipmentByStore'] = $this->mEquipment->getStoreEquipmentByStore(session()->get('idstore'));
            $data['getStoreEquipmentByStoreEquipment'] = $this->mEquipment->getStoreEquipmentByStoreEquipment(session()->get('idstore'), 9);

            $data['getAcCoolingTowerByStore'] = $this->mAccoolingtower->getAcCoolingTowerByStore(session()->get('idstore'));
            $data['getAcCoolingTowerByStoreDate'] = $this->mAccoolingtower->getAcCoolingTowerByStoreDate(session()->get('idstore'));

            $data['validation'] = \Config\Services::validation();

            if($data['getStoreEquipmentByStoreEquipment']) {
                return view('vAccoolingtower', $data);
            }
            else {
                return redirect()->to('/storeEquipment');
            }
        }
    }

    public function saveAcCoolingTower() {
        session();

        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'time' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Time'
                ],
                'cooling_1' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Cooling Tower No. 1'
                ],
                'cooling_2' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Cooling Tower No. 2'
                ],
                'cooling_3' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Cooling Tower No. 3'
                ],
                'cooling_4' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Cooling Tower No. 4'
                ],
                'cooling_5' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Cooling Tower No. 5'
                ],
                'cwp_1' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'CWP No. 1'
                ],
                'cwp_2' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'CWP No. 2'
                ],
                'cwp_3' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'CWP No. 3'
                ],
                'cwp_4' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'CWP No. 4'
                ],
                'cwp_5' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'CWP No. 5'
                ],
                'cwp_6' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'CWP No. 6'
                ],
                'moss' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Cooling Tower Report: Kondisi Kerak & Lumut'
                ],
                's26' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Water Treatment: Penghambat Lumut S26'
                ],
                's27' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Water Treatment: Mengurangi Kerak S27'
                ],
                'pump' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Water Treatment: Dozing Pump'
                ],
                'make_up' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Water Treatment: Make Up Water'
                ],
                'ph' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Water Treatment: PH Air'
                ],
                'rs' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Panel Report: R - S'
                ],
                'st' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Panel Report: S - T'
                ],
                'tn' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Panel Report: T - N'
                ],
                'ln' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Panel Report: L - N'
                ],
                'r' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Panel Report: R'
                ],
                's' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Panel Report: S'
                ],
                't' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Panel Report: T'
                ],
                'kw' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Panel Report: KW'
                ],
                'description' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Keterangan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/accoolingtower')->withInput()->with('validation', $validation);
            }

            $data['url'] = $this->request->uri->getSegment(1);
            $data = [
                'location' => $this->request->getPost('location'),
                'date' => $this->request->getPost('date'),
                'time' => $this->request->getPost('time'),
                'worker' => $this->request->getPost('worker'),
                'cooling_1' => $this->request->getPost('cooling_1'),
                'cooling_2' => $this->request->getPost('cooling_2'),
                'cooling_3' => $this->request->getPost('cooling_3'),
                'cooling_4' => $this->request->getPost('cooling_4'),
                'cooling_5' => $this->request->getPost('cooling_5'),
                'cwp_1' => $this->request->getPost('cwp_1'),
                'cwp_2' => $this->request->getPost('cwp_2'),
                'cwp_3' => $this->request->getPost('cwp_3'),
                'cwp_4' => $this->request->getPost('cwp_4'),
                'cwp_5' => $this->request->getPost('cwp_5'),
                'cwp_6' => $this->request->getPost('cwp_6'),
                'moss' => $this->request->getPost('moss'),
                's26' => $this->request->getPost('s26'),
                's27' => $this->request->getPost('s27'),
                'pump' => $this->request->getPost('pump'),
                'make_up' => $this->request->getPost('make_up'),
                'ph' => $this->request->getPost('ph'),
                'rs' => $this->request->getPost('rs'),
                'st' => $this->request->getPost('st'),
                'tn' => $this->request->getPost('tn'),
                'ln' => $this->request->getPost('ln'),
                'r' => $this->request->getPost('r'),
                's' => $this->request->getPost('s'),
                't' => $this->request->getPost('t'),
                'kw' => $this->request->getPost('kw'),
                'description' => $this->request->getPost('description'),     
                'date_created' => time(),
                'date_updated' => time()
            ];

            if($this->mAccoolingtower->insert($data)) {
                session()->setFlashdata('success', 'AC cooling tower data has been added');
                return redirect()->to('/accoolingtower');
            }
            else {
                session()->setFlashdata('error', 'Fail to add AC cooling tower data');
                return redirect()->to('/accoolingtower');
            }
        }
    }

    public function updateAcCoolingTower($id) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'edittime' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Time'
                ],
                'editcooling1' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Cooling Tower No. 1'
                ],
                'editcooling2' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Cooling Tower No. 2'
                ],
                'editcooling3' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Cooling Tower No. 3'
                ],
                'editcooling4' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Cooling Tower No. 4'
                ],
                'editcooling5' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Cooling Tower No. 5'
                ],
                'editcwp1' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'CWP No. 1'
                ],
                'editcwp2' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'CWP No. 2'
                ],
                'editcwp3' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'CWP No. 3'
                ],
                'editcwp4' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'CWP No. 4'
                ],
                'editcwp5' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'CWP No. 5'
                ],
                'editcwp6' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'CWP No. 6'
                ],
                'editmoss' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Cooling Tower Report: Kondisi Kerak & Lumut'
                ],
                'edits26' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Water Treatment: Penghambat Lumut S26'
                ],
                'edits27' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Water Treatment: Mengurangi Kerak S27'
                ],
                'editpump' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Water Treatment: Dozing Pump'
                ],
                'editmakeup' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Water Treatment: Make Up Water'
                ],
                'editph' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Water Treatment: PH Air'
                ],
                'editrs' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Panel Report: R - S'
                ],
                'editst' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Panel Report: S - T'
                ],
                'edittn' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Panel Report: T - N'
                ],
                'editln' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Panel Report: L - N'
                ],
                'editr' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Panel Report: R'
                ],
                'edits' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Panel Report: S'
                ],
                'editt' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric'
                    ],
                    'label' => 'Panel Report: T'
                ],
                'editkw' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Panel Report: KW'
                ],
                'editdescription' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Keterangan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                session()->setFlashdata('error', 'Fail to update AC cooling tower data, input invalid');
                return redirect()->to('/accoolingtower')->withInput()->with('validation', $validation);
            }

            $data = [
                'time' => $this->request->getVar('edittime'),
                'worker' => $this->request->getVar('editworker'),
                'cooling_1' => $this->request->getVar('editcooling1'),
                'cooling_2' => $this->request->getVar('editcooling2'),
                'cooling_3' => $this->request->getVar('editcooling3'),
                'cooling_4' => $this->request->getVar('editcooling4'),
                'cooling_5' => $this->request->getVar('editcooling5'),
                'cwp_1' => $this->request->getVar('editcwp1'),
                'cwp_2' => $this->request->getVar('editcwp2'),
                'cwp_3' => $this->request->getVar('editcwp3'),
                'cwp_4' => $this->request->getVar('editcwp4'),
                'cwp_5' => $this->request->getVar('editcwp5'),
                'cwp_6' => $this->request->getVar('editcwp6'),
                'moss' => $this->request->getVar('editmoss'),
                's26' => $this->request->getVar('edits26'),
                's27' => $this->request->getVar('edits27'),
                'pump' => $this->request->getVar('editpump'),
                'make_up' => $this->request->getVar('editmakeup'),
                'ph' => $this->request->getVar('editph'),
                'rs' => $this->request->getVar('editrs'),
                'st' => $this->request->getVar('editst'),
                'tn' => $this->request->getVar('edittn'),
                'ln' => $this->request->getVar('editln'),
                'r' => $this->request->getVar('editr'),
                's' => $this->request->getVar('edits'),
                't' => $this->request->getVar('editt'),
                'kw' => $this->request->getVar('editkw'),
                'description' => $this->request->getVar('editdescription'),
                'date_updated' => time()
            ];

            if($this->mAccoolingtower->update($idUrl, $data)) {
                session()->setFlashdata('success', 'AC cooling tower data has been updated');
                return redirect()->to('/accoolingtower');
            }
            else {
                session()->setFlashdata('error', 'Fail to update AC cooling tower data');
                return redirect()->to('/accoolingtower');
            }
        }
    }

    public function deleteAcCoolingTower($id = 0) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data = [
                'date_updated' => time(),
                'status_deleted' => 1
            ];

            if($this->mAccoolingtower->update($idUrl, $data)) {
                session()->setFlashdata('success', 'AC cooling tower data has been deleted');
                return redirect()->to('/accoolingtower');
            }
            else {
                session()->setFlashdata('warning', 'Fail to delete AC cooling tower data');
                return redirect()->to('/accoolingtower');
            }
        }
    }

    public function acahu() {
        $data['url'] = $this->request->uri->getSegment(1);
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data['title'] = 'AC AHU | B.M Apps &copy; Gramedia ' . date('Y');
            $data['isLoggedIn'] = session()->get('isLoggedIn');
            $data['id'] = session()->get('id');
            $data['username'] = session()->get('username');
            $data['name'] = session()->get('name');
            $data['email'] = session()->get('email');
            $data['image'] = session()->get('image');
            $data['is_active'] = session()->get('is_active');
            $data['role_id'] = session()->get('role_id');
            $data['roleuser'] = session()->get('roleuser');
            $data['superior_role_id'] = session()->get('superior_role_id');
            $data['idstore'] = session()->get('idstore');
            $data['location'] = session()->get('location');
            $data['level'] = session()->get('level');
            $data['status_deleted'] = session()->get('status_deleted');

            $data['getStoreEquipmentByStore'] = $this->mEquipment->getStoreEquipmentByStore(session()->get('idstore'));
            $data['getStoreEquipmentByStoreEquipment'] = $this->mEquipment->getStoreEquipmentByStoreEquipment(session()->get('idstore'), 10);

            $data['getAcAhuByStore'] = $this->mAcahu->getAcAhuByStore(session()->get('idstore'));
            $data['getAcAhuByStoreDate'] = $this->mAcahu->getAcAhuByStoreDate(session()->get('idstore'));

            $data['validation'] = \Config\Services::validation();

            if($data['getStoreEquipmentByStoreEquipment']) {
                return view('vAcahu', $data);
            }
            else {
                return redirect()->to('/storeEquipment');
            }
        }
    }

    public function saveAcAhu() {
        session();

        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'time' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Time'
                ],
                'ahu' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'AHU'
                ],
                'pres_in' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Water Pressure: In'
                ],
                'pres_out' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Water Pressure: Out'
                ],
                'temp_in' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Water Temp.: In'
                ],
                'temp_out' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Water Temp.: Out'
                ],
                'action' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Action'
                ]
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/acahu')->withInput()->with('validation', $validation);
            }

            $data['url'] = $this->request->uri->getSegment(1);
            $data = [
                'location' => $this->request->getPost('location'),
                'date' => $this->request->getPost('date'),
                'time' => $this->request->getPost('time'),
                'worker' => $this->request->getPost('worker'),
                'ahu' => $this->request->getPost('ahu'),
                'pres_in' => $this->request->getPost('pres_in'),
                'pres_out' => $this->request->getPost('pres_out'),
                'temp_in' => $this->request->getPost('temp_in'),
                'temp_out' => $this->request->getPost('temp_out'),
                'action' => $this->request->getPost('action'),
                'date_created' => time(),
                'date_updated' => time()
            ];

            if($this->mAcahu->insert($data)) {
                session()->setFlashdata('success', 'AC AHU data has been added');
                return redirect()->to('/acahu');
            }
            else {
                session()->setFlashdata('error', 'Fail to add AC AHU data');
                return redirect()->to('/acahu');
            }
        }
    }

    public function updateAcAhu($id) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'edittime' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Time'
                ],
                'editahu' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'AHU'
                ],
                'editpresin' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Water Pressure: In'
                ],
                'editpresout' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Water Pressure: Out'
                ],
                'edittempin' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Water Temp.: In'
                ],
                'edittempout' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Water Temp.: Out'
                ],
                'editaction' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Action'
                ]
            ])) {
                $validation = \Config\Services::validation();
                session()->setFlashdata('error', 'Fail to update AC AHU data, input invalid');
                return redirect()->to('/acahu')->withInput()->with('validation', $validation);
            }

            $data = [
                'time' => $this->request->getVar('edittime'),
                'worker' => $this->request->getVar('editworker'),
                'ahu' => $this->request->getVar('editahu'),
                'pres_in' => $this->request->getVar('editpresin'),
                'pres_out' => $this->request->getVar('editpresout'),
                'temp_in' => $this->request->getVar('edittempin'),
                'temp_out' => $this->request->getVar('edittempout'),
                'action' => $this->request->getVar('editaction'),
                'date_updated' => time()
            ];

            if($this->mAcahu->update($idUrl, $data)) {
                session()->setFlashdata('success', 'AC AHU data has been updated');
                return redirect()->to('/acahu');
            }
            else {
                session()->setFlashdata('error', 'Fail to update AC AHU data');
                return redirect()->to('/acahu');
            }
        }
    }

    public function deleteAcAhu($id = 0) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data = [
                'date_updated' => time(),
                'status_deleted' => 1
            ];

            if($this->mAcahu->update($idUrl, $data)) {
                session()->setFlashdata('success', 'AC AHU data has been deleted');
                return redirect()->to('/acahu');
            }
            else {
                session()->setFlashdata('warning', 'Fail to delete AC AHU data');
                return redirect()->to('/acahu');
            }
        }
    }

    public function acsplitwallduckcassettevrv() {
        $data['url'] = $this->request->uri->getSegment(1);

        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data['title'] = 'AC Splitwall, Duck, Cassette, VRV | B.M Apps &copy; Gramedia ' . date('Y');
            $data['isLoggedIn'] = session()->get('isLoggedIn');
            $data['id'] = session()->get('id');
            $data['username'] = session()->get('username');
            $data['name'] = session()->get('name');
            $data['email'] = session()->get('email');
            $data['image'] = session()->get('image');
            $data['is_active'] = session()->get('is_active');
            $data['role_id'] = session()->get('role_id');
            $data['roleuser'] = session()->get('roleuser');
            $data['superior_role_id'] = session()->get('superior_role_id');
            $data['idstore'] = session()->get('idstore');
            $data['location'] = session()->get('location');
            $data['level'] = session()->get('level');
            $data['status_deleted'] = session()->get('status_deleted');

            $data['getStoreEquipmentByStore'] = $this->mEquipment->getStoreEquipmentByStore(session()->get('idstore'));
            $data['getStoreEquipmentByStoreEquipment'] = $this->mEquipment->getStoreEquipmentByStoreEquipment(session()->get('idstore'), 11);

            $data['getAcSplitWallDuckCassetteVrvByStore'] = $this->mAcsplitwallduckcassettevrv->getAcSplitWallDuckCassetteVrvByStore(session()->get('idstore'));
            $data['getAcSplitWallDuckCassetteVrvByStoreDate'] = $this->mAcsplitwallduckcassettevrv->getAcSplitWallDuckCassetteVrvByStoreDate(session()->get('idstore'));

            $data['validation'] = \Config\Services::validation();

            if($data['getStoreEquipmentByStoreEquipment']) {
                return view('vAcsplitwallduckcassettevrv', $data);
            }
            else {
                return redirect()->to('/storeEquipment');
            }
        }
    }

    public function saveAcSplitWallDuckCassetteVrv() {
        session();

        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'date' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Date'
                ],
                'merk' => [
                    'rules' => 'required|max_length[20]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Merk'
                ],
                'type' => [
                    'rules' => 'required|max_length[20]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Type'
                ],
                'serial' => [
                    'rules' => 'required|max_length[20]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'No. Seri Outdoor'
                ],
                'room' => [
                    'rules' => 'required|max_length[30]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Ruang'
                ],
                'floor' => [
                    'rules' => 'required|max_length[2]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Lantai'
                ],
                'a_before' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Hasil Ukur Ampere: Sebelum'
                ],
                'a_after' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Hasil Ukur Ampere: Sesudah'
                ],
                'r22' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Refrigerant Suction Pressure: R22'
                ],
                'r32' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Refrigerant Suction Pressure: R32'
                ],
                'r410a' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Refrigerant Suction Pressure: R410A'
                ],
                'spare_part' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Spare Part'
                ],
                'description' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Keterangan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/acsplitwallduckcassettevrv')->withInput()->with('validation', $validation);
            }

            $data['url'] = $this->request->uri->getSegment(1);
            $data = [
                'location' => $this->request->getPost('location'),
                'date' => $this->request->getPost('date'),
                'worker' => $this->request->getPost('worker'),
                'merk' => $this->request->getPost('merk'),
                'type' => $this->request->getPost('type'),
                'serial' => $this->request->getPost('serial'),
                'room' => $this->request->getPost('room'),
                'floor' => $this->request->getPost('floor'),
                'a_before' => $this->request->getPost('a_before'),
                'a_after' => $this->request->getPost('a_after'),
                'r22' => $this->request->getPost('r22'),
                'r32' => $this->request->getPost('r32'),
                'r410a' => $this->request->getPost('r410a'),
                'action_filter' => ($this->request->getPost('action_filter')? 1 : 0),
                'action_evaporator' => ($this->request->getPost('action_evaporator')? 1 : 0),
                'action_condenser' => ($this->request->getPost('action_condenser')? 1 : 0),
                'action_cover' => ($this->request->getPost('action_cover')? 1 : 0),
                'action_drainage' => ($this->request->getPost('action_drainage')? 1 : 0),
                'spare_part' => $this->request->getPost('spare_part'),
                'description' => $this->request->getPost('description'),     
                'date_created' => time(),
                'date_updated' => time(),
                'status_deleted' => 0
            ];

            if($this->mAcsplitwallduckcassettevrv->insert($data)) {
                session()->setFlashdata('success', 'AC splitwall, duck, cassette, VRV data has been added');
                return redirect()->to('/acsplitwallduckcassettevrv');
            }
            else {
                session()->setFlashdata('error', 'Fail to add AC splitwall, duck, cassette, VRV data');
                return redirect()->to('/acsplitwallduckcassettevrv');
            }
        }
    }

    public function updateAcSplitWallDuckCassetteVrv($id) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'editmerk' => [
                    'rules' => 'required|max_length[20]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Merk'
                ],
                'edittype' => [
                    'rules' => 'required|max_length[20]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Type'
                ],
                'editserial' => [
                    'rules' => 'required|max_length[20]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'No. Seri Outdoor'
                ],
                'editroom' => [
                    'rules' => 'required|max_length[30]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Ruang'
                ],
                'editfloor' => [
                    'rules' => 'required|max_length[2]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Lantai'
                ],
                'editabefore' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Hasil Ukur Ampere: Sebelum'
                ],
                'editaafter' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Hasil Ukur Ampere: Sesudah'
                ],
                'editr22' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Refrigerant Suction Pressure: R22'
                ],
                'editr32' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Refrigerant Suction Pressure: R32'
                ],
                'editr410a' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Refrigerant Suction Pressure: R410A'
                ],
                'editsparepart' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Spare Part'
                ],
                'editdescription' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Keterangan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                session()->setFlashdata('error', 'Fail to update AC split wall, duck, cassette, VRV data, input invalid');
                return redirect()->to('/acsplitwallduckcassettevrv')->withInput()->with('validation', $validation);
            }

            $data = [
                'worker' => $this->request->getVar('editworker'),
                'merk' => $this->request->getVar('editmerk'),
                'type' => $this->request->getVar('edittype'),
                'serial' => $this->request->getVar('editserial'),
                'room' => $this->request->getVar('editroom'),
                'floor' => $this->request->getVar('editfloor'),
                'a_before' => $this->request->getVar('editabefore'),
                'a_after' => $this->request->getVar('editaafter'),
                'r22' => $this->request->getVar('editr22'),
                'r32' => $this->request->getVar('editr32'),
                'r410a' => $this->request->getVar('editr410a'),
                'action_filter' => ($this->request->getVar('editactionfilter')? 1 : 0),
                'action_evaporator' => ($this->request->getVar('editactionevaporator')? 1 : 0),
                'action_condenser' => ($this->request->getVar('editactioncondenser')? 1 : 0),
                'action_cover' => ($this->request->getVar('editactioncover')? 1 : 0),
                'action_drainage' => ($this->request->getVar('editactiondrainage')? 1 : 0),
                'spare_part' => $this->request->getVar('editsparepart'),
                'description' => $this->request->getVar('editdescription'),
                'date_updated' => time()
            ];

            if($this->mAcsplitwallduckcassettevrv->update($idUrl, $data)) {
                session()->setFlashdata('success', 'AC splitwall, duck, cassette, VRV data has been updated');
                return redirect()->to('/acsplitwallduckcassettevrv');
            }
            else {
                session()->setFlashdata('error', 'Fail to update AC splitwall, duck, cassette, VRV data');
                return redirect()->to('/acsplitwallduckcassettevrv');
            }
        }
    }

    public function deleteAcSplitWallDuckCassetteVrv($id = 0) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data = [
                'date_updated' => time(),
                'status_deleted' => 1
            ];

            if($this->mAcsplitwallduckcassettevrv->update($idUrl, $data)) {
                session()->setFlashdata('success', 'AC splitwall, duck, cassette, VRV data has been deleted');
                return redirect()->to('/acsplitwallduckcassettevrv');
            }
            else {
                session()->setFlashdata('warning', 'Fail to delete AC splitwall, duck, cassette, VRV data');
                return redirect()->to('/acsplitwallduckcassettevrv');
            }
        }
    }

    public function temperature() {
        $data['url'] = $this->request->uri->getSegment(1);

        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data['title'] = 'Suhu | B.M Apps &copy; Gramedia ' . date('Y');
            $data['isLoggedIn'] = session()->get('isLoggedIn');
            $data['id'] = session()->get('id');
            $data['username'] = session()->get('username');
            $data['name'] = session()->get('name');
            $data['email'] = session()->get('email');
            $data['image'] = session()->get('image');
            $data['is_active'] = session()->get('is_active');
            $data['role_id'] = session()->get('role_id');
            $data['roleuser'] = session()->get('roleuser');
            $data['superior_role_id'] = session()->get('superior_role_id');
            $data['idstore'] = session()->get('idstore');
            $data['location'] = session()->get('location');
            $data['level'] = session()->get('level');
            $data['status_deleted'] = session()->get('status_deleted');

            $data['getStoreEquipmentByStore'] = $this->mEquipment->getStoreEquipmentByStore(session()->get('idstore'));
            $data['getStoreEquipmentByStoreEquipment'] = $this->mEquipment->getStoreEquipmentByStoreEquipment(session()->get('idstore'), 12);

            $data['getTemperatureByStore'] = $this->mTemperature->getTemperatureByStore(session()->get('idstore'));
            $data['getTemperatureByStoreDate'] = $this->mTemperature->getTemperatureByStoreDate(session()->get('idstore'));

            $data['validation'] = \Config\Services::validation();

            if($data['getStoreEquipmentByStoreEquipment']) {
                return view('vTemperature', $data);
            }
            else {
                return redirect()->to('/storeEquipment');
            }
        }
    }

    public function saveTemperature() {
        session();

        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'time' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Time'
                ],
                'area' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Area'
                ],
                'zone_1' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Zone 1'
                ],
                'zone_2' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Zone 2'
                ],
                'zone_3' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Zone 3'
                ],
                'zone_4' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Zone 4'
                ],
                'discovery' => [
                    'rules' => 'required|integer|max_length[3]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'integer' => '{field} must be an integer',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Jumlah Temuan'
                ],
                'description' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Penjelasan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/temperature')->withInput()->with('validation', $validation);
            }

            $data['url'] = $this->request->uri->getSegment(1);
            $data = [
                'location' => $this->request->getPost('location'),
                'date' => $this->request->getPost('date'),
                'time' => $this->request->getPost('time'),
                'worker' => $this->request->getPost('worker'),
                'area' => $this->request->getPost('area'),
                'zone_1' => $this->request->getPost('zone_1'),
                'zone_2' => $this->request->getPost('zone_2'),
                'zone_3' => $this->request->getPost('zone_3'),
                'zone_4' => $this->request->getPost('zone_4'),
                'discovery' => $this->request->getPost('discovery'),
                'description' => $this->request->getPost('description'),
                'date_created' => time(),
                'date_updated' => time(),
                'status_deleted' => 0
            ];

            if($this->mTemperature->insert($data)) {
                session()->setFlashdata('success', 'Temperature data has been added');
                return redirect()->to('/temperature');
            }
            else {
                session()->setFlashdata('error', 'Fail to add temperature data');
                return redirect()->to('/temperature');
            }
        }
    }

    public function updateTemperature($id) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'editarea' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Area'
                ],
                'editzone1' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Zone 1'
                ],
                'editzone2' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Zone 2'
                ],
                'editzone3' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Zone 3'
                ],
                'editzone4' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Zone 4'
                ],
                'editdiscovery' => [
                    'rules' => 'required|integer|max_length[3]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'integer' => '{field} must be an integer',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Jumlah Temuan'
                ],
                'editdescription' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Penjelasan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                session()->setFlashdata('error', 'Fail to update temperature data, input invalid');
                return redirect()->to('/temperature')->withInput()->with('validation', $validation);
            }

            $data = [
                'worker' => $this->request->getVar('editworker'),
                'area' => $this->request->getVar('editarea'),
                'zone_1' => $this->request->getVar('editzone1'),
                'zone_2' => $this->request->getVar('editzone2'),
                'zone_3' => $this->request->getVar('editzone3'),
                'zone_4' => $this->request->getVar('editzone4'),
                'discovery' => $this->request->getVar('editdiscovery'),
                'description' => $this->request->getVar('editdescription'),
                'date_updated' => time()
            ];

            if($this->mTemperature->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Temperature data has been updated');
                return redirect()->to('/temperature');
            }
            else {
                session()->setFlashdata('error', 'Fail to update temperature data');
                return redirect()->to('/temperature');
            }
        }
    }

    public function deleteTemperature($id = 0) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data = [
                'date_updated' => time(),
                'status_deleted' => 1
            ];

            if($this->mTemperature->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Temperature data has been deleted');
                return redirect()->to('/temperature');
            }
            else {
                session()->setFlashdata('warning', 'Fail to delete temperature data');
                return redirect()->to('/temperature');
            }
        }
    }

    public function lighting() {
        $data['url'] = $this->request->uri->getSegment(1);

        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data['title'] = 'Suhu | B.M Apps &copy; Gramedia ' . date('Y');
            $data['isLoggedIn'] = session()->get('isLoggedIn');
            $data['id'] = session()->get('id');
            $data['username'] = session()->get('username');
            $data['name'] = session()->get('name');
            $data['email'] = session()->get('email');
            $data['image'] = session()->get('image');
            $data['is_active'] = session()->get('is_active');
            $data['role_id'] = session()->get('role_id');
            $data['roleuser'] = session()->get('roleuser');
            $data['superior_role_id'] = session()->get('superior_role_id');
            $data['idstore'] = session()->get('idstore');
            $data['location'] = session()->get('location');
            $data['level'] = session()->get('level');
            $data['status_deleted'] = session()->get('status_deleted');

            $data['getStoreEquipmentByStore'] = $this->mEquipment->getStoreEquipmentByStore(session()->get('idstore'));
            $data['getStoreEquipmentByStoreEquipment'] = $this->mEquipment->getStoreEquipmentByStoreEquipment(session()->get('idstore'), 13);

            $data['getLightingByStore'] = $this->mLighting->getLightingByStore(session()->get('idstore'));
            $data['getLightingByStoreDate'] = $this->mLighting->getLightingByStoreDate(session()->get('idstore'));

            $data['validation'] = \Config\Services::validation();

            if($data['getStoreEquipmentByStoreEquipment']) {
                return view('vLighting', $data);
            }
            else {
                return redirect()->to('/storeEquipment');
            }
        }
    }

    public function saveLighting() {
        session();

        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'date' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Date'
                ],
                'area' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Area'
                ],
                'zone_1' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Zone 1'
                ],
                'zone_2' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Zone 2'
                ],
                'zone_3' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Zone 3'
                ],
                'zone_4' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Zone 4'
                ],
                'discovery' => [
                    'rules' => 'required|integer|max_length[3]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'integer' => '{field} must be an integer',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Jumlah Temuan'
                ],
                'description' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Penjelasan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/lighting')->withInput()->with('validation', $validation);
            }

            $data['url'] = $this->request->uri->getSegment(1);
            $data = [
                'location' => $this->request->getPost('location'),
                'date' => $this->request->getPost('date'),
                'worker' => $this->request->getPost('worker'),
                'area' => $this->request->getPost('area'),
                'zone_1' => $this->request->getPost('zone_1'),
                'zone_2' => $this->request->getPost('zone_2'),
                'zone_3' => $this->request->getPost('zone_3'),
                'zone_4' => $this->request->getPost('zone_4'),
                'discovery' => $this->request->getPost('discovery'),
                'description' => $this->request->getPost('description'),
                'date_created' => time(),
                'date_updated' => time(),
                'status_deleted' => 0
            ];

            if($this->mLighting->insert($data)) {
                session()->setFlashdata('success', 'Lighting data has been added');
                return redirect()->to('/lighting');
            }
            else {
                session()->setFlashdata('error', 'Fail to add lighting data');
                return redirect()->to('/lighting');
            }
        }
    }

    public function updateLighting($id) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'editarea' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Area'
                ],
                'editzone1' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Zone 1'
                ],
                'editzone2' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Zone 2'
                ],
                'editzone3' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Zone 3'
                ],
                'editzone4' => [
                    'rules' => 'required|numeric|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'numeric' => '{field} must be numeric',
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Zone 4'
                ],
                'editdiscovery' => [
                    'rules' => 'required|integer|max_length[3]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'integer' => '{field} must be an integer',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Jumlah Temuan'
                ],
                'editdescription' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Penjelasan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                session()->setFlashdata('error', 'Fail to update lighting data, input invalid');
                return redirect()->to('/lighting')->withInput()->with('validation', $validation);
            }

            $data = [
                'worker' => $this->request->getVar('editworker'),
                'area' => $this->request->getVar('editarea'),
                'zone_1' => $this->request->getVar('editzone1'),
                'zone_2' => $this->request->getVar('editzone2'),
                'zone_3' => $this->request->getVar('editzone3'),
                'zone_4' => $this->request->getVar('editzone4'),
                'discovery' => $this->request->getVar('editdiscovery'),
                'description' => $this->request->getVar('editdescription'),
                'date_updated' => time()
            ];

            if($this->mLighting->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Lighting data has been updated');
                return redirect()->to('/lighting');
            }
            else {
                session()->setFlashdata('error', 'Fail to update lighting data');
                return redirect()->to('/lighting');
            }
        }
    }

    public function deleteLighting($id = 0) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data = [
                'date_updated' => time(),
                'status_deleted' => 1
            ];

            if($this->mLighting->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Lighting data has been deleted');
                return redirect()->to('/lighting');
            }
            else {
                session()->setFlashdata('warning', 'Fail to delete lighting data');
                return redirect()->to('/lighting');
            }
        }
    }

    public function escalator() {
        $data['url'] = $this->request->uri->getSegment(1);

        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data['title'] = 'Escalator | B.M Apps &copy; Gramedia ' . date('Y');
            $data['isLoggedIn'] = session()->get('isLoggedIn');
            $data['id'] = session()->get('id');
            $data['username'] = session()->get('username');
            $data['name'] = session()->get('name');
            $data['email'] = session()->get('email');
            $data['image'] = session()->get('image');
            $data['is_active'] = session()->get('is_active');
            $data['role_id'] = session()->get('role_id');
            $data['roleuser'] = session()->get('roleuser');
            $data['superior_role_id'] = session()->get('superior_role_id');
            $data['idstore'] = session()->get('idstore');
            $data['location'] = session()->get('location');
            $data['level'] = session()->get('level');
            $data['status_deleted'] = session()->get('status_deleted');

            $data['getStoreEquipmentByStore'] = $this->mEquipment->getStoreEquipmentByStore(session()->get('idstore'));
            $data['getStoreEquipmentByStoreEquipment'] = $this->mEquipment->getStoreEquipmentByStoreEquipment(session()->get('idstore'), 14);

            $data['getEscalatorByStore'] = $this->mEscalator->getEscalatorByStore(session()->get('idstore'));
            $data['getEscalatorByStoreDate'] = $this->mEscalator->getEscalatorByStoreDate(session()->get('idstore'));

            $data['validation'] = \Config\Services::validation();

            if($data['getStoreEquipmentByStoreEquipment']) {
                return view('vEscalator', $data);
            }
            else {
                return redirect()->to('/storeEquipment');
            }
        }
    }

    public function saveEscalator() {
        session();

        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'time' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Time'
                ],
                'name' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Escalator Name'
                ],
                'motor' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Part: Motor'
                ],
                'vsd' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Part: Econo/VSD'
                ],
                'rail' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Part: Hand Rail'
                ],
                'censor' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Part: Sensor Gerak'
                ],
                'guard' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Part: Skirt Guard'
                ],
                'step' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Part: Comb Step'
                ],
                'noise' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Inspeksi: Noise'
                ],
                'temperature' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Inspeksi: Temperature'
                ],
                'vibration' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Inspeksi: Vibrasi'
                ],
                'description' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Keterangan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/escalator')->withInput()->with('validation', $validation);
            }

            $data['url'] = $this->request->uri->getSegment(1);
            $data = [
                'location' => $this->request->getPost('location'),
                'date' => $this->request->getPost('date'),
                'time' => $this->request->getPost('time'),
                'worker' => $this->request->getPost('worker'),
                'name' => $this->request->getPost('name'),
                'motor' => $this->request->getPost('motor'),
                'vsd' => $this->request->getPost('vsd'),
                'rail' => $this->request->getPost('rail'),
                'censor' => $this->request->getPost('censor'),
                'guard' => $this->request->getPost('guard'),
                'step' => $this->request->getPost('step'),
                'noise' => $this->request->getPost('noise'),
                'temperature' => $this->request->getPost('temperature'),
                'vibration' => $this->request->getPost('vibration'),
                'description' => $this->request->getPost('description'),     
                'date_created' => time(),
                'date_updated' => time(),
                'status_deleted' => 0
            ];

            if($this->mEscalator->insert($data)) {
                session()->setFlashdata('success', 'Escalator data has been added');
                return redirect()->to('/escalator');
            }
            else {
                session()->setFlashdata('error', 'Fail to add escalator data');
                return redirect()->to('/escalator');
            }
        }
    }

    public function updateEscalator($id) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'editname' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Escalator Name'
                ],
                'editmotor' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Part: Motor'
                ],
                'editvsd' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Part: Econo/VSD'
                ],
                'editrail' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Part: Hand Rail'
                ],
                'editcensor' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Part: Sensor Gerak'
                ],
                'editguard' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Part: Skirt Guard'
                ],
                'editstep' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Part: Comb Step'
                ],
                'editnoise' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Inspeksi: Noise'
                ],
                'edittemperature' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Inspeksi: Temperature'
                ],
                'editvibration' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Inspeksi: Vibrasi'
                ],
                'editdescription' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Keterangan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                session()->setFlashdata('error', 'Fail to update escalator data, input invalid');
                return redirect()->to('/escalator')->withInput()->with('validation', $validation);
            }

            $data = [
                'worker' => $this->request->getVar('editworker'),
                'name' => $this->request->getVar('editname'),
                'motor' => $this->request->getVar('editmotor'),
                'vsd' => $this->request->getVar('editvsd'),
                'rail' => $this->request->getVar('editrail'),
                'censor' => $this->request->getVar('editcensor'),
                'guard' => $this->request->getVar('editguard'),
                'step' => $this->request->getVar('editstep'),
                'noise' => $this->request->getVar('editnoise'),
                'temperature' => $this->request->getVar('edittemperature'),
                'vibration' => $this->request->getVar('editvibration'),
                'description' => $this->request->getVar('editdescription'),
                'date_updated' => time()
            ];

            if($this->mEscalator->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Escalator data has been updated');
                return redirect()->to('/escalator');
            }
            else {
                session()->setFlashdata('error', 'Fail to update escalator data');
                return redirect()->to('/escalator');
            }
        }
    }

    public function deleteEscalator($id = 0) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data = [
                'date_updated' => time(),
                'status_deleted' => 1
            ];

            if($this->mEscalator->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Escalator data has been deleted');
                return redirect()->to('/escalator');
            }
            else {
                session()->setFlashdata('warning', 'Fail to delete escalator data');
                return redirect()->to('/escalator');
            }
        }
    }

    public function elevator() {
        $data['url'] = $this->request->uri->getSegment(1);

        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data['title'] = 'Elevator | B.M Apps &copy; Gramedia ' . date('Y');
            $data['isLoggedIn'] = session()->get('isLoggedIn');
            $data['id'] = session()->get('id');
            $data['username'] = session()->get('username');
            $data['name'] = session()->get('name');
            $data['email'] = session()->get('email');
            $data['image'] = session()->get('image');
            $data['is_active'] = session()->get('is_active');
            $data['role_id'] = session()->get('role_id');
            $data['roleuser'] = session()->get('roleuser');
            $data['superior_role_id'] = session()->get('superior_role_id');
            $data['idstore'] = session()->get('idstore');
            $data['location'] = session()->get('location');
            $data['level'] = session()->get('level');
            $data['status_deleted'] = session()->get('status_deleted');

            $data['getStoreEquipmentByStore'] = $this->mEquipment->getStoreEquipmentByStore(session()->get('idstore'));
            $data['getStoreEquipmentByStoreEquipment'] = $this->mEquipment->getStoreEquipmentByStoreEquipment(session()->get('idstore'), 15);

            $data['getElevatorByStore'] = $this->mElevator->getElevatorByStore(session()->get('idstore'));
            $data['getElevatorByStoreDate'] = $this->mElevator->getElevatorByStoreDate(session()->get('idstore'));

            $data['validation'] = \Config\Services::validation();

            if($data['getStoreEquipmentByStoreEquipment']) {
                return view('vElevator', $data);
            }
            else {
                return redirect()->to('/storeEquipment');
            }
        }
    }

    public function saveElevator() {
        session();

        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'time' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Time'
                ],
                'name' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Elevator/Lift Name'
                ],
                'ard' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Report: ARD'
                ],
                'motor' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Report: Motor'
                ],
                'rope' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Report: Wire Rope'
                ],
                'vsd' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Report: Acono/VSD'
                ],
                'door' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Report: Pintu'
                ],
                'censor' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Report: Sensor Pintu'
                ],
                'interphone' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Report: Interphone'
                ],
                'button' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Report: Tombol'
                ],
                'noise' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Inspeksi: Noise'
                ],
                'temperature' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Inspeksi: Temperature'
                ],
                'vibration' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Inspeksi: Vibrasi'
                ],
                'description' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Keterangan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/elevator')->withInput()->with('validation', $validation);
            }

            $data['url'] = $this->request->uri->getSegment(1);
            $data = [
                'location' => $this->request->getPost('location'),
                'date' => $this->request->getPost('date'),
                'time' => $this->request->getPost('time'),
                'worker' => $this->request->getPost('worker'),
                'name' => $this->request->getPost('name'),
                'ard' => $this->request->getPost('ard'),
                'motor' => $this->request->getPost('motor'),
                'rope' => $this->request->getPost('rope'),
                'vsd' => $this->request->getPost('vsd'),
                'door' => $this->request->getPost('door'),
                'censor' => $this->request->getPost('censor'),
                'interphone' => $this->request->getPost('interphone'),
                'button' => $this->request->getPost('button'),
                'noise' => $this->request->getPost('noise'),
                'temperature' => $this->request->getPost('temperature'),
                'vibration' => $this->request->getPost('vibration'),
                'description' => $this->request->getPost('description'),     
                'date_created' => time(),
                'date_updated' => time(),
                'status_deleted' => 0
            ];

            if($this->mElevator->insert($data)) {
                session()->setFlashdata('success', 'Elevator data has been added');
                return redirect()->to('/elevator');
            }
            else {
                session()->setFlashdata('error', 'Fail to add elevator data');
                return redirect()->to('/elevator');
            }
        }
    }

    public function updateElevator($id) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'editname' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Elevator/Lift Name'
                ],
                'editard' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Report: ARD'
                ],
                'editmotor' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Report: Motor'
                ],
                'editrope' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Report: Wire Rope'
                ],
                'editvsd' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Report: Acono/VSD'
                ],
                'editdoor' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Report: Pintu'
                ],
                'editcensor' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Report: Sensor Pintu'
                ],
                'editinterphone' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Report: Interphone'
                ],
                'editbutton' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Report: Tombol'
                ],
                'editnoise' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Inspeksi: Noise'
                ],
                'edittemperature' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Inspeksi: Temperature'
                ],
                'editvibration' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Inspeksi: Vibrasi'
                ],
                'editdescription' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Keterangan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                session()->setFlashdata('error', 'Fail to update elevator data, input invalid');
                return redirect()->to('/elevator')->withInput()->with('validation', $validation);
            }

            $data = [
                'worker' => $this->request->getVar('editworker'),
                'name' => $this->request->getVar('editname'),
                'ard' => $this->request->getVar('editard'),
                'motor' => $this->request->getVar('editmotor'),
                'rope' => $this->request->getVar('editrope'),
                'vsd' => $this->request->getVar('editvsd'),
                'door' => $this->request->getVar('editdoor'),
                'censor' => $this->request->getVar('editcensor'),
                'interphone' => $this->request->getVar('editinterphone'),
                'button' => $this->request->getVar('editbutton'),
                'noise' => $this->request->getVar('editnoise'),
                'temperature' => $this->request->getVar('edittemperature'),
                'vibration' => $this->request->getVar('editvibration'),
                'description' => $this->request->getVar('editdescription'),
                'date_updated' => time()
            ];

            if($this->mElevator->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Elevator data has been updated');
                return redirect()->to('/elevator');
            }
            else {
                session()->setFlashdata('error', 'Fail to update elevator data');
                return redirect()->to('/elevator');
            }
        }
    }

    public function deleteElevator($id = 0) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data = [
                'date_updated' => time(),
                'status_deleted' => 1
            ];

            if($this->mElevator->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Elevator data has been deleted');
                return redirect()->to('/elevator');
            }
            else {
                session()->setFlashdata('warning', 'Fail to delete elevator data');
                return redirect()->to('/elevator');
            }
        }
    }

    public function dumbwaiter() {
        $data['url'] = $this->request->uri->getSegment(1);

        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data['title'] = 'Dumbwaiter | B.M Apps &copy; Gramedia ' . date('Y');
            $data['isLoggedIn'] = session()->get('isLoggedIn');
            $data['id'] = session()->get('id');
            $data['username'] = session()->get('username');
            $data['name'] = session()->get('name');
            $data['email'] = session()->get('email');
            $data['image'] = session()->get('image');
            $data['is_active'] = session()->get('is_active');
            $data['role_id'] = session()->get('role_id');
            $data['roleuser'] = session()->get('roleuser');
            $data['superior_role_id'] = session()->get('superior_role_id');
            $data['idstore'] = session()->get('idstore');
            $data['location'] = session()->get('location');
            $data['level'] = session()->get('level');
            $data['status_deleted'] = session()->get('status_deleted');

            $data['getStoreEquipmentByStore'] = $this->mEquipment->getStoreEquipmentByStore(session()->get('idstore'));
            $data['getStoreEquipmentByStoreEquipment'] = $this->mEquipment->getStoreEquipmentByStoreEquipment(session()->get('idstore'), 16);

            $data['getDumbwaiterByStore'] = $this->mDumbwaiter->getDumbwaiterByStore(session()->get('idstore'));
            $data['getDumbwaiterByStoreDate'] = $this->mDumbwaiter->getDumbwaiterByStoreDate(session()->get('idstore'));

            $data['validation'] = \Config\Services::validation();

            if($data['getStoreEquipmentByStoreEquipment']) {
                return view('vDumbwaiter', $data);
            }
            else {
                return redirect()->to('/storeEquipment');
            }
        }
    }

    public function saveDumbwaiter() {
        session();

        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'time' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Time'
                ],
                'stop' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Dumbwaiter: Emergency Stop'
                ],
                'motor' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Dumbwaiter: Motor'
                ],
                'vsd' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Dumbwaiter: Econo/VSD'
                ],
                'door' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Dumbwaiter: Pintu'
                ],
                'switch' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Dumbwaiter: Safety Switch'
                ],
                'brake' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Dumbwaiter: Brake'
                ],
                'button' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Dumbwaiter: Tombol'
                ],
                'intercom' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Dumbwaiter: Intercom'
                ],
                'noise' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Inspeksi: Noise'
                ],
                'temperature' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Inspeksi: Temperature'
                ],
                'vibration' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Inspeksi: Vibrasi'
                ],
                'description' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Keterangan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/dumbwaiter')->withInput()->with('validation', $validation);
            }

            $data['url'] = $this->request->uri->getSegment(1);
            $data = [
                'location' => $this->request->getPost('location'),
                'date' => $this->request->getPost('date'),
                'time' => $this->request->getPost('time'),
                'worker' => $this->request->getPost('worker'),
                'stop' => $this->request->getPost('stop'),
                'motor' => $this->request->getPost('motor'),
                'vsd' => $this->request->getPost('vsd'),
                'door' => $this->request->getPost('door'),
                'switch' => $this->request->getPost('switch'),
                'brake' => $this->request->getPost('brake'),
                'button' => $this->request->getPost('button'),
                'intercom' => $this->request->getPost('intercom'),
                'noise' => $this->request->getPost('noise'),
                'temperature' => $this->request->getPost('temperature'),
                'vibration' => $this->request->getPost('vibration'),
                'description' => $this->request->getPost('description'),     
                'date_created' => time(),
                'date_updated' => time(),
                'status_deleted' => 0
            ];

            if($this->mDumbwaiter->insert($data)) {
                session()->setFlashdata('success', 'Dumbwaiter data has been added');
                return redirect()->to('/dumbwaiter');
            }
            else {
                session()->setFlashdata('error', 'Fail to add dumbwaiter data');
                return redirect()->to('/dumbwaiter');
            }
        }
    }

    public function updateDumbwaiter($id) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'editstop' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Dumbwaiter: Emergency Stop'
                ],
                'editmotor' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Dumbwaiter: Motor'
                ],
                'editvsd' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Dumbwaiter: Econo/VSD'
                ],
                'editdoor' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Dumbwaiter: Pintu'
                ],
                'editswitch' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Dumbwaiter: Safety Switch'
                ],
                'editbrake' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Dumbwaiter: Brake'
                ],
                'editbutton' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Dumbwaiter: Tombol'
                ],
                'editintercom' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Dumbwaiter: Intercom'
                ],
                'editnoise' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Inspeksi: Noise'
                ],
                'edittemperature' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Inspeksi: Temperature'
                ],
                'editvibration' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Inspeksi: Vibrasi'
                ],
                'editdescription' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Keterangan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                session()->setFlashdata('error', 'Fail to update dumbwaiter data, input invalid');
                return redirect()->to('/dumbwaiter')->withInput()->with('validation', $validation);
            }

            $data = [
                'worker' => $this->request->getVar('editworker'),
                'name' => $this->request->getVar('editname'),
                'stop' => $this->request->getVar('editstop'),
                'motor' => $this->request->getVar('editmotor'),
                'vsd' => $this->request->getVar('editvsd'),
                'door' => $this->request->getVar('editdoor'),
                'switch' => $this->request->getVar('editswitch'),
                'brake' => $this->request->getVar('editbrake'),
                'button' => $this->request->getVar('editbutton'),
                'intercom' => $this->request->getVar('editintercom'),
                'noise' => $this->request->getVar('editnoise'),
                'temperature' => $this->request->getVar('edittemperature'),
                'vibration' => $this->request->getVar('editvibration'),
                'description' => $this->request->getVar('editdescription'),
                'date_updated' => time()
            ];

            if($this->mDumbwaiter->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Dumbwaiter data has been updated');
                return redirect()->to('/dumbwaiter');
            }
            else {
                session()->setFlashdata('error', 'Fail to update dumbwaiter data');
                return redirect()->to('/dumbwaiter');
            }
        }
    }

    public function deleteDumbwaiter($id = 0) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data = [
                'date_updated' => time(),
                'status_deleted' => 1
            ];

            if($this->mDumbwaiter->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Dumbwaiter data has been deleted');
                return redirect()->to('/dumbwaiter');
            }
            else {
                session()->setFlashdata('warning', 'Fail to delete dumbwaiter data');
                return redirect()->to('/dumbwaiter');
            }
        }
    }

    public function sanitary() {
        $data['url'] = $this->request->uri->getSegment(1);

        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data['title'] = 'Sanitary | B.M Apps &copy; Gramedia ' . date('Y');
            $data['isLoggedIn'] = session()->get('isLoggedIn');
            $data['id'] = session()->get('id');
            $data['username'] = session()->get('username');
            $data['name'] = session()->get('name');
            $data['email'] = session()->get('email');
            $data['image'] = session()->get('image');
            $data['is_active'] = session()->get('is_active');
            $data['role_id'] = session()->get('role_id');
            $data['roleuser'] = session()->get('roleuser');
            $data['superior_role_id'] = session()->get('superior_role_id');
            $data['idstore'] = session()->get('idstore');
            $data['location'] = session()->get('location');
            $data['level'] = session()->get('level');
            $data['status_deleted'] = session()->get('status_deleted');

            $data['getStoreEquipmentByStore'] = $this->mEquipment->getStoreEquipmentByStore(session()->get('idstore'));
            $data['getStoreEquipmentByStoreEquipment'] = $this->mEquipment->getStoreEquipmentByStoreEquipment(session()->get('idstore'), 17);

            $data['getSanitaryByStore'] = $this->mSanitary->getSanitaryByStore(session()->get('idstore'));
            $data['getSanitaryByStoreDate'] = $this->mSanitary->getSanitaryByStoreDate(session()->get('idstore'));

            $data['validation'] = \Config\Services::validation();

            if($data['getStoreEquipmentByStoreEquipment']) {
                return view('vSanitary', $data);
            }
            else {
                return redirect()->to('/storeEquipment');
            }
        }
    }

    public function saveSanitary() {
        session();

        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'time' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Time'
                ],
                'floor' => [
                    'rules' => 'required|max_length[2]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Lantai'
                ],
                'room' => [
                    'rules' => 'required|max_length[30]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Ruang'
                ],
                'closet_instalation' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Toilet (Closet Duduk): Instalasi'
                ],
                'closet_washer' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Toilet (Closet Duduk): Jet Washer'
                ],
                'closet_float' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Toilet (Closet Duduk): Pelampung Closet'
                ],
                'closet_faucet' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Toilet (Closet Duduk): Kran Tembok'
                ],
                'urinoir_faucet' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Toilet (Urinoir): Kran Flush'
                ],
                'urinoir_instalation' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Toilet (Urinoir): Instalasi'
                ],
                'washtafel_faucet' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Washtafel: Kran Tembok'
                ],
                'washtafel_instalation' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Washtafel: Instalasi'
                ],
                'filtration' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Grease Trap: Filtrasi'
                ],
                'discovery' => [
                    'rules' => 'required|integer',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'integer' => '{field} must be an integer'
                    ],
                    'label' => 'Temuan'
                ],
                'description' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Keterangan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/sanitary')->withInput()->with('validation', $validation);
            }

            $data['url'] = $this->request->uri->getSegment(1);
            $data = [
                'location' => $this->request->getPost('location'),
                'date' => $this->request->getPost('date'),
                'time' => $this->request->getPost('time'),
                'worker' => $this->request->getPost('worker'),
                'floor' => $this->request->getPost('floor'),
                'room' => $this->request->getPost('room'),
                'closet_instalation' => $this->request->getPost('closet_instalation'),
                'closet_washer' => $this->request->getPost('closet_washer'),
                'closet_float' => $this->request->getPost('closet_float'),
                'closet_faucet' => $this->request->getPost('closet_faucet'),
                'urinoir_faucet' => $this->request->getPost('urinoir_faucet'),
                'urinoir_instalation' => $this->request->getPost('urinoir_instalation'),
                'washtafel_faucet' => $this->request->getPost('washtafel_faucet'),
                'washtafel_instalation' => $this->request->getPost('washtafel_instalation'),
                'filtration' => $this->request->getPost('filtration'),
                'discovery' => $this->request->getPost('discovery'),
                'description' => $this->request->getPost('description'),     
                'date_created' => time(),
                'date_updated' => time(),
                'status_deleted' => 0
            ];

            if($this->mSanitary->insert($data)) {
                session()->setFlashdata('success', 'Sanitary data has been added');
                return redirect()->to('/sanitary');
            }
            else {
                session()->setFlashdata('error', 'Fail to add sanitary data');
                return redirect()->to('/sanitary');
            }
        }
    }

    public function updateSanitary($id) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'editfloor' => [
                    'rules' => 'required|max_length[2]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Lantai'
                ],
                'editroom' => [
                    'rules' => 'required|max_length[30]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Ruang'
                ],
                'editclosetinstalation' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Toilet (Closet Duduk): Instalasi'
                ],
                'editclosetwasher' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Toilet (Closet Duduk): Jet Washer'
                ],
                'editclosetfloat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Toilet (Closet Duduk): Pelampung Closet'
                ],
                'editclosetfaucet' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Toilet (Closet Duduk): Kran Tembok'
                ],
                'editurinoirfaucet' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Toilet (Urinoir): Kran Flush'
                ],
                'editurinoirinstalation' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Toilet (Urinoir): Instalasi'
                ],
                'editwashtafelfaucet' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Washtafel: Kran Tembok'
                ],
                'editwashtafelinstalation' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Washtafel: Instalasi'
                ],
                'editfiltration' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Grease Trap: Filtrasi'
                ],
                'editdiscovery' => [
                    'rules' => 'required|integer',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'integer' => '{field} must be an integer'
                    ],
                    'label' => 'Temuan'
                ],
                'editdescription' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Keterangan'
                ]
            ])) {
                $validation = \Config\Services::validation();
                session()->setFlashdata('error', 'Fail to update sanitary data, input invalid');
                return redirect()->to('/sanitary')->withInput()->with('validation', $validation);
            }

            $data = [
                'worker' => $this->request->getVar('editworker'),
                'floor' => $this->request->getVar('editfloor'),
                'room' => $this->request->getVar('editroom'),
                'closet_instalation' => $this->request->getVar('editclosetinstalation'),
                'closet_washer' => $this->request->getVar('editclosetwasher'),
                'closet_float' => $this->request->getVar('editclosetfloat'),
                'closet_faucet' => $this->request->getVar('editclosetfaucet'),
                'urinoir_faucet' => $this->request->getVar('editurinoirfaucet'),
                'urinoir_instalation' => $this->request->getVar('editurinoirinstalation'),
                'washtafel_faucet' => $this->request->getVar('editwashtafelfaucet'),
                'washtafel_instalation' => $this->request->getVar('editwashtafelinstalation'),
                'filtration' => $this->request->getVar('editfiltration'),
                'discovery' => $this->request->getVar('editdiscovery'),
                'description' => $this->request->getVar('editdescription'),
                'date_updated' => time()
            ];

            if($this->mSanitary->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Sanitary data has been updated');
                return redirect()->to('/sanitary');
            }
            else {
                session()->setFlashdata('error', 'Fail to update sanitary data');
                return redirect()->to('/sanitary');
            }
        }
    }

    public function deleteSanitary($id = 0) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data = [
                'date_updated' => time(),
                'status_deleted' => 1
            ];

            if($this->mSanitary->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Sanitary data has been deleted');
                return redirect()->to('/sanitary');
            }
            else {
                session()->setFlashdata('warning', 'Fail to delete sanitary data');
                return redirect()->to('/sanitary');
            }
        }
    }
}
