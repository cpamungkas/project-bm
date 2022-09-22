<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MCctv;
use App\Models\MDindingPartisi;
use App\Models\MEquipment;
use App\Models\MFireFighting;
use App\Models\MFoldingGate;
use App\Models\MGasStation;
use App\Models\MGondola;
use App\Models\MHousekeeping;
use App\Models\MMeterSumber;
use App\Models\MPintu;
use App\Models\MPlumbing;
use App\Models\MRollingDoor;
use App\Models\MSoundSystem;
use App\Models\MStore;
use App\Models\MStp;
use App\Models\MTelephonePabx;
use App\Models\MUser;
use App\Models\MUps;

class CEquipment extends BaseController
{
    public function __construct()
    {
        $this->mUser = new MUser();
        $this->mStore = new MStore();
        $this->mEquip = new MEquipment();
        $this->mUps = new MUps();
        $this->mGas = new MGasStation();
        $this->mStp = new MStp();
        $this->mCctv = new MCctv();
        $this->mPlumbing = new MPlumbing();
        $this->mMeterSumber = new MMeterSumber();
        $this->mDinding = new MDindingPartisi();
        $this->mPintu = new MPintu();
        $this->mGate = new MFoldingGate();
        $this->mRollDoor = new MRollingDoor();
        $this->mFireFight = new MFireFighting();
        $this->mTelpPabx = new MTelephonePabx();
        $this->mHouseKeep = new MHousekeeping();
        $this->mGondola = new MGondola();
        $this->mSoundSystem = new MSoundSystem();
        helper(['form', 'url', 'functionHelper']);
    }

    public function index()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'Schedule | B.M Apps &copy; Gramedia ' . date('Y');
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

            $data['getStore'] = $this->mEquip->getStoreDropdown();
            $data['getDataTableStoreEquip'] = $this->mEquip->getDataTableStoreEquip();

            $equipment = $this->mEquip->getEquipment();
            $data['getEquipment'] = $equipment;
            $data['equipBox'] = array_chunk($equipment, 11);

            return view('vStoreEquipment', $data);
        }
    }

    public function saveStoreEquipment()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $equipment = $this->mEquip->getEquipment();
            $rules = [
                'storeName' => [
                    'rules' => 'required|numeric',
                    'label' => 'Store Name',
                ],
            ];

            foreach ($equipment as $key => $value) {
                $rules += [
                    $value['equipment']  => [
                        'rules' => 'numeric|permit_empty',
                        'label' => $value['equipment_name'],
                    ],
                    "checklist_" . $value['equipment']  => [
                        'rules' => 'in_list[DAILY,WEEKLY,MONTHLY]|permit_empty',
                        'label' => "Checklist " . $value['equipment_name'],
                    ],
                ];
            }

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/storeEquipment')->withInput()->with('validation', $validation);
            }

            $post = $this->request->getPost();

            $dataInput = [];

            $i = 0;
            foreach ($equipment as $key => $value) {
                //? cek hanya masukin data yg di checklist
                if ($this->request->getPost($value['equipment']) != null) {
                    $dataInput[$i] = [
                        "idStore"    =>  $post['storeName'],
                        "idEquipment" => $this->request->getPost($value['equipment']),
                        "checklist" => $this->request->getPost('checklist_' . $value['equipment']),
                    ];
                    $i++;
                }
            }

            $input = $this->mEquip->inputStoreEquipSetup($dataInput);

            if ($input) {
                session()->setFlashdata('success', 'Store Equipment has been added');
                return redirect()->to('/storeEquipment', 201);
            }

            session()->setFlashdata('error', 'Store Equipment has not been added');
            return redirect()->to('/storeEquipment', 500);
        }
    }

    public function editStoreEquipment()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $equipment = $this->mEquip->getEquipment();
            $rules = [
                'storeName' => [
                    'rules' => 'required|numeric',
                    'label' => 'Store Name',
                ],
            ];

            foreach ($equipment as $key => $value) {
                $rules += [
                    $value['equipment']  => [
                        'rules' => 'numeric|permit_empty',
                        'label' => $value['equipment_name'],
                    ],
                    "checklist_" . $value['equipment']  => [
                        'rules' => 'in_list[DAILY,WEEKLY,MONTHLY]|permit_empty',
                        'label' => "Checklist " . $value['equipment_name'],
                    ],
                ];
            }

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/storeEquipment')->withInput()->with('validation', $validation);
            }

            $post = $this->request->getPost();

            $dataEdit = [];

            $i = 0;
            foreach ($equipment as $key => $value) {
                //? cek hanya masukin data yg di checklist
                if ($this->request->getPost($value['equipment']) != null) {
                    $dataEdit[$i] = [
                        "idStore"    =>  $post['storeName'],
                        "idEquipment" => $this->request->getPost($value['equipment']),
                        "checklist" => $this->request->getPost('checklist_' . $value['equipment']),
                    ];
                    $i++;
                }
            }

            $edit = $this->mEquip->editStoreEquipSetup($dataEdit, $post['storeName']);

            if ($edit) {
                session()->setFlashdata('success', 'Store Equipment has been edited');
                return redirect()->to('/storeEquipment', 200);
            }

            session()->setFlashdata('error', 'Store Equipment has not been edited');
            return redirect()->to('/storeEquipment', 500);
        }
    }

    public function deleteStoreEquipment()
    {
        $delete = $this->mEquip->deleteStoreEquipment($this->request->getPost('idStore'));
        if ($delete) {
            $response = [
                'success' => true,
            ];
            session()->setFlashdata('success', 'Store Equipment has been deleted');
        } else {
            $response = [
                'success' => false,
            ];
            session()->setFlashdata('error', 'Store Equipment has not been deleted');
        }
        return $this->response->setJSON($response);
    }

    public function ajaxDataStoreEquipment()
    {
        $equip = $this->mEquip->getEquipment();
        $data = $this->mEquip->ajaxDataStoreEquipment($this->request->getPost('idStore'));
        if ($data) {
            $response = [
                'success' => true,
                'data' => $data,
                'equip' => $equip
            ];
        } else {
            $response = [
                'success' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function ups()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'UPS | B.M Apps &copy; Gramedia ' . date('Y');
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

            $data['getDataTableUps'] = $this->mUps->getDataTableUps();
            $checklist = $this->mEquip->defaultChecklist(session()->get('idstore'), "equipment_ups");
            $data['checkInspection'] = $this->mEquip->checkInspection('tb_ups', $checklist['checklist']);
            $data['defaultChecklist'] = $checklist;

            return view('vUps', $data);
        }
    }

    public function saveUps()
    {

        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'equipment_checklist' => [
                    'rules' => 'required|in_list[DAILY,WEEKLY,MONTHLY]',
                    'label' => 'Checklist',
                ],
                'merk' => [
                    'rules' => 'required|max_length[25]',
                    'label' => 'Merk',
                ],
                'type' => [
                    'rules' => 'required|max_length[25]',
                    'label' => 'Type',
                ],
                'serial_number' => [
                    'rules' => 'required|max_length[25]',
                    'label' => 'Serial Number',
                ],
                'keterangan' => [
                    'rules' => 'required|max_length[255]',
                    'label' => 'Keterangan',
                ],
                'lokasi_ruang' => [
                    'rules' => 'required|max_length[30]',
                    'label' => 'Ruang',
                ],
                'lokasi_lantai' => [
                    'rules' => 'required|max_length[2]',
                    'label' => 'Lantai',
                ],
                'peruntukan' => [
                    'rules' => 'required|max_length[50]',
                    'label' => 'Lantai',
                ],
                'tegangan_input' => [
                    'rules' => 'required|numeric|max_length[10]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Tegangan Input AC',
                ],
                'tegangan_output' => [
                    'rules' => 'required|numeric|max_length[10]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Tegangan Output AC',
                ],
                'tegangan_n_g' => [
                    'rules' => 'required|numeric|max_length[10]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Tegangan N-G',
                ],
                'load_percent' => [
                    'rules' => 'required|numeric|max_length[5]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Load %',
                ],
                'load_amp' => [
                    'rules' => 'required|numeric|max_length[10]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Load Amp',
                ],
                'inspeksi_kebersihan' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Inspeksi Kebersihan',
                ],
                'inspeksi_fan' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Inspeksi Fan',
                ],
                'inspeksi_suhu' => [
                    'rules' => 'required|numeric|max_length[10]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Inspeksi Suhu',
                ],
                'inspeksi_alarm' => [
                    'rules' => 'required|max_length[50]',
                    'label' => 'Inspeksi Alarm',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/ups')->withInput()->with('validation', $validation);
            }

            $dataInput = [
                'location' => session()->get('idstore'),
                'date' => date('Y-m-d'),
                'worker' => session()->get('id'),
                'equipment_checklist' => $this->request->getPost('equipment_checklist'),
                'merk' => $this->request->getPost('merk'),
                'type' => $this->request->getPost('type'),
                'serial_number' => $this->request->getPost('serial_number'),
                'lokasi_ruang' => $this->request->getPost('lokasi_ruang'),
                'lokasi_lantai' => $this->request->getPost('lokasi_lantai'),
                'peruntukan' => $this->request->getPost('peruntukan'),
                'tegangan_input' => $this->request->getPost('tegangan_input'),
                'tegangan_output' => $this->request->getPost('tegangan_output'),
                'tegangan_n_g' => $this->request->getPost('tegangan_n_g'),
                'load_percent' => $this->request->getPost('load_percent'),
                'load_amp' => $this->request->getPost('load_amp'),
                'inspeksi_kebersihan' => $this->request->getPost('inspeksi_kebersihan'),
                'inspeksi_fan' => $this->request->getPost('inspeksi_fan'),
                'inspeksi_suhu' => $this->request->getPost('inspeksi_suhu'),
                'inspeksi_alarm' => $this->request->getPost('inspeksi_alarm'),
                'keterangan' => $this->request->getPost('keterangan'),
            ];

            $input = $this->mUps->save($dataInput);

            if ($input) {
                session()->setFlashdata('success', 'UPS Data has been added');
                return redirect()->to('/ups', 201);
            }

            session()->setFlashdata('error', 'UPS Data has not been added');
            return redirect()->to('/ups', 500);
        }
    }

    public function updateUps($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'merk' => [
                    'rules' => 'required|max_length[25]',
                    'label' => 'Merk',
                ],
                'type' => [
                    'rules' => 'required|max_length[25]',
                    'label' => 'Type',
                ],
                'serial_number' => [
                    'rules' => 'required|max_length[25]',
                    'label' => 'Serial Number',
                ],
                'keterangan' => [
                    'rules' => 'required|max_length[255]',
                    'label' => 'Keterangan',
                ],
                'lokasi_ruang' => [
                    'rules' => 'required|max_length[30]',
                    'label' => 'Ruang',
                ],
                'lokasi_lantai' => [
                    'rules' => 'required|max_length[2]',
                    'label' => 'Lantai',
                ],
                'peruntukan' => [
                    'rules' => 'required|max_length[50]',
                    'label' => 'Lantai',
                ],
                'tegangan_input' => [
                    'rules' => 'required|numeric|max_length[10]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Tegangan Input AC',
                ],
                'tegangan_output' => [
                    'rules' => 'required|numeric|max_length[10]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Tegangan Output AC',
                ],
                'tegangan_n_g' => [
                    'rules' => 'required|numeric|max_length[10]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Tegangan N-G',
                ],
                'load_percent' => [
                    'rules' => 'required|numeric|max_length[5]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Load %',
                ],
                'load_amp' => [
                    'rules' => 'required|numeric|max_length[10]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Load Amp',
                ],
                'inspeksi_kebersihan' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Inspeksi Kebersihan',
                ],
                'inspeksi_fan' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Inspeksi Fan',
                ],
                'inspeksi_suhu' => [
                    'rules' => 'required|numeric|max_length[10]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Inspeksi Suhu',
                ],
                'inspeksi_alarm' => [
                    'rules' => 'required|max_length[50]',
                    'label' => 'Inspeksi Alarm',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/ups')->withInput()->with('validation', $validation);
            }

            $dataUpdate = [
                'id' => $id,
                'equipment_checklist' => $this->request->getPost('equipment_checklist'),
                'merk' => $this->request->getPost('merk'),
                'type' => $this->request->getPost('type'),
                'serial_number' => $this->request->getPost('serial_number'),
                'lokasi_ruang' => $this->request->getPost('lokasi_ruang'),
                'lokasi_lantai' => $this->request->getPost('lokasi_lantai'),
                'peruntukan' => $this->request->getPost('peruntukan'),
                'tegangan_input' => $this->request->getPost('tegangan_input'),
                'tegangan_output' => $this->request->getPost('tegangan_output'),
                'tegangan_n_g' => $this->request->getPost('tegangan_n_g'),
                'load_percent' => $this->request->getPost('load_percent'),
                'load_amp' => $this->request->getPost('load_amp'),
                'inspeksi_kebersihan' => $this->request->getPost('inspeksi_kebersihan'),
                'inspeksi_fan' => $this->request->getPost('inspeksi_fan'),
                'inspeksi_suhu' => $this->request->getPost('inspeksi_suhu'),
                'inspeksi_alarm' => $this->request->getPost('inspeksi_alarm'),
                'keterangan' => $this->request->getPost('keterangan'),
            ];

            $update = $this->mUps->save($dataUpdate);

            if ($update) {
                session()->setFlashdata('success', 'UPS Data has been edited');
                return redirect()->to('/ups', 201);
            }

            session()->setFlashdata('error', 'UPS Data has not been edited');
            return redirect()->to('/ups', 500);
        }
    }

    public function deleteUps()
    {
        $delete = $this->mUps->delete($this->request->getPost('id'));
        if ($delete) {
            $response = [
                'success' => true,
            ];
            session()->setFlashdata('success', 'Ups Data has been deleted');
        } else {
            $response = [
                'success' => false,
            ];
            session()->setFlashdata('error', 'Ups Data has not been deleted');
        }
        return $this->response->setJSON($response);
    }

    public function ajaxDataUps()
    {
        $data = $this->mUps->ajaxDataUps($this->request->getPost('id'));
        if ($data) {
            $response = [
                'success' => true,
                'data' => $data,
            ];
        } else {
            $response = [
                'success' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function gasStation()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'Gas Station | B.M Apps &copy; Gramedia ' . date('Y');
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

            $data['getDataTableGasStation'] = $this->mGas->getDataTableGasStation();
            $checklist = $this->mEquip->defaultChecklist(session()->get('idstore'), "equipment_gasstation");
            $data['checkInspection'] = $this->mEquip->checkInspection('tb_gas_station', $checklist['checklist']);
            $data['defaultChecklist'] = $checklist;

            return view('vGasStation', $data);
        }
    }

    public function saveGasStation()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'time' => [
                    'rules' => 'required|in_list[08:00:00,13:00:00,19:00:00]',
                    'label' => 'Jam Pengecekan',
                ],
                'equipment_checklist' => [
                    'rules' => 'required|in_list[DAILY,WEEKLY,MONTHLY]',
                    'label' => 'Checklist',
                ],
                'pressure' => [
                    'rules' => 'required|max_length[6]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Pressure',
                ],
                'selenoid_valve' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Selenoid Valve',
                ],
                'detector' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Detector',
                ],
                'selang_gas' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Selang Gas',
                ],
                'meter_gas' => [
                    'rules' => 'required|max_length[10]',
                    'label' => 'Meter Gas',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/gasstation')->withInput()->with('validation', $validation);
            }

            $dataInput = [
                'location' => session()->get('idstore'),
                'time' => $this->request->getPost('time'),
                'date' => date('Y-m-d'),
                'worker' => session()->get('id'),
                'equipment_checklist' => $this->request->getPost('equipment_checklist'),
                'pressure' => $this->request->getPost('pressure'),
                'selenoid_valve' => $this->request->getPost('selenoid_valve'),
                'detector' => $this->request->getPost('detector'),
                'selang_gas' => $this->request->getPost('selang_gas'),
                'meter_gas' => $this->request->getPost('meter_gas'),
            ];

            $input = $this->mGas->save($dataInput);

            if ($input) {
                session()->setFlashdata('success', 'Gas Station Data has been added');
                return redirect()->to('/gasstation', 201);
            }

            session()->setFlashdata('error', 'Gas Station Data has not been added');
            return redirect()->to('/gasstation', 500);
        }
    }

    public function updateGasStation($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'pressure' => [
                    'rules' => 'required|max_length[6]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Pressure',
                ],
                'selenoid_valve' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Selenoid Valve',
                ],
                'detector' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Detector',
                ],
                'selang_gas' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Selang Gas',
                ],
                'meter_gas' => [
                    'rules' => 'required|max_length[10]',
                    'label' => 'Meter Gas',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/gasstation')->withInput()->with('validation', $validation);
            }

            $dataUpdate = [
                'id' => $id,
                'equipment_checklist' => $this->request->getPost('equipment_checklist'),
                'pressure' => $this->request->getPost('pressure'),
                'selenoid_valve' => $this->request->getPost('selenoid_valve'),
                'detector' => $this->request->getPost('detector'),
                'selang_gas' => $this->request->getPost('selang_gas'),
                'meter_gas' => $this->request->getPost('meter_gas'),
            ];

            $update = $this->mGas->save($dataUpdate);

            if ($update) {
                session()->setFlashdata('success', 'Gas Station Data has been edited');
                return redirect()->to('/gasstation', 201);
            }

            session()->setFlashdata('error', 'Gas Station Data has not been edited');
            return redirect()->to('/gasstation', 500);
        }
    }

    public function deleteGasStation()
    {
        $delete = $this->mGas->delete($this->request->getPost('id'));
        if ($delete) {
            $response = [
                'success' => true,
            ];
            session()->setFlashdata('success', 'Gas Station Data has been deleted');
        } else {
            $response = [
                'success' => false,
            ];
            session()->setFlashdata('error', 'Gas Station Data has not been deleted');
        }
        return $this->response->setJSON($response);
    }

    public function ajaxDataGasStation()
    {
        $data = $this->mGas->ajaxDataGasStation($this->request->getPost('id'));
        if ($data) {
            $response = [
                'success' => true,
                'data' => $data,
            ];
        } else {
            $response = [
                'success' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function stp()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'STP | B.M Apps &copy; Gramedia ' . date('Y');
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

            $data['getDataTableStp'] = $this->mStp->getDataTableStp();
            $checklist = $this->mEquip->defaultChecklist(session()->get('idstore'), "equipment_stp");
            $data['checkInspection'] = $this->mEquip->checkInspection('tb_stp', $checklist['checklist']);
            $data['defaultChecklist'] = $checklist;

            return view('vStp', $data);
        }
    }

    public function saveStp()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'time' => [
                    'rules' => 'required|in_list[13:00:00]',
                    'label' => 'Jam Pengecekan',
                ],
                'equipment_checklist' => [
                    'rules' => 'required|in_list[DAILY,WEEKLY,MONTHLY]',
                    'label' => 'Checklist',
                ],
                'blower1' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Blower 1',
                ],
                'blower2' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Blower 2',
                ],
                'transfer_pump1' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Transfer Pump 1',
                ],
                'transfer_pump2' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Transfer Pump 2',
                ],
                'effluent_pump1' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Effluent Pump 1',
                ],
                'effluent_pump2' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Effluent Pump 2',
                ],
                'equalizing_pump1' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Equalizing Pump 1',
                ],
                'equalizing_pump2' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Equalizing Pump 2',
                ],
                'filter_pump1' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Filter Pump 1',
                ],
                'filter_pump2' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Filter Pump 2',
                ],
                'dozing_pump' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Dozing Pump',
                ],
                'fresh_air_fan' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Fresh Air Fan',
                ],
                'exhaust_fan' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Exhaust Fan',
                ],
                'inspeksi_cleaning_grease_trap' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Inspeksi Cleaning Grease Trap',
                ],
                'inspeksi_chlorine' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Inspeksi Chlorine',
                ],
                'inspeksi_flow_meter' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Inspeksi Flow Meter',
                ],
                'inspeksi_ph_water' => [
                    'rules' => 'required|max_length[10]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Inspeksi PH Water',
                ],
                'keterangan' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Keterangan',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/stp')->withInput()->with('validation', $validation);
            }

            $dataInput = [
                'location' => session()->get('idstore'),
                'time' => $this->request->getPost('time'),
                'date' => date('Y-m-d'),
                'worker' => session()->get('id'),
                'equipment_checklist' => $this->request->getPost('equipment_checklist'),
                'blower1' => $this->request->getPost('blower1'),
                'blower2' => $this->request->getPost('blower2'),
                'transfer_pump1' => $this->request->getPost('transfer_pump1'),
                'transfer_pump2' => $this->request->getPost('transfer_pump2'),
                'effluent_pump1' => $this->request->getPost('effluent_pump1'),
                'effluent_pump2' => $this->request->getPost('effluent_pump2'),
                'equalizing_pump1' => $this->request->getPost('equalizing_pump1'),
                'equalizing_pump2' => $this->request->getPost('equalizing_pump2'),
                'filter_pump1' => $this->request->getPost('filter_pump1'),
                'filter_pump2' => $this->request->getPost('filter_pump2'),
                'dozing_pump' => $this->request->getPost('dozing_pump'),
                'fresh_air_fan' => $this->request->getPost('fresh_air_fan'),
                'exhaust_fan' => $this->request->getPost('exhaust_fan'),
                'inspeksi_cleaning_grease_trap' => $this->request->getPost('inspeksi_cleaning_grease_trap'),
                'inspeksi_chlorine' => $this->request->getPost('inspeksi_chlorine'),
                'inspeksi_flow_meter' => $this->request->getPost('inspeksi_flow_meter'),
                'inspeksi_ph_water' => $this->request->getPost('inspeksi_ph_water'),
                'keterangan' => $this->request->getPost('keterangan'),
            ];

            $input = $this->mStp->save($dataInput);

            if ($input) {
                session()->setFlashdata('success', 'STP Data has been added');
                return redirect()->to('/stp', 201);
            }

            session()->setFlashdata('error', 'STP Data has not been added');
            return redirect()->to('/stp', 500);
        }
    }

    public function updateStp($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'blower1' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Blower 1',
                ],
                'blower2' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Blower 2',
                ],
                'transfer_pump1' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Transfer Pump 1',
                ],
                'transfer_pump2' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Transfer Pump 2',
                ],
                'effluent_pump1' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Effluent Pump 1',
                ],
                'effluent_pump2' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Effluent Pump 2',
                ],
                'equalizing_pump1' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Equalizing Pump 1',
                ],
                'equalizing_pump2' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Equalizing Pump 2',
                ],
                'filter_pump1' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Filter Pump 1',
                ],
                'filter_pump2' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Filter Pump 2',
                ],
                'dozing_pump' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Dozing Pump',
                ],
                'fresh_air_fan' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Fresh Air Fan',
                ],
                'exhaust_fan' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Exhaust Fan',
                ],
                'inspeksi_cleaning_grease_trap' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Inspeksi Cleaning Grease Trap',
                ],
                'inspeksi_chlorine' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Inspeksi Chlorine',
                ],
                'inspeksi_flow_meter' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Inspeksi Flow Meter',
                ],
                'inspeksi_ph_water' => [
                    'rules' => 'required|max_length[10]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Inspeksi PH Water',
                ],
                'keterangan' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Keterangan',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/stp')->withInput()->with('validation', $validation);
            }

            $dataUpdate = [
                'id' => $id,
                'equipment_checklist' => $this->request->getPost('equipment_checklist'),
                'blower1' => $this->request->getPost('blower1'),
                'blower2' => $this->request->getPost('blower2'),
                'transfer_pump1' => $this->request->getPost('transfer_pump1'),
                'transfer_pump2' => $this->request->getPost('transfer_pump2'),
                'effluent_pump1' => $this->request->getPost('effluent_pump1'),
                'effluent_pump2' => $this->request->getPost('effluent_pump2'),
                'equalizing_pump1' => $this->request->getPost('equalizing_pump1'),
                'equalizing_pump2' => $this->request->getPost('equalizing_pump2'),
                'filter_pump1' => $this->request->getPost('filter_pump1'),
                'filter_pump2' => $this->request->getPost('filter_pump2'),
                'dozing_pump' => $this->request->getPost('dozing_pump'),
                'fresh_air_fan' => $this->request->getPost('fresh_air_fan'),
                'exhaust_fan' => $this->request->getPost('exhaust_fan'),
                'inspeksi_cleaning_grease_trap' => $this->request->getPost('inspeksi_cleaning_grease_trap'),
                'inspeksi_chlorine' => $this->request->getPost('inspeksi_chlorine'),
                'inspeksi_flow_meter' => $this->request->getPost('inspeksi_flow_meter'),
                'inspeksi_ph_water' => $this->request->getPost('inspeksi_ph_water'),
                'keterangan' => $this->request->getPost('keterangan'),
            ];

            $update = $this->mStp->save($dataUpdate);

            if ($update) {
                session()->setFlashdata('success', 'STP Data has been edited');
                return redirect()->to('/stp', 201);
            }

            session()->setFlashdata('error', 'STP Data has not been edited');
            return redirect()->to('/stp', 500);
        }
    }

    public function deleteStp()
    {
        $delete = $this->mStp->delete($this->request->getPost('id'));
        if ($delete) {
            $response = [
                'success' => true,
            ];
            session()->setFlashdata('success', 'STP Data has been deleted');
        } else {
            $response = [
                'success' => false,
            ];
            session()->setFlashdata('error', 'STP Data has not been deleted');
        }
        return $this->response->setJSON($response);
    }

    public function ajaxDataStp()
    {
        $data = $this->mStp->ajaxDataStp($this->request->getPost('id'));
        if ($data) {
            $response = [
                'success' => true,
                'data' => $data,
            ];
        } else {
            $response = [
                'success' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function cctv()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'CCTV | B.M Apps &copy; Gramedia ' . date('Y');
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

            $data['getDataTableCctv'] = $this->mCctv->getDataTableCctv();
            $checklist = $this->mEquip->defaultChecklist(session()->get('idstore'), "equipment_cctv");
            $data['checkInspection'] = $this->mEquip->checkInspection('tb_cctv', $checklist['checklist']);
            $data['defaultChecklist'] = $checklist;

            return view('vCctv', $data);
        }
    }

    public function saveCctv()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'time' => [
                    'rules' => 'required|in_list[10:00:00]',
                    'label' => 'Jam Pengecekan',
                ],
                'equipment_checklist' => [
                    'rules' => 'required|in_list[DAILY,WEEKLY,MONTHLY]',
                    'label' => 'Checklist',
                ],
            ];

            for ($i = 1; $i <= 5; $i++) {
                $rules += [
                    "dvr$i" => [
                        "rules" => "in_list[DVR$i]|permit_empty",
                        "label" => "DVR$i",
                    ],
                    "hdd_internal$i" => [
                        "rules" => "required_with[dvr$i]|in_list[0,1]|permit_empty",
                        "label" => "HDD Internal DVR$i",
                    ],
                    "usb_extender$i" => [
                        "rules" => "required_with[dvr$i]|in_list[0,1]|permit_empty",
                        "label" => "USB Extender DVR$i",
                    ],
                    "hdmi_vga_ext$i" => [
                        "rules" => "required_with[dvr$i]|in_list[0,1]|permit_empty",
                        "label" => "HDMI / VGA Ext DVR$i",
                    ],
                    "jumlah_rekaman$i" => [
                        "rules" => "required_with[dvr$i]|permit_empty|regex_match[^\d+(\.\d{1,2})?$]",
                        "label" => "Jumlah Rekaman DVR$i",
                        'errors' => [
                            'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                        ],
                    ],
                    "camera_jumlah$i" => [
                        "rules" => "required_with[dvr$i]|numeric|permit_empty",
                        "label" => "Jumlah Kamera DVR$i",
                    ],
                    "camera_keterangan$i" => [
                        "rules" => "required_with[dvr$i]|max_length[500]|permit_empty",
                        "label" => "Keterangan Kamera DVR$i",
                    ],
                    "adaptor_power_jumlah$i" => [
                        "rules" => "required_with[dvr$i]|numeric|permit_empty",
                        "label" => "Jumlah Adaptor/Power Supply DVR$i",
                    ],
                    "adaptor_power_keterangan$i" => [
                        "rules" => "required_with[dvr$i]|max_length[500]|permit_empty",
                        "label" => "Keterangan Adaptor/Power Supply DVR$i",
                    ],
                ];
            }

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/cctv')->withInput()->with('validation', $validation);
            }

            $dataInput = [];

            $x = 0;
            for ($i = 1; $i <= 5; $i++) {
                //? cek hanya masukin data yg di checklist
                if ($this->request->getPost("dvr$i") == "DVR$i") {
                    $dataInput[$x] = [
                        'location' => session()->get('idstore'),
                        'time' => $this->request->getPost('time'),
                        'date' => date('Y-m-d'),
                        'worker' => session()->get('id'),
                        'equipment_checklist' => $this->request->getPost('equipment_checklist'),
                        'dvr' => $this->request->getPost("dvr$i"),
                        'hdd_internal' => $this->request->getPost("hdd_internal$i"),
                        'usb_extender' => $this->request->getPost("usb_extender$i"),
                        'hdmi_vga_ext' => $this->request->getPost("hdmi_vga_ext$i"),
                        'jumlah_rekaman' => $this->request->getPost("jumlah_rekaman$i"),
                        'camera_jumlah' => $this->request->getPost("camera_jumlah$i"),
                        'camera_keterangan' => $this->request->getPost("camera_keterangan$i"),
                        'adaptor_power_jumlah' => $this->request->getPost("adaptor_power_jumlah$i"),
                        'adaptor_power_keterangan' => $this->request->getPost("adaptor_power_keterangan$i"),
                    ];
                    $x++;
                }
            }

            $input = $this->mCctv->saveCctv($dataInput);

            if ($input) {
                session()->setFlashdata('success', 'CCTV Data has been added');
                return redirect()->to('/cctv', 201);
            }

            session()->setFlashdata('error', 'CCTV Data has not been added');
            return redirect()->to('/cctv', 500);
        }
    }

    public function updateCctv($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                "hdd_internal" => [
                    "rules" => "required|in_list[0,1]|permit_empty",
                    "label" => "HDD Internal DVR",
                ],
                "usb_extender" => [
                    "rules" => "required|in_list[0,1]|permit_empty",
                    "label" => "USB Extender DVR",
                ],
                "hdmi_vga_ext" => [
                    "rules" => "required|in_list[0,1]|permit_empty",
                    "label" => "HDMI / VGA Ext DVR",
                ],
                "jumlah_rekaman" => [
                    "rules" => "required|permit_empty|regex_match[^\d+(\.\d{1,2})?$]",
                    "label" => "Jumlah Rekaman DVR",
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                ],
                "camera_jumlah" => [
                    "rules" => "required|numeric|permit_empty",
                    "label" => "Jumlah Kamera DVR",
                ],
                "camera_keterangan" => [
                    "rules" => "required|max_length[500]|permit_empty",
                    "label" => "Keterangan Kamera DVR",
                ],
                "adaptor_power_jumlah" => [
                    "rules" => "required|numeric|permit_empty",
                    "label" => "Jumlah Adaptor/Power Supply DVR",
                ],
                "adaptor_power_keterangan" => [
                    "rules" => "required|max_length[500]|permit_empty",
                    "label" => "Keterangan Adaptor/Power Supply DVR",
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/cctv')->withInput()->with('validation', $validation);
            }

            $dataUpdate = [
                'id' => $id,
                'hdd_internal' => $this->request->getPost("hdd_internal"),
                'usb_extender' => $this->request->getPost("usb_extender"),
                'hdmi_vga_ext' => $this->request->getPost("hdmi_vga_ext"),
                'jumlah_rekaman' => $this->request->getPost("jumlah_rekaman"),
                'camera_jumlah' => $this->request->getPost("camera_jumlah"),
                'camera_keterangan' => $this->request->getPost("camera_keterangan"),
                'adaptor_power_jumlah' => $this->request->getPost("adaptor_power_jumlah"),
                'adaptor_power_keterangan' => $this->request->getPost("adaptor_power_keterangan"),
            ];

            $update = $this->mCctv->save($dataUpdate);

            if ($update) {
                session()->setFlashdata('success', 'CCTV Data has been edited');
                return redirect()->to('/cctv', 200);
            }

            session()->setFlashdata('error', 'CCTV Data has not been edited');
            return redirect()->to('/cctv', 500);
        }
    }

    public function deleteCctv()
    {
        $delete = $this->mCctv->delete($this->request->getPost('id'));
        if ($delete) {
            $response = [
                'success' => true,
            ];
            session()->setFlashdata('success', 'CCTV Data has been deleted');
        } else {
            $response = [
                'success' => false,
            ];
            session()->setFlashdata('error', 'CCTV Data has not been deleted');
        }
        return $this->response->setJSON($response);
    }

    public function ajaxDataCctv()
    {
        $data = $this->mCctv->ajaxDataCctv($this->request->getPost('id'));
        if ($data) {
            $response = [
                'success' => true,
                'data' => $data,
            ];
        } else {
            $response = [
                'success' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function plumbing()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'Plumbing | B.M Apps &copy; Gramedia ' . date('Y');
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

            $data['getDataTablePlumbing'] = $this->mPlumbing->getDataTablePlumbing();
            $checklist = $this->mEquip->defaultChecklist(session()->get('idstore'), "equipment_plumbing");
            $data['checkInspection'] = $this->mEquip->checkInspection('tb_plumbing', $checklist['checklist']);
            $data['defaultChecklist'] = $checklist;
            
            return view('vPlumbing', $data);
        }
    }

    public function savePlumbing()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'time' => [
                    'rules' => 'required|in_list[08:00:00]',
                    'label' => 'Jam Pengecekan',
                ],
                'equipment_checklist' => [
                    'rules' => 'required|in_list[DAILY,WEEKLY,MONTHLY]',
                    'label' => 'Checklist',
                ],
                'instalasi_air_bersih_p_transfer1' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Instalasi Air Bersih P.Trans 1',
                ],
                'instalasi_air_bersih_p_transfer2' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Instalasi Air Bersih P.Trans 2',
                ],
                'fire_pump_jockey_pump' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Fire Pump - Jockey Pump',
                ],
                'fire_pump_jockey_pressure' => [
                    'rules' => 'required|max_length[10]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Fire Pump - Jockey Pump Pressure',
                ],
                'fire_pump_hydrant_pump' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Fire Pump - Hydrant Pump',
                ],
                'fire_pump_hydrant_pressure' => [
                    'rules' => 'required|max_length[10]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Fire Pump - Hydrant Pump Pressure',
                ],
                'gwt_level_air' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'GWT - Level Air',
                ],
                'gwt_elektrode' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'GWT - Elektrode',
                ],
                'roof_tank_level_air' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Roof Tank - Level Air',
                ],
                'roof_tank_elektrode' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Roof Tank - Elektrode',
                ],
                'recycle_tank_level_air' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Recycle Tank - Level Air',
                ],
                'recycle_tank_elektrode' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Recycle Tank - Elektrode',
                ],
                'keterangan' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Keterangan',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/plumbing')->withInput()->with('validation', $validation);
            }

            $dataInput = [
                'location' => session()->get('idstore'),
                'time' => $this->request->getPost('time'),
                'date' => date('Y-m-d'),
                'worker' => session()->get('id'),
                'equipment_checklist' => $this->request->getPost('equipment_checklist'),
                'instalasi_air_bersih_p_transfer1' => $this->request->getPost('instalasi_air_bersih_p_transfer1'),
                'instalasi_air_bersih_p_transfer2' => $this->request->getPost('instalasi_air_bersih_p_transfer2'),
                'fire_pump_jockey_pump' => $this->request->getPost('fire_pump_jockey_pump'),
                'fire_pump_jockey_pressure' => $this->request->getPost('fire_pump_jockey_pressure'),
                'fire_pump_hydrant_pump' => $this->request->getPost('fire_pump_hydrant_pump'),
                'fire_pump_hydrant_pressure' => $this->request->getPost('fire_pump_hydrant_pressure'),
                'gwt_level_air' => $this->request->getPost('gwt_level_air'),
                'gwt_elektrode' => $this->request->getPost('gwt_elektrode'),
                'roof_tank_level_air' => $this->request->getPost('roof_tank_level_air'),
                'roof_tank_elektrode' => $this->request->getPost('roof_tank_elektrode'),
                'recycle_tank_level_air' => $this->request->getPost('recycle_tank_level_air'),
                'recycle_tank_elektrode' => $this->request->getPost('recycle_tank_elektrode'),
                'keterangan' => $this->request->getPost('keterangan'),
            ];

            $input = $this->mPlumbing->save($dataInput);

            if ($input) {
                session()->setFlashdata('success', 'Plumbing Data has been added');
                return redirect()->to('/plumbing', 201);
            }

            session()->setFlashdata('error', 'Plumbing Data has not been added');
            return redirect()->to('/plumbing', 500);
        }
    }

    public function updatePlumbing($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'instalasi_air_bersih_p_transfer1' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Instalasi Air Bersih P.Trans 1',
                ],
                'instalasi_air_bersih_p_transfer2' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Instalasi Air Bersih P.Trans 2',
                ],
                'fire_pump_jockey_pump' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Fire Pump - Jockey Pump',
                ],
                'fire_pump_jockey_pressure' => [
                    'rules' => 'required|max_length[10]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Fire Pump - Jockey Pump Pressure',
                ],
                'fire_pump_hydrant_pump' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Fire Pump - Hydrant Pump',
                ],
                'fire_pump_hydrant_pressure' => [
                    'rules' => 'required|max_length[10]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Fire Pump - Hydrant Pump Pressure',
                ],
                'gwt_level_air' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'GWT - Level Air',
                ],
                'gwt_elektrode' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'GWT - Elektrode',
                ],
                'roof_tank_level_air' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Roof Tank - Level Air',
                ],
                'roof_tank_elektrode' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Roof Tank - Elektrode',
                ],
                'recycle_tank_level_air' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Recycle Tank - Level Air',
                ],
                'recycle_tank_elektrode' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Recycle Tank - Elektrode',
                ],
                'keterangan' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Keterangan',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/plumbing')->withInput()->with('validation', $validation);
            }

            $dataUpdate = [
                'id' => $id,
                'instalasi_air_bersih_p_transfer1' => $this->request->getPost('instalasi_air_bersih_p_transfer1'),
                'instalasi_air_bersih_p_transfer2' => $this->request->getPost('instalasi_air_bersih_p_transfer2'),
                'fire_pump_jockey_pump' => $this->request->getPost('fire_pump_jockey_pump'),
                'fire_pump_jockey_pressure' => $this->request->getPost('fire_pump_jockey_pressure'),
                'fire_pump_hydrant_pump' => $this->request->getPost('fire_pump_hydrant_pump'),
                'fire_pump_hydrant_pressure' => $this->request->getPost('fire_pump_hydrant_pressure'),
                'gwt_level_air' => $this->request->getPost('gwt_level_air'),
                'gwt_elektrode' => $this->request->getPost('gwt_elektrode'),
                'roof_tank_level_air' => $this->request->getPost('roof_tank_level_air'),
                'roof_tank_elektrode' => $this->request->getPost('roof_tank_elektrode'),
                'recycle_tank_level_air' => $this->request->getPost('recycle_tank_level_air'),
                'recycle_tank_elektrode' => $this->request->getPost('recycle_tank_elektrode'),
                'keterangan' => $this->request->getPost('keterangan'),
            ];

            $update = $this->mPlumbing->save($dataUpdate);

            if ($update) {
                session()->setFlashdata('success', 'Plumbing Data has been edited');
                return redirect()->to('/plumbing', 200);
            }

            session()->setFlashdata('error', 'Plumbing Data has not been edited');
            return redirect()->to('/plumbing', 500);
        }
    }

    public function deletePlumbing()
    {
        $delete = $this->mPlumbing->delete($this->request->getPost('id'));
        if ($delete) {
            $response = [
                'success' => true,
            ];
            session()->setFlashdata('success', 'Plumbing Data has been deleted');
        } else {
            $response = [
                'success' => false,
            ];
            session()->setFlashdata('error', 'Plumbing Data has not been deleted');
        }
        return $this->response->setJSON($response);
    }

    public function ajaxDataPlumbing()
    {
        $data = $this->mPlumbing->ajaxDataPlumbing($this->request->getPost('id'));
        if ($data) {
            $response = [
                'success' => true,
                'data' => $data,
            ];
        } else {
            $response = [
                'success' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function metersumber()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'Meter Sumber & Air Olahan | B.M Apps &copy; Gramedia ' . date('Y');
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

            $data['getDataTableMeterSumber'] = $this->mMeterSumber->getDataTableMeterSumber();
            $checklist = $this->mEquip->defaultChecklist(session()->get('idstore'), "equipment_metersumber");
            $data['checkInspection'] = $this->mEquip->checkInspection('tb_meter_sumber_dan_air_olahan', $checklist['checklist']);
            $data['defaultChecklist'] = $checklist;
            
            return view('vMeterSumber', $data);
        }
    }

    public function saveMeterSumber()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'time' => [
                    'rules' => 'required|in_list[08:00:00,13:00:00,19:00:00]',
                    'label' => 'Jam Pengecekan',
                ],
                'equipment_checklist' => [
                    'rules' => 'required|in_list[DAILY,WEEKLY,MONTHLY]',
                    'label' => 'Checklist',
                ],
                'meter_pdam_floating_valve' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Meter PDAM - Floating Valve',
                ],
                'meter_pdam_m3' => [
                    'rules' => 'required|max_length[10]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Meter PDAM - M&sup3;',
                ],
                'meter_deep_well_m3' => [
                    'rules' => 'required|max_length[10]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Meter Deep Well - M&sup3;',
                ],
                'meter_air_effluent_m3' => [
                    'rules' => 'required|max_length[10]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Meter Air Effluent - M&sup3;',
                ],
                'keterangan' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Keterangan',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/metersumber')->withInput()->with('validation', $validation);
            }

            $dataInput = [
                'location' => session()->get('idstore'),
                'time' => $this->request->getPost('time'),
                'date' => date('Y-m-d'),
                'worker' => session()->get('id'),
                'equipment_checklist' => $this->request->getPost('equipment_checklist'),
                'meter_pdam_floating_valve' => $this->request->getPost('meter_pdam_floating_valve'),
                'meter_pdam_m3' => $this->request->getPost('meter_pdam_m3'),
                'meter_deep_well_m3' => $this->request->getPost('meter_deep_well_m3'),
                'meter_air_effluent_m3' => $this->request->getPost('meter_air_effluent_m3'),
                'keterangan' => $this->request->getPost('keterangan'),
            ];

            $input = $this->mMeterSumber->save($dataInput);

            if ($input) {
                session()->setFlashdata('success', 'Meter Sumber & Air Olahan Data has been added');
                return redirect()->to('/metersumber', 201);
            }

            session()->setFlashdata('error', 'Meter Sumber & Air Olahan Data has not been added');
            return redirect()->to('/metersumber', 500);
        }
    }

    public function updateMeterSumber($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'meter_pdam_floating_valve' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Meter PDAM - Floating Valve',
                ],
                'meter_pdam_m3' => [
                    'rules' => 'required|max_length[10]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Meter PDAM - M&sup3;',
                ],
                'meter_deep_well_m3' => [
                    'rules' => 'required|max_length[10]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Meter Deep Well - M&sup3;',
                ],
                'meter_air_effluent_m3' => [
                    'rules' => 'required|max_length[10]|regex_match[^\d+(\.\d{1,2})?$]',
                    'errors' => [
                        'regex_match' => '{field} must be a decimal number with at most 2 decimal places'
                    ],
                    'label' => 'Meter Air Effluent - M&sup3;',
                ],
                'keterangan' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Keterangan',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/metersumber')->withInput()->with('validation', $validation);
            }

            $dataUpdate = [
                'id' => $id,
                'meter_pdam_floating_valve' => $this->request->getPost('meter_pdam_floating_valve'),
                'meter_pdam_m3' => $this->request->getPost('meter_pdam_m3'),
                'meter_deep_well_m3' => $this->request->getPost('meter_deep_well_m3'),
                'meter_air_effluent_m3' => $this->request->getPost('meter_air_effluent_m3'),
                'keterangan' => $this->request->getPost('keterangan'),
            ];

            $update = $this->mMeterSumber->save($dataUpdate);

            if ($update) {
                session()->setFlashdata('success', 'Meter Sumber & Air Olahan Data has been edited');
                return redirect()->to('/metersumber', 200);
            }

            session()->setFlashdata('error', 'Meter Sumber & Air Olahan Data has not been edited');
            return redirect()->to('/metersumber', 500);
        }
    }

    public function deleteMeterSumber()
    {
        $delete = $this->mMeterSumber->delete($this->request->getPost('id'));
        if ($delete) {
            $response = [
                'success' => true,
            ];
            session()->setFlashdata('success', 'Meter Sumber & Air Olahan Data has been deleted');
        } else {
            $response = [
                'success' => false,
            ];
            session()->setFlashdata('error', 'Meter Sumber & Air Olahan Data has not been deleted');
        }
        return $this->response->setJSON($response);
    }

    public function ajaxDataMeterSumber()
    {
        $data = $this->mMeterSumber->ajaxDataMeterSumber($this->request->getPost('id'));
        if ($data) {
            $response = [
                'success' => true,
                'data' => $data,
            ];
        } else {
            $response = [
                'success' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function dindingpartisi()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'Dinding Partisi | B.M Apps &copy; Gramedia ' . date('Y');
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

            $data['getDataTableDindingPartisi'] = $this->mDinding->getDataTableDindingPartisi();
            $checklist = $this->mEquip->defaultChecklist(session()->get('idstore'), "equipment_dindingpartisi");
            $data['checkInspection'] = $this->mEquip->checkInspection('tb_dinding_partisi', $checklist['checklist']);
            $data['defaultChecklist'] = $checklist;
            
            return view('vDindingPartisi', $data);
        }
    }

    public function saveDindingPartisi()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'equipment_checklist' => [
                    'rules' => 'required|in_list[DAILY,WEEKLY,MONTHLY]',
                    'label' => 'Checklist',
                ],
                'ruang' => [
                    'rules' => 'required|max_length[30]',
                    'label' => 'Ruang',
                ],
                'lantai' => [
                    'rules' => 'required|max_length[2]',
                    'label' => 'Lantai',
                ],
                'cat' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Cat',
                ],
                'kaca' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Kaca',
                ],
                'kusen' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Kusen',
                ],
                'wallpaper' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Wallpaper',
                ],
                'jumlah_temuan' => [
                    'rules' => 'required|max_length[10]',
                    'label' => 'Jumlah Temuan',
                ],
                'penjelasan' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Penjelasan',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/dindingpartisi')->withInput()->with('validation', $validation);
            }

            $dataInput = [
                'location' => session()->get('idstore'),
                'time' => $this->request->getPost('time'),
                'date' => date('Y-m-d'),
                'worker' => session()->get('id'),
                'equipment_checklist' => $this->request->getPost('equipment_checklist'),
                'ruang' => $this->request->getPost('ruang'),
                'lantai' => $this->request->getPost('lantai'),
                'cat' => $this->request->getPost('cat'),
                'kaca' => $this->request->getPost('kaca'),
                'kusen' => $this->request->getPost('kusen'),
                'wallpaper' => $this->request->getPost('wallpaper'),
                'jumlah_temuan' => $this->request->getPost('jumlah_temuan'),
                'penjelasan' => $this->request->getPost('penjelasan'),
            ];

            $input = $this->mDinding->save($dataInput);

            if ($input) {
                session()->setFlashdata('success', 'Dinding Partisi Data has been added');
                return redirect()->to('/dindingpartisi', 201);
            }

            session()->setFlashdata('error', 'Dinding Partisi Data has not been added');
            return redirect()->to('/dindingpartisi', 500);
        }
    }

    public function updateDindingPartisi($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'ruang' => [
                    'rules' => 'required|max_length[30]',
                    'label' => 'Ruang',
                ],
                'lantai' => [
                    'rules' => 'required|max_length[2]',
                    'label' => 'Lantai',
                ],
                'cat' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Cat',
                ],
                'kaca' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Kaca',
                ],
                'kusen' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Kusen',
                ],
                'wallpaper' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Wallpaper',
                ],
                'jumlah_temuan' => [
                    'rules' => 'required|max_length[10]',
                    'label' => 'Jumlah Temuan',
                ],
                'penjelasan' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Penjelasan',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/dindingpartisi')->withInput()->with('validation', $validation);
            }

            $dataUpdate = [
                'id' => $id,
                'ruang' => $this->request->getPost('ruang'),
                'lantai' => $this->request->getPost('lantai'),
                'cat' => $this->request->getPost('cat'),
                'kaca' => $this->request->getPost('kaca'),
                'kusen' => $this->request->getPost('kusen'),
                'wallpaper' => $this->request->getPost('wallpaper'),
                'jumlah_temuan' => $this->request->getPost('jumlah_temuan'),
                'penjelasan' => $this->request->getPost('penjelasan'),
            ];

            $update = $this->mDinding->save($dataUpdate);

            if ($update) {
                session()->setFlashdata('success', 'Dinding Partisi Data has been edited');
                return redirect()->to('/dindingpartisi', 200);
            }

            session()->setFlashdata('error', 'Dinding Partisi Data has not been edited');
            return redirect()->to('/dindingpartisi', 500);
        }
    }

    public function deleteDindingPartisi()
    {
        $delete = $this->mDinding->delete($this->request->getPost('id'));
        if ($delete) {
            $response = [
                'success' => true,
            ];
            session()->setFlashdata('success', 'Dinding Partisi Data has been deleted');
        } else {
            $response = [
                'success' => false,
            ];
            session()->setFlashdata('error', 'Dinding Partisi Data has not been deleted');
        }
        return $this->response->setJSON($response);
    }

    public function ajaxDataDindingPartisi()
    {
        $data = $this->mDinding->ajaxDataDindingPartisi($this->request->getPost('id'));
        if ($data) {
            $response = [
                'success' => true,
                'data' => $data,
            ];
        } else {
            $response = [
                'success' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function pintu()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'Pintu | B.M Apps &copy; Gramedia ' . date('Y');
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

            $data['getDataTablePintu'] = $this->mPintu->getDataTablePintu();
            $checklist = $this->mEquip->defaultChecklist(session()->get('idstore'), "equipment_pintu");
            $data['checkInspection'] = $this->mEquip->checkInspection('tb_pintu', $checklist['checklist']);
            $data['defaultChecklist'] = $checklist;
            
            return view('vPintu', $data);
        }
    }

    public function savePintu()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'equipment_checklist' => [
                    'rules' => 'required|in_list[DAILY,WEEKLY,MONTHLY]',
                    'label' => 'Checklist',
                ],
                'ruang' => [
                    'rules' => 'required|max_length[30]',
                    'label' => 'Ruang',
                ],
                'lantai' => [
                    'rules' => 'required|max_length[2]',
                    'label' => 'Lantai',
                ],
                'cat' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Cat',
                ],
                'kunci' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Kunci',
                ],
                'kusen' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Kusen',
                ],
                'handle_pintu' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Handle Pintu',
                ],
                'engsel' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Engsel',
                ],
                'jumlah_temuan' => [
                    'rules' => 'required|max_length[10]',
                    'label' => 'Jumlah Temuan',
                ],
                'penjelasan' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Penjelasan',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/pintu')->withInput()->with('validation', $validation);
            }

            $dataInput = [
                'location' => session()->get('idstore'),
                'time' => $this->request->getPost('time'),
                'date' => date('Y-m-d'),
                'worker' => session()->get('id'),
                'equipment_checklist' => $this->request->getPost('equipment_checklist'),
                'ruang' => $this->request->getPost('ruang'),
                'lantai' => $this->request->getPost('lantai'),
                'cat' => $this->request->getPost('cat'),
                'kunci' => $this->request->getPost('kunci'),
                'kusen' => $this->request->getPost('kusen'),
                'handle_pintu' => $this->request->getPost('handle_pintu'),
                'engsel' => $this->request->getPost('engsel'),
                'jumlah_temuan' => $this->request->getPost('jumlah_temuan'),
                'penjelasan' => $this->request->getPost('penjelasan'),
            ];

            $input = $this->mPintu->save($dataInput);

            if ($input) {
                session()->setFlashdata('success', 'Pintu Data has been added');
                return redirect()->to('/pintu', 201);
            }

            session()->setFlashdata('error', 'Pintu Data has not been added');
            return redirect()->to('/pintu', 500);
        }
    }

    public function updatePintu($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'ruang' => [
                    'rules' => 'required|max_length[30]',
                    'label' => 'Ruang',
                ],
                'lantai' => [
                    'rules' => 'required|max_length[2]',
                    'label' => 'Lantai',
                ],
                'cat' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Cat',
                ],
                'kunci' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Kunci',
                ],
                'kusen' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Kusen',
                ],
                'handle_pintu' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Handle Pintu',
                ],
                'engsel' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Engsel',
                ],
                'jumlah_temuan' => [
                    'rules' => 'required|max_length[10]',
                    'label' => 'Jumlah Temuan',
                ],
                'penjelasan' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Penjelasan',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/pintu')->withInput()->with('validation', $validation);
            }

            $dataUpdate = [
                'id' => $id,
                'ruang' => $this->request->getPost('ruang'),
                'lantai' => $this->request->getPost('lantai'),
                'cat' => $this->request->getPost('cat'),
                'kunci' => $this->request->getPost('kunci'),
                'kusen' => $this->request->getPost('kusen'),
                'handle_pintu' => $this->request->getPost('handle_pintu'),
                'engsel' => $this->request->getPost('engsel'),
                'jumlah_temuan' => $this->request->getPost('jumlah_temuan'),
                'penjelasan' => $this->request->getPost('penjelasan'),
            ];

            $update = $this->mPintu->save($dataUpdate);

            if ($update) {
                session()->setFlashdata('success', 'Pintu Data has been edited');
                return redirect()->to('/pintu', 200);
            }

            session()->setFlashdata('error', 'Pintu Data has not been edited');
            return redirect()->to('/pintu', 500);
        }
    }

    public function deletePintu()
    {
        $delete = $this->mPintu->delete($this->request->getPost('id'));
        if ($delete) {
            $response = [
                'success' => true,
            ];
            session()->setFlashdata('success', 'Pintu Data has been deleted');
        } else {
            $response = [
                'success' => false,
            ];
            session()->setFlashdata('error', 'Pintu Data has not been deleted');
        }
        return $this->response->setJSON($response);
    }

    public function ajaxDataPintu()
    {
        $data = $this->mPintu->ajaxDataPintu($this->request->getPost('id'));
        if ($data) {
            $response = [
                'success' => true,
                'data' => $data,
            ];
        } else {
            $response = [
                'success' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function foldinggate()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'Folding Gate | B.M Apps &copy; Gramedia ' . date('Y');
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

            $data['getDataTableFoldingGate'] = $this->mGate->getDataTableFoldingGate();
            $checklist = $this->mEquip->defaultChecklist(session()->get('idstore'), "equipment_foldinggate");
            $data['checkInspection'] = $this->mEquip->checkInspection('tb_folding_gate', $checklist['checklist']);
            $data['defaultChecklist'] = $checklist;
            
            return view('vFoldingGate', $data);
        }
    }

    public function saveFoldingGate()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'equipment_checklist' => [
                    'rules' => 'required|in_list[DAILY,WEEKLY,MONTHLY]',
                    'label' => 'Checklist',
                ],
                'name' => [
                    'rules' => 'required|max_length[30]',
                    'label' => 'Nama Folding Gate',
                ],
                'kunci_set' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Kunci Set',
                ],
                'daun' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Daun',
                ],
                'silangan' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Silangan',
                ],
                'rangka_cnp' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Rangka CNP',
                ],
                'rangka_unp' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Rangka UNP',
                ],
                'handle' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Handle',
                ],
                'roda_bearing' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Roda Bearing',
                ],
                'rel' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Rel',
                ],
                'jumlah_temuan' => [
                    'rules' => 'required|max_length[10]',
                    'label' => 'Jumlah Temuan',
                ],
                'penjelasan' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Penjelasan',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/foldinggate')->withInput()->with('validation', $validation);
            }

            $dataInput = [
                'location' => session()->get('idstore'),
                'time' => $this->request->getPost('time'),
                'date' => date('Y-m-d'),
                'worker' => session()->get('id'),
                'equipment_checklist' => $this->request->getPost('equipment_checklist'),
                'name' => $this->request->getPost('name'),
                'kunci_set' => $this->request->getPost('kunci_set'),
                'daun' => $this->request->getPost('daun'),
                'silangan' => $this->request->getPost('silangan'),
                'rangka_cnp' => $this->request->getPost('rangka_cnp'),
                'rangka_unp' => $this->request->getPost('rangka_unp'),
                'handle' => $this->request->getPost('handle'),
                'roda_bearing' => $this->request->getPost('roda_bearing'),
                'rel' => $this->request->getPost('rel'),
                'jumlah_temuan' => $this->request->getPost('jumlah_temuan'),
                'penjelasan' => $this->request->getPost('penjelasan'),
            ];

            $input = $this->mGate->save($dataInput);

            if ($input) {
                session()->setFlashdata('success', 'Folding Gate Data has been added');
                return redirect()->to('/foldinggate', 201);
            }

            session()->setFlashdata('error', 'Folding Gate Data has not been added');
            return redirect()->to('/foldinggate', 500);
        }
    }

    public function updateFoldingGate($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'name' => [
                    'rules' => 'required|max_length[30]',
                    'label' => 'Nama Folding Gate',
                ],
                'kunci_set' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Kunci Set',
                ],
                'daun' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Daun',
                ],
                'silangan' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Silangan',
                ],
                'rangka_cnp' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Rangka CNP',
                ],
                'rangka_unp' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Rangka UNP',
                ],
                'handle' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Handle',
                ],
                'roda_bearing' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Roda Bearing',
                ],
                'rel' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Rel',
                ],
                'jumlah_temuan' => [
                    'rules' => 'required|max_length[10]',
                    'label' => 'Jumlah Temuan',
                ],
                'penjelasan' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Penjelasan',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/foldinggate')->withInput()->with('validation', $validation);
            }

            $dataUpdate = [
                'id' => $id,
                'name' => $this->request->getPost('name'),
                'kunci_set' => $this->request->getPost('kunci_set'),
                'daun' => $this->request->getPost('daun'),
                'silangan' => $this->request->getPost('silangan'),
                'rangka_cnp' => $this->request->getPost('rangka_cnp'),
                'rangka_unp' => $this->request->getPost('rangka_unp'),
                'handle' => $this->request->getPost('handle'),
                'roda_bearing' => $this->request->getPost('roda_bearing'),
                'rel' => $this->request->getPost('rel'),
                'jumlah_temuan' => $this->request->getPost('jumlah_temuan'),
                'penjelasan' => $this->request->getPost('penjelasan'),
            ];

            $update = $this->mGate->save($dataUpdate);

            if ($update) {
                session()->setFlashdata('success', 'Folding Gate Data has been edited');
                return redirect()->to('/foldinggate', 200);
            }

            session()->setFlashdata('error', 'Folding Gate Data has not been edited');
            return redirect()->to('/foldinggate', 500);
        }
    }

    public function deleteFoldingGate()
    {
        $delete = $this->mGate->delete($this->request->getPost('id'));
        if ($delete) {
            $response = [
                'success' => true,
            ];
            session()->setFlashdata('success', 'Folding Gate Data has been deleted');
        } else {
            $response = [
                'success' => false,
            ];
            session()->setFlashdata('error', 'Folding Gate Data has not been deleted');
        }
        return $this->response->setJSON($response);
    }

    public function ajaxDataFoldingGate()
    {
        $data = $this->mGate->ajaxDataFoldingGate($this->request->getPost('id'));
        if ($data) {
            $response = [
                'success' => true,
                'data' => $data,
            ];
        } else {
            $response = [
                'success' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function rollingdoor()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'Rolling Door | B.M Apps &copy; Gramedia ' . date('Y');
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

            $data['getDataTableRollingDoor'] = $this->mRollDoor->getDataTableRollingDoor();
            $checklist = $this->mEquip->defaultChecklist(session()->get('idstore'), "equipment_rollingdoor");
            $data['checkInspection'] = $this->mEquip->checkInspection('tb_rolling_door', $checklist['checklist']);
            $data['defaultChecklist'] = $checklist;
            
            return view('vRollingDoor', $data);
        }
    }

    public function saveRollingDoor()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'equipment_checklist' => [
                    'rules' => 'required|in_list[DAILY,WEEKLY,MONTHLY]',
                    'label' => 'Checklist',
                ],
                'name' => [
                    'rules' => 'required|max_length[30]',
                    'label' => 'Nama Folding Gate',
                ],
                'kunci_set' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Kunci Set',
                ],
                'daun_slot' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Daun / Slot',
                ],
                'pulley' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Pulley',
                ],
                'pegas' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Pegas / Per',
                ],
                'as_batang' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'AS Batang',
                ],
                'side_bracket' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Side Bracket',
                ],
                'bottom_t_rail' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Bottom Rail T',
                ],
                'pilar_rel' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Pillar Rel',
                ],
                'jumlah_temuan' => [
                    'rules' => 'required|max_length[10]',
                    'label' => 'Jumlah Temuan',
                ],
                'penjelasan' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Penjelasan',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/rollingdoor')->withInput()->with('validation', $validation);
            }

            $dataInput = [
                'location' => session()->get('idstore'),
                'time' => $this->request->getPost('time'),
                'date' => date('Y-m-d'),
                'worker' => session()->get('id'),
                'equipment_checklist' => $this->request->getPost('equipment_checklist'),
                'name' => $this->request->getPost('name'),
                'kunci_set' => $this->request->getPost('kunci_set'),
                'daun_slot' => $this->request->getPost('daun_slot'),
                'pulley' => $this->request->getPost('pulley'),
                'pegas' => $this->request->getPost('pegas'),
                'as_batang' => $this->request->getPost('as_batang'),
                'side_bracket' => $this->request->getPost('side_bracket'),
                'bottom_t_rail' => $this->request->getPost('bottom_t_rail'),
                'pilar_rel' => $this->request->getPost('pilar_rel'),
                'jumlah_temuan' => $this->request->getPost('jumlah_temuan'),
                'penjelasan' => $this->request->getPost('penjelasan'),
            ];

            $input = $this->mRollDoor->save($dataInput);

            if ($input) {
                session()->setFlashdata('success', 'Rolling Door Data has been added');
                return redirect()->to('/rollingdoor', 201);
            }

            session()->setFlashdata('error', 'Rolling Door Data has not been added');
            return redirect()->to('/rollingdoor', 500);
        }
    }

    public function updateRollingDoor($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'name' => [
                    'rules' => 'required|max_length[30]',
                    'label' => 'Nama Folding Gate',
                ],
                'kunci_set' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Kunci Set',
                ],
                'daun_slot' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Daun / Slot',
                ],
                'pulley' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Pulley',
                ],
                'pegas' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Pegas / Per',
                ],
                'as_batang' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'AS Batang',
                ],
                'side_bracket' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Side Bracket',
                ],
                'bottom_t_rail' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Bottom Rail T',
                ],
                'pilar_rel' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Pillar Rel',
                ],
                'jumlah_temuan' => [
                    'rules' => 'required|max_length[10]',
                    'label' => 'Jumlah Temuan',
                ],
                'penjelasan' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Penjelasan',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/rollingdoor')->withInput()->with('validation', $validation);
            }

            $dataUpdate = [
                'id' => $id,
                'name' => $this->request->getPost('name'),
                'kunci_set' => $this->request->getPost('kunci_set'),
                'daun_slot' => $this->request->getPost('daun_slot'),
                'pulley' => $this->request->getPost('pulley'),
                'pegas' => $this->request->getPost('pegas'),
                'as_batang' => $this->request->getPost('as_batang'),
                'side_bracket' => $this->request->getPost('side_bracket'),
                'bottom_t_rail' => $this->request->getPost('bottom_t_rail'),
                'pilar_rel' => $this->request->getPost('pilar_rel'),
                'jumlah_temuan' => $this->request->getPost('jumlah_temuan'),
                'penjelasan' => $this->request->getPost('penjelasan'),
            ];

            $update = $this->mRollDoor->save($dataUpdate);

            if ($update) {
                session()->setFlashdata('success', 'Rolling Door Data has been edited');
                return redirect()->to('/rollingdoor', 200);
            }

            session()->setFlashdata('error', 'Rolling Door Data has not been edited');
            return redirect()->to('/rollingdoor', 500);
        }
    }

    public function deleteRollingDoor()
    {
        $delete = $this->mRollDoor->delete($this->request->getPost('id'));
        if ($delete) {
            $response = [
                'success' => true,
            ];
            session()->setFlashdata('success', 'Rolling Door Data has been deleted');
        } else {
            $response = [
                'success' => false,
            ];
            session()->setFlashdata('error', 'Rolling Door Data has not been deleted');
        }
        return $this->response->setJSON($response);
    }

    public function ajaxDataRollingDoor()
    {
        $data = $this->mRollDoor->ajaxDataRollingDoor($this->request->getPost('id'));
        if ($data) {
            $response = [
                'success' => true,
                'data' => $data,
            ];
        } else {
            $response = [
                'success' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function firefighting()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'Fire Fighting | B.M Apps &copy; Gramedia ' . date('Y');
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

            $data['getDataTableFireFighting'] = $this->mFireFight->getDataTableFireFighting();
            $checklist = $this->mEquip->defaultChecklist(session()->get('idstore'), "equipment_firefighting");
            $data['checkInspection'] = $this->mEquip->checkInspection('tb_fire_fighting', $checklist['checklist']);
            $data['defaultChecklist'] = $checklist;
            
            return view('vFireFighting', $data);
        }
    }

    public function saveFireFighting()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'equipment_checklist' => [
                    'rules' => 'required|in_list[DAILY,WEEKLY,MONTHLY]',
                    'label' => 'Checklist',
                ],
                'type' => [
                    'rules' => 'required|max_length[30]',
                    'label' => 'Type',
                ],
                'jumlah_zona' => [
                    'rules' => 'required|max_length[30]|numeric',
                    'label' => 'Jumlah Zona',
                ],
                'mcfa_normal' => [
                    'rules' => 'permit_empty|in_list[0,1]',
                    'label' => 'MCFA - Normal',
                ],
                'mcfa_alarm_silenced' => [
                    'rules' => 'permit_empty|in_list[0,1]',
                    'label' => 'MCFA - Alarm Silenced',
                ],
                'mcfa_fire' => [
                    'rules' => 'permit_empty|in_list[0,1]',
                    'label' => 'MCFA - Fire',
                ],
                'mcfa_trouble' => [
                    'rules' => 'permit_empty|in_list[0,1]',
                    'label' => 'MCFA - Trouble',
                ],
                'lt1_smoke_detector' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai 1 - Smoke Detector',
                ],
                'lt1_heat_detector' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai 1 - Heat Detector',
                ],
                'lt1_flow_switch' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai 1 - Flow Switch',
                ],
                'lt2_smoke_detector' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai 2 - Smoke Detector',
                ],
                'lt2_heat_detector' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai 2 - Heat Detector',
                ],
                'lt2_flow_switch' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai 2 - Flow Switch',
                ],
                'lt3_smoke_detector' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai 3 - Smoke Detector',
                ],
                'lt3_heat_detector' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai 3 - Heat Detector',
                ],
                'lt3_flow_switch' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai 3 - Flow Switch',
                ],
                'lt4_smoke_detector' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai 4 - Smoke Detector',
                ],
                'lt4_heat_detector' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai 4 - Heat Detector',
                ],
                'lt4_flow_switch' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai 4 - Flow Switch',
                ],
                'hydrant_pillar' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Hydrant Pillar',
                ],
                'siamese_connection' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Siamese Connection',
                ],
                'lampu_dan_bell' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lampu & Bell',
                ],
                'break_glass' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Break Glass',
                ],
                'jumlah_temuan' => [
                    'rules' => 'required|max_length[10]',
                    'label' => 'Jumlah Temuan',
                ],
                'penjelasan' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Penjelasan',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/firefighting')->withInput()->with('validation', $validation);
            }

            $dataInput = [
                'location' => session()->get('idstore'),
                'time' => $this->request->getPost('time'),
                'date' => date('Y-m-d'),
                'worker' => session()->get('id'),
                'equipment_checklist' => $this->request->getPost('equipment_checklist'),
                'type' => $this->request->getPost('type'),
                'jumlah_zona' => $this->request->getPost('jumlah_zona'),
                'mcfa_normal' => $this->request->getPost('mcfa_normal'),
                'mcfa_alarm_silenced' => $this->request->getPost('mcfa_alarm_silenced'),
                'mcfa_fire' => $this->request->getPost('mcfa_fire'),
                'mcfa_trouble' => $this->request->getPost('mcfa_trouble'),
                'lt1_smoke_detector' => $this->request->getPost('lt1_smoke_detector'),
                'lt1_heat_detector' => $this->request->getPost('lt1_heat_detector'),
                'lt1_flow_switch' => $this->request->getPost('lt1_flow_switch'),
                'lt2_smoke_detector' => $this->request->getPost('lt2_smoke_detector'),
                'lt2_heat_detector' => $this->request->getPost('lt2_heat_detector'),
                'lt2_flow_switch' => $this->request->getPost('lt2_flow_switch'),
                'lt3_smoke_detector' => $this->request->getPost('lt3_smoke_detector'),
                'lt3_heat_detector' => $this->request->getPost('lt3_heat_detector'),
                'lt3_flow_switch' => $this->request->getPost('lt3_flow_switch'),
                'lt4_smoke_detector' => $this->request->getPost('lt4_smoke_detector'),
                'lt4_heat_detector' => $this->request->getPost('lt4_heat_detector'),
                'lt4_flow_switch' => $this->request->getPost('lt4_flow_switch'),
                'hydrant_pillar' => $this->request->getPost('hydrant_pillar'),
                'siamese_connection' => $this->request->getPost('siamese_connection'),
                'lampu_dan_bell' => $this->request->getPost('lampu_dan_bell'),
                'break_glass' => $this->request->getPost('break_glass'),
                'jumlah_temuan' => $this->request->getPost('jumlah_temuan'),
                'penjelasan' => $this->request->getPost('penjelasan'),
            ];

            $input = $this->mFireFight->save($dataInput);

            if ($input) {
                session()->setFlashdata('success', 'Fire Fighting Data has been added');
                return redirect()->to('/firefighting', 201);
            }

            session()->setFlashdata('error', 'Fire Fighting Data has not been added');
            return redirect()->to('/firefighting', 500);
        }
    }

    public function updateFireFighting($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'type' => [
                    'rules' => 'required|max_length[30]',
                    'label' => 'Type',
                ],
                'jumlah_zona' => [
                    'rules' => 'required|max_length[30]|numeric',
                    'label' => 'Jumlah Zona',
                ],
                'mcfa_normal' => [
                    'rules' => 'permit_empty|in_list[0,1]',
                    'label' => 'MCFA - Normal',
                ],
                'mcfa_alarm_silenced' => [
                    'rules' => 'permit_empty|in_list[0,1]',
                    'label' => 'MCFA - Alarm Silenced',
                ],
                'mcfa_fire' => [
                    'rules' => 'permit_empty|in_list[0,1]',
                    'label' => 'MCFA - Fire',
                ],
                'mcfa_trouble' => [
                    'rules' => 'permit_empty|in_list[0,1]',
                    'label' => 'MCFA - Trouble',
                ],
                'lt1_smoke_detector' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai 1 - Smoke Detector',
                ],
                'lt1_heat_detector' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai 1 - Heat Detector',
                ],
                'lt1_flow_switch' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai 1 - Flow Switch',
                ],
                'lt2_smoke_detector' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai 2 - Smoke Detector',
                ],
                'lt2_heat_detector' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai 2 - Heat Detector',
                ],
                'lt2_flow_switch' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai 2 - Flow Switch',
                ],
                'lt3_smoke_detector' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai 3 - Smoke Detector',
                ],
                'lt3_heat_detector' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai 3 - Heat Detector',
                ],
                'lt3_flow_switch' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai 3 - Flow Switch',
                ],
                'lt4_smoke_detector' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai 4 - Smoke Detector',
                ],
                'lt4_heat_detector' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai 4 - Heat Detector',
                ],
                'lt4_flow_switch' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai 4 - Flow Switch',
                ],
                'hydrant_pillar' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Hydrant Pillar',
                ],
                'siamese_connection' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Siamese Connection',
                ],
                'lampu_dan_bell' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lampu & Bell',
                ],
                'break_glass' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Break Glass',
                ],
                'jumlah_temuan' => [
                    'rules' => 'required|max_length[10]',
                    'label' => 'Jumlah Temuan',
                ],
                'penjelasan' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Penjelasan',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/firefighting')->withInput()->with('validation', $validation);
            }

            $dataUpdate = [
                'id' => $id,
                'type' => $this->request->getPost('type'),
                'jumlah_zona' => $this->request->getPost('jumlah_zona'),
                'mcfa_normal' => $this->request->getPost('mcfa_normal'),
                'mcfa_alarm_silenced' => $this->request->getPost('mcfa_alarm_silenced'),
                'mcfa_fire' => $this->request->getPost('mcfa_fire'),
                'mcfa_trouble' => $this->request->getPost('mcfa_trouble'),
                'lt1_smoke_detector' => $this->request->getPost('lt1_smoke_detector'),
                'lt1_heat_detector' => $this->request->getPost('lt1_heat_detector'),
                'lt1_flow_switch' => $this->request->getPost('lt1_flow_switch'),
                'lt2_smoke_detector' => $this->request->getPost('lt2_smoke_detector'),
                'lt2_heat_detector' => $this->request->getPost('lt2_heat_detector'),
                'lt2_flow_switch' => $this->request->getPost('lt2_flow_switch'),
                'lt3_smoke_detector' => $this->request->getPost('lt3_smoke_detector'),
                'lt3_heat_detector' => $this->request->getPost('lt3_heat_detector'),
                'lt3_flow_switch' => $this->request->getPost('lt3_flow_switch'),
                'lt4_smoke_detector' => $this->request->getPost('lt4_smoke_detector'),
                'lt4_heat_detector' => $this->request->getPost('lt4_heat_detector'),
                'lt4_flow_switch' => $this->request->getPost('lt4_flow_switch'),
                'hydrant_pillar' => $this->request->getPost('hydrant_pillar'),
                'siamese_connection' => $this->request->getPost('siamese_connection'),
                'lampu_dan_bell' => $this->request->getPost('lampu_dan_bell'),
                'break_glass' => $this->request->getPost('break_glass'),
                'jumlah_temuan' => $this->request->getPost('jumlah_temuan'),
                'penjelasan' => $this->request->getPost('penjelasan'),
            ];

            $update = $this->mFireFight->save($dataUpdate);

            if ($update) {
                session()->setFlashdata('success', 'Fire Fighting Data has been edited');
                return redirect()->to('/firefighting', 200);
            }

            session()->setFlashdata('error', 'Fire Fighting Data has not been edited');
            return redirect()->to('/firefighting', 500);
        }
    }

    public function deleteFireFighting()
    {
        $delete = $this->mFireFight->delete($this->request->getPost('id'));
        if ($delete) {
            $response = [
                'success' => true,
            ];
            session()->setFlashdata('success', 'Fire Fighting Data has been deleted');
        } else {
            $response = [
                'success' => false,
            ];
            session()->setFlashdata('error', 'Fire Fighting Data has not been deleted');
        }
        return $this->response->setJSON($response);
    }

    public function ajaxDataFireFighting()
    {
        $data = $this->mFireFight->ajaxDataFireFighting($this->request->getPost('id'));
        if ($data) {
            $response = [
                'success' => true,
                'data' => $data,
            ];
        } else {
            $response = [
                'success' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function telppabx()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'Telephone & PABX | B.M Apps &copy; Gramedia ' . date('Y');
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

            $data['getDataTableTelpPabx'] = $this->mTelpPabx->getDataTableTelpPabx();
            $checklist = $this->mEquip->defaultChecklist(session()->get('idstore'), "equipment_telephonepabx");
            $data['checkInspection'] = $this->mEquip->checkInspection('tb_telephone_pabx', $checklist['checklist']);
            $data['defaultChecklist'] = $checklist;
            
            return view('vTelephoneDanPABX', $data);
        }
    }

    public function saveTelpPabx()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'equipment_checklist' => [
                    'rules' => 'required|in_list[DAILY,WEEKLY,MONTHLY]',
                    'label' => 'Checklist',
                ],
                'ruang' => [
                    'rules' => 'required|max_length[30]',
                    'label' => 'Ruang',
                ],
                'lantai' => [
                    'rules' => 'required|max_length[30]',
                    'label' => 'Lantai',
                ],
                'line_co' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Line CO',
                ],
                'line_ext' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Line Ext',
                ],
                'microphone' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Microphone',
                ],
                'kabel_handle' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Kabel Handle',
                ],
                'speaker' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Speaker',
                ],
                'layar_display' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Layar Display',
                ],
                'roset' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Roset',
                ],
                'jumlah_temuan' => [
                    'rules' => 'required|max_length[10]',
                    'label' => 'Jumlah Temuan',
                ],
                'penjelasan' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Penjelasan',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/telppabx')->withInput()->with('validation', $validation);
            }

            $dataInput = [
                'location' => session()->get('idstore'),
                'time' => $this->request->getPost('time'),
                'date' => date('Y-m-d'),
                'worker' => session()->get('id'),
                'equipment_checklist' => $this->request->getPost('equipment_checklist'),
                'ruang' => $this->request->getPost('ruang'),
                'lantai' => $this->request->getPost('lantai'),
                'line_co' => $this->request->getPost('line_co'),
                'line_ext' => $this->request->getPost('line_ext'),
                'microphone' => $this->request->getPost('microphone'),
                'kabel_handle' => $this->request->getPost('kabel_handle'),
                'speaker' => $this->request->getPost('speaker'),
                'layar_display' => $this->request->getPost('layar_display'),
                'roset' => $this->request->getPost('roset'),
                'jumlah_temuan' => $this->request->getPost('jumlah_temuan'),
                'penjelasan' => $this->request->getPost('penjelasan'),
            ];

            $input = $this->mTelpPabx->save($dataInput);

            if ($input) {
                session()->setFlashdata('success', 'Telephone & PABX Data has been added');
                return redirect()->to('/telppabx', 201);
            }

            session()->setFlashdata('error', 'Telephone & PABX Data has not been added');
            return redirect()->to('/telppabx', 500);
        }
    }

    public function updateTelpPabx($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'ruang' => [
                    'rules' => 'required|max_length[30]',
                    'label' => 'Ruang',
                ],
                'lantai' => [
                    'rules' => 'required|max_length[30]',
                    'label' => 'Lantai',
                ],
                'line_co' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Line CO',
                ],
                'line_ext' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Line Ext',
                ],
                'microphone' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Microphone',
                ],
                'kabel_handle' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Kabel Handle',
                ],
                'speaker' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Speaker',
                ],
                'layar_display' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Layar Display',
                ],
                'roset' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Roset',
                ],
                'jumlah_temuan' => [
                    'rules' => 'required|max_length[10]',
                    'label' => 'Jumlah Temuan',
                ],
                'penjelasan' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Penjelasan',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/telppabx')->withInput()->with('validation', $validation);
            }

            $dataUpdate = [
                'id' => $id,
                'ruang' => $this->request->getPost('ruang'),
                'lantai' => $this->request->getPost('lantai'),
                'line_co' => $this->request->getPost('line_co'),
                'line_ext' => $this->request->getPost('line_ext'),
                'microphone' => $this->request->getPost('microphone'),
                'kabel_handle' => $this->request->getPost('kabel_handle'),
                'speaker' => $this->request->getPost('speaker'),
                'layar_display' => $this->request->getPost('layar_display'),
                'roset' => $this->request->getPost('roset'),
                'jumlah_temuan' => $this->request->getPost('jumlah_temuan'),
                'penjelasan' => $this->request->getPost('penjelasan'),
            ];

            $update = $this->mTelpPabx->save($dataUpdate);

            if ($update) {
                session()->setFlashdata('success', 'Telephone & PABX Data has been edited');
                return redirect()->to('/telppabx', 200);
            }

            session()->setFlashdata('error', 'Telephone & PABX Data has not been edited');
            return redirect()->to('/telppabx', 500);
        }
    }

    public function deleteTelpPabx()
    {
        $delete = $this->mTelpPabx->delete($this->request->getPost('id'));
        if ($delete) {
            $response = [
                'success' => true,
            ];
            session()->setFlashdata('success', 'Telephone & PABX Data has been deleted');
        } else {
            $response = [
                'success' => false,
            ];
            session()->setFlashdata('error', 'Telephone & PABX Data has not been deleted');
        }
        return $this->response->setJSON($response);
    }

    public function ajaxDataTelpPabx()
    {
        $data = $this->mTelpPabx->ajaxDataTelpPabx($this->request->getPost('id'));
        if ($data) {
            $response = [
                'success' => true,
                'data' => $data,
            ];
        } else {
            $response = [
                'success' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function housekeeping()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'Housekeeping | B.M Apps &copy; Gramedia ' . date('Y');
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

            $data['getDataTableHousekeeping'] = $this->mHouseKeep->getDataTableHousekeeping();
            $checklist = $this->mEquip->defaultChecklist(session()->get('idstore'), "equipment_housekeeping");
            $data['checkInspection'] = $this->mEquip->checkInspection('tb_housekeeping', $checklist['checklist']);
            $data['defaultChecklist'] = $checklist;
            
            return view('vHousekeeping', $data);
        }
    }

    public function saveHousekeeping()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'equipment_checklist' => [
                    'rules' => 'required|in_list[DAILY,WEEKLY,MONTHLY]',
                    'label' => 'Checklist',
                ],
                'ruang' => [
                    'rules' => 'required|max_length[30]',
                    'label' => 'Ruang',
                ],
                'lantai' => [
                    'rules' => 'required|max_length[3]',
                    'label' => 'Lantai',
                ],
                'kloset' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Kloset',
                ],
                'urinoir' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Urinoir',
                ],
                'washtafel' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Washtafel',
                ],
                'grease_trap' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Grease Trap',
                ],
                'diffuser' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Diffuser',
                ],
                'kebersihan_lantai' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai',
                ],
                'dinding' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Dinding',
                ],
                'cermin' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Kaca / Cermin',
                ],
                'tempat_sampah' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Tempat Sampah',
                ],
                'floor_drainage' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Floor Drainage',
                ],
                'kap_lampu' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Kap Lampu',
                ],
                'hand_dryer' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Hand Dryer',
                ],
                'exhaust_fan' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Exhaust Fan',
                ],
                'air_curtain' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Air Curtain',
                ],
                'plafond' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Plafond',
                ],
                'jumlah_temuan' => [
                    'rules' => 'required|max_length[10]',
                    'label' => 'Jumlah Temuan',
                ],
                'penjelasan' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Penjelasan',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/housekeeping')->withInput()->with('validation', $validation);
            }

            $dataInput = [
                'location' => session()->get('idstore'),
                'time' => $this->request->getPost('time'),
                'date' => date('Y-m-d'),
                'worker' => session()->get('id'),
                'equipment_checklist' => $this->request->getPost('equipment_checklist'),
                'ruang' => $this->request->getPost('ruang'),
                'lantai' => $this->request->getPost('lantai'),
                'kloset' => $this->request->getPost('kloset'),
                'urinoir' => $this->request->getPost('urinoir'),
                'washtafel' => $this->request->getPost('washtafel'),
                'grease_trap' => $this->request->getPost('grease_trap'),
                'diffuser' => $this->request->getPost('diffuser'),
                'kebersihan_lantai' => $this->request->getPost('kebersihan_lantai'),
                'dinding' => $this->request->getPost('dinding'),
                'cermin' => $this->request->getPost('cermin'),
                'tempat_sampah' => $this->request->getPost('tempat_sampah'),
                'floor_drainage' => $this->request->getPost('floor_drainage'),
                'kap_lampu' => $this->request->getPost('kap_lampu'),
                'hand_dryer' => $this->request->getPost('hand_dryer'),
                'exhaust_fan' => $this->request->getPost('exhaust_fan'),
                'air_curtain' => $this->request->getPost('air_curtain'),
                'plafond' => $this->request->getPost('plafond'),
                'jumlah_temuan' => $this->request->getPost('jumlah_temuan'),
                'penjelasan' => $this->request->getPost('penjelasan'),
            ];

            $input = $this->mHouseKeep->save($dataInput);

            if ($input) {
                session()->setFlashdata('success', 'Housekeeping Data has been added');
                return redirect()->to('/housekeeping', 201);
            }

            session()->setFlashdata('error', 'Housekeeping Data has not been added');
            return redirect()->to('/housekeeping', 500);
        }
    }

    public function updateHousekeeping($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'ruang' => [
                    'rules' => 'required|max_length[30]',
                    'label' => 'Ruang',
                ],
                'lantai' => [
                    'rules' => 'required|max_length[3]',
                    'label' => 'Lantai',
                ],
                'kloset' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Kloset',
                ],
                'urinoir' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Urinoir',
                ],
                'washtafel' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Washtafel',
                ],
                'grease_trap' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Grease Trap',
                ],
                'diffuser' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Diffuser',
                ],
                'kebersihan_lantai' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Lantai',
                ],
                'dinding' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Dinding',
                ],
                'cermin' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Kaca / Cermin',
                ],
                'tempat_sampah' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Tempat Sampah',
                ],
                'floor_drainage' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Floor Drainage',
                ],
                'kap_lampu' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Kap Lampu',
                ],
                'hand_dryer' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Hand Dryer',
                ],
                'exhaust_fan' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Exhaust Fan',
                ],
                'air_curtain' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Air Curtain',
                ],
                'plafond' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Plafond',
                ],
                'jumlah_temuan' => [
                    'rules' => 'required|max_length[10]',
                    'label' => 'Jumlah Temuan',
                ],
                'penjelasan' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Penjelasan',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/housekeeping')->withInput()->with('validation', $validation);
            }

            $dataUpdate = [
                'id' => $id,
                'ruang' => $this->request->getPost('ruang'),
                'lantai' => $this->request->getPost('lantai'),
                'kloset' => $this->request->getPost('kloset'),
                'urinoir' => $this->request->getPost('urinoir'),
                'washtafel' => $this->request->getPost('washtafel'),
                'grease_trap' => $this->request->getPost('grease_trap'),
                'diffuser' => $this->request->getPost('diffuser'),
                'kebersihan_lantai' => $this->request->getPost('kebersihan_lantai'),
                'dinding' => $this->request->getPost('dinding'),
                'cermin' => $this->request->getPost('cermin'),
                'tempat_sampah' => $this->request->getPost('tempat_sampah'),
                'floor_drainage' => $this->request->getPost('floor_drainage'),
                'kap_lampu' => $this->request->getPost('kap_lampu'),
                'hand_dryer' => $this->request->getPost('hand_dryer'),
                'exhaust_fan' => $this->request->getPost('exhaust_fan'),
                'air_curtain' => $this->request->getPost('air_curtain'),
                'plafond' => $this->request->getPost('plafond'),
                'jumlah_temuan' => $this->request->getPost('jumlah_temuan'),
                'penjelasan' => $this->request->getPost('penjelasan'),
            ];

            $update = $this->mHouseKeep->save($dataUpdate);

            if ($update) {
                session()->setFlashdata('success', 'Housekeeping Data has been edited');
                return redirect()->to('/housekeeping', 200);
            }

            session()->setFlashdata('error', 'Housekeeping Data has not been edited');
            return redirect()->to('/housekeeping', 500);
        }
    }

    public function deleteHousekeeping()
    {
        $delete = $this->mHouseKeep->delete($this->request->getPost('id'));
        if ($delete) {
            $response = [
                'success' => true,
            ];
            session()->setFlashdata('success', 'Housekeeping Data has been deleted');
        } else {
            $response = [
                'success' => false,
            ];
            session()->setFlashdata('error', 'Housekeeping Data has not been deleted');
        }
        return $this->response->setJSON($response);
    }

    public function ajaxDataHousekeeping()
    {
        $data = $this->mHouseKeep->ajaxDataHousekeeping($this->request->getPost('id'));
        if ($data) {
            $response = [
                'success' => true,
                'data' => $data,
            ];
        } else {
            $response = [
                'success' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function gondola()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'Gondola | B.M Apps &copy; Gramedia ' . date('Y');
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

            $data['getDataTableGondola'] = $this->mGondola->getDataTableGondola();
            $checklist = $this->mEquip->defaultChecklist(session()->get('idstore'), "equipment_gondola");
            $data['checkInspection'] = $this->mEquip->checkInspection('tb_gondola', $checklist['checklist']);
            $data['defaultChecklist'] = $checklist;
            
            return view('vGondola', $data);
        }
    }

    public function saveGondola()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                // TODO cek validasi time di bbrp modul sebelumnya
                'time' => [
                    'rules' => 'required|in_list[10:00:00]',
                    'label' => 'Jam Pengecekan',
                ],
                'equipment_checklist' => [
                    'rules' => 'required|in_list[DAILY,WEEKLY,MONTHLY]',
                    'label' => 'Checklist',
                ],
                'paket_kontrol' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Paket Kontrol',
                ],
                'motor_gerak_rail' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Motor Gerak Rail',
                ],
                'motor_gerak_putar' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Motor Gerak Putar',
                ],
                'motor_gerak_arm' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Motor Gerak Arm',
                ],
                'motor_gerak_keranjang' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Motor Gerak Keranjang',
                ],
                'wire_rope' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Wire Rope',
                ],
                'safety_block' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Safety Block',
                ],
                'gear_box' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Gear Box',
                ],
                'noise' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Noise',
                ],
                'vibrasi' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Vibrasi',
                ],
                'pelumasan' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Pelumasan',
                ],
                'seragam' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Seragam',
                ],
                'id_card' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'ID Card',
                ],
                'helmet' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Helmet',
                ],
                'safety_glasses' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Safety Glasses',
                ],
                'full_body_harnetz' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Full Body Harnetz',
                ],
                'auto_stop' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Auto Stop / Gerigi',
                ],
                'carbiner' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Carbiner',
                ],
                'sarung_tangan' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Sarung Tangan',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/gondola')->withInput()->with('validation', $validation);
            }

            $dataInput = [
                'location' => session()->get('idstore'),
                'time' => $this->request->getPost('time'),
                'date' => date('Y-m-d'),
                'worker' => session()->get('id'),
                'equipment_checklist' => $this->request->getPost('equipment_checklist'),
                'paket_kontrol' => $this->request->getPost('paket_kontrol'),
                'motor_gerak_rail' => $this->request->getPost('motor_gerak_rail'),
                'motor_gerak_putar' => $this->request->getPost('motor_gerak_putar'),
                'motor_gerak_arm' => $this->request->getPost('motor_gerak_arm'),
                'motor_gerak_keranjang' => $this->request->getPost('motor_gerak_keranjang'),
                'wire_rope' => $this->request->getPost('wire_rope'),
                'safety_block' => $this->request->getPost('safety_block'),
                'gear_box' => $this->request->getPost('gear_box'),
                'noise' => $this->request->getPost('noise'),
                'vibrasi' => $this->request->getPost('vibrasi'),
                'pelumasan' => $this->request->getPost('pelumasan'),
                'seragam' => $this->request->getPost('seragam'),
                'id_card' => $this->request->getPost('id_card'),
                'helmet' => $this->request->getPost('helmet'),
                'safety_glasses' => $this->request->getPost('safety_glasses'),
                'full_body_harnetz' => $this->request->getPost('full_body_harnetz'),
                'auto_stop' => $this->request->getPost('auto_stop'),
                'carbiner' => $this->request->getPost('carbiner'),
                'sarung_tangan' => $this->request->getPost('sarung_tangan'),
            ];

            $input = $this->mGondola->save($dataInput);

            if ($input) {
                session()->setFlashdata('success', 'Gondola Data has been added');
                return redirect()->to('/gondola', 201);
            }

            session()->setFlashdata('error', 'Gondola Data has not been added');
            return redirect()->to('/gondola', 500);
        }
    }

    public function updateGondola($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'paket_kontrol' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Paket Kontrol',
                ],
                'motor_gerak_rail' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Motor Gerak Rail',
                ],
                'motor_gerak_putar' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Motor Gerak Putar',
                ],
                'motor_gerak_arm' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Motor Gerak Arm',
                ],
                'motor_gerak_keranjang' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Motor Gerak Keranjang',
                ],
                'wire_rope' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Wire Rope',
                ],
                'safety_block' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Safety Block',
                ],
                'gear_box' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Gear Box',
                ],
                'noise' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Noise',
                ],
                'vibrasi' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Vibrasi',
                ],
                'pelumasan' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Pelumasan',
                ],
                'seragam' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Seragam',
                ],
                'id_card' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'ID Card',
                ],
                'helmet' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Helmet',
                ],
                'safety_glasses' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Safety Glasses',
                ],
                'full_body_harnetz' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Full Body Harnetz',
                ],
                'auto_stop' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Auto Stop / Gerigi',
                ],
                'carbiner' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Carbiner',
                ],
                'sarung_tangan' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Sarung Tangan',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/gondola')->withInput()->with('validation', $validation);
            }

            $dataUpdate = [
                'id' => $id,
                'paket_kontrol' => $this->request->getPost('paket_kontrol'),
                'motor_gerak_rail' => $this->request->getPost('motor_gerak_rail'),
                'motor_gerak_putar' => $this->request->getPost('motor_gerak_putar'),
                'motor_gerak_arm' => $this->request->getPost('motor_gerak_arm'),
                'motor_gerak_keranjang' => $this->request->getPost('motor_gerak_keranjang'),
                'wire_rope' => $this->request->getPost('wire_rope'),
                'safety_block' => $this->request->getPost('safety_block'),
                'gear_box' => $this->request->getPost('gear_box'),
                'noise' => $this->request->getPost('noise'),
                'vibrasi' => $this->request->getPost('vibrasi'),
                'pelumasan' => $this->request->getPost('pelumasan'),
                'seragam' => $this->request->getPost('seragam'),
                'id_card' => $this->request->getPost('id_card'),
                'helmet' => $this->request->getPost('helmet'),
                'safety_glasses' => $this->request->getPost('safety_glasses'),
                'full_body_harnetz' => $this->request->getPost('full_body_harnetz'),
                'auto_stop' => $this->request->getPost('auto_stop'),
                'carbiner' => $this->request->getPost('carbiner'),
                'sarung_tangan' => $this->request->getPost('sarung_tangan'),
            ];

            $update = $this->mGondola->save($dataUpdate);

            if ($update) {
                session()->setFlashdata('success', 'Gondola Data has been edited');
                return redirect()->to('/gondola', 200);
            }

            session()->setFlashdata('error', 'Gondola Data has not been edited');
            return redirect()->to('/gondola', 500);
        }
    }

    public function deleteGondola()
    {
        $delete = $this->mGondola->delete($this->request->getPost('id'));
        if ($delete) {
            $response = [
                'success' => true,
            ];
            session()->setFlashdata('success', 'Gondola Data has been deleted');
        } else {
            $response = [
                'success' => false,
            ];
            session()->setFlashdata('error', 'Gondola Data has not been deleted');
        }
        return $this->response->setJSON($response);
    }

    public function ajaxDataGondola()
    {
        $data = $this->mGondola->ajaxDataGondola($this->request->getPost('id'));
        if ($data) {
            $response = [
                'success' => true,
                'data' => $data,
            ];
        } else {
            $response = [
                'success' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function soundsystem()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'Sound System | B.M Apps &copy; Gramedia ' . date('Y');
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

            $data['getDataTableSoundSystem'] = $this->mSoundSystem->getDataTableSoundSystem();
            $checklist = $this->mEquip->defaultChecklist(session()->get('idstore'), "equipment_soundsystem");
            $data['checkInspection'] = $this->mEquip->checkInspection('tb_sound_system', $checklist['checklist']);
            $data['defaultChecklist'] = $checklist;
            
            return view('vSoundSystem', $data);
        }
    }

    public function saveSoundSystem()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'equipment_checklist' => [
                    'rules' => 'required|in_list[DAILY,WEEKLY,MONTHLY]',
                    'label' => 'Checklist',
                ],
                'amplifier' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Mains Utility - Amplifier',
                ],
                'mixer' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Mains Utility - Mixer',
                ],
                'radio_fm' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Mains Utility - Radio FM',
                ],
                'cd_mp3_player' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Mains Utility - CD/MP3 Player',
                ],
                'switch_zone' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Mains Utility - Switch Zone',
                ],
                'mic_announcer' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Mains Utility - Mic Announcer',
                ],
                'speaker_jumlah' => [
                    'rules' => 'required|is_natural|max_length[10]',
                    'label' => 'Speaker - Jumlah',
                ],
                'speaker_keterangan' => [
                    'rules' => 'required|max_length[500]',
                    'label' => 'Speaker - Keterangan',
                ],
                'car_call' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Features - Car Call',
                ],
                'emergency_evac_system' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Features - Emergency Evac System',
                ],
                'keterangan' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Keterangan',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/soundsystem')->withInput()->with('validation', $validation);
            }

            $dataInput = [
                'location' => session()->get('idstore'),
                'time' => $this->request->getPost('time'),
                'date' => date('Y-m-d'),
                'worker' => session()->get('id'),
                'equipment_checklist' => $this->request->getPost('equipment_checklist'),
                'amplifier' => $this->request->getPost('amplifier'),
                'mixer' => $this->request->getPost('mixer'),
                'radio_fm' => $this->request->getPost('radio_fm'),
                'cd_mp3_player' => $this->request->getPost('cd_mp3_player'),
                'switch_zone' => $this->request->getPost('switch_zone'),
                'mic_announcer' => $this->request->getPost('mic_announcer'),
                'speaker_jumlah' => $this->request->getPost('speaker_jumlah'),
                'speaker_keterangan' => $this->request->getPost('speaker_keterangan'),
                'car_call' => $this->request->getPost('car_call'),
                'emergency_evac_system' => $this->request->getPost('emergency_evac_system'),
                'keterangan' => $this->request->getPost('keterangan'),
            ];

            $input = $this->mSoundSystem->save($dataInput);

            if ($input) {
                session()->setFlashdata('success', 'Sound System Data has been added');
                return redirect()->to('/soundsystem', 201);
            }

            session()->setFlashdata('error', 'Sound System Data has not been added');
            return redirect()->to('/soundsystem', 500);
        }
    }

    public function updateSoundSystem($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'amplifier' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Mains Utility - Amplifier',
                ],
                'mixer' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Mains Utility - Mixer',
                ],
                'radio_fm' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Mains Utility - Radio FM',
                ],
                'cd_mp3_player' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Mains Utility - CD/MP3 Player',
                ],
                'switch_zone' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Mains Utility - Switch Zone',
                ],
                'mic_announcer' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Mains Utility - Mic Announcer',
                ],
                'speaker_jumlah' => [
                    'rules' => 'required|is_natural|max_length[10]',
                    'label' => 'Speaker - Jumlah',
                ],
                'speaker_keterangan' => [
                    'rules' => 'required|max_length[500]',
                    'label' => 'Speaker - Keterangan',
                ],
                'car_call' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Features - Car Call',
                ],
                'emergency_evac_system' => [
                    'rules' => 'required|in_list[0,1]',
                    'label' => 'Features - Emergency Evac System',
                ],
                'keterangan' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Keterangan',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/soundsystem')->withInput()->with('validation', $validation);
            }

            $dataUpdate = [
                'id' => $id,
                'amplifier' => $this->request->getPost('amplifier'),
                'mixer' => $this->request->getPost('mixer'),
                'radio_fm' => $this->request->getPost('radio_fm'),
                'cd_mp3_player' => $this->request->getPost('cd_mp3_player'),
                'switch_zone' => $this->request->getPost('switch_zone'),
                'mic_announcer' => $this->request->getPost('mic_announcer'),
                'speaker_jumlah' => $this->request->getPost('speaker_jumlah'),
                'speaker_keterangan' => $this->request->getPost('speaker_keterangan'),
                'car_call' => $this->request->getPost('car_call'),
                'emergency_evac_system' => $this->request->getPost('emergency_evac_system'),
                'keterangan' => $this->request->getPost('keterangan'),
            ];

            $update = $this->mSoundSystem->save($dataUpdate);

            if ($update) {
                session()->setFlashdata('success', 'Sound System Data has been edited');
                return redirect()->to('/soundsystem', 200);
            }

            session()->setFlashdata('error', 'Sound System Data has not been edited');
            return redirect()->to('/soundsystem', 500);
        }
    }

    public function deleteSoundSystem()
    {
        $delete = $this->mSoundSystem->delete($this->request->getPost('id'));
        if ($delete) {
            $response = [
                'success' => true,
            ];
            session()->setFlashdata('success', 'Sound System Data has been deleted');
        } else {
            $response = [
                'success' => false,
            ];
            session()->setFlashdata('error', 'Sound System Data has not been deleted');
        }
        return $this->response->setJSON($response);
    }

    public function ajaxDataSoundSystem()
    {
        $data = $this->mSoundSystem->ajaxDataSoundSystem($this->request->getPost('id'));
        if ($data) {
            $response = [
                'success' => true,
                'data' => $data,
            ];
        } else {
            $response = [
                'success' => false,
            ];
        }
        return $this->response->setJSON($response);
    }
}
