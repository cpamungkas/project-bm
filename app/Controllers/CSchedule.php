<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MUser;
use App\Models\MStore;
use App\Models\MEquipment;
use App\Models\MSchedule;
use App\Models\MShiftschedule;
use CodeIgniter\HTTP\Request;
use CodeIgniter\I18n\Time;

class CSchedule extends BaseController
{
    public function __construct()
    {
        $this->mUser = new MUser();
        $this->mStore = new MStore();
        $this->mEquipment = new MEquipment();
        $this->mSchedule = new MSchedule();
        $this->mShiftschedule = new MShiftschedule();
        helper(['form', 'url']);
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

            $data['getStoreEquipmentByStore'] = $this->mEquipment->getStoreEquipmentByStore(session()->get('idstore'));

            return view('vSchedule', $data);
            // echo " Hello Schedule";
        }
    }

    public function techshift()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'Schedule Shift | B.M Apps &copy; Gramedia ' . date('Y');
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

            $data['getStore'] = $this->mStore->getStore();
            $data['getDataTableStore'] = $this->mStore->getDataTableStore();
            $data['getKWHMeter1'] = $this->mStore->getKWHMeter1();
            $data['getKWHMeter2'] = $this->mStore->getKWHMeter2();

            $data['getDataWorkerByStore'] = $this->mSchedule->getDataWorkerByStore(session()->get('idstore'));
            $data['getDataShift'] = $this->mSchedule->getDataShift();

            $data['validation'] = \Config\Services::validation();

            $data['getStoreEquipmentByStore'] = $this->mEquipment->getStoreEquipmentByStore(session()->get('idstore'));

            return view('vScheduletechshift', $data);
            // echo " Hello Schedule";
        }
    }

    public function checkWorkerShiftAjax() {
        $response = [
            'success' => true,
            'worker' => $this->mShiftschedule->getWorkerFreeShift($this->request->getPost('date'), session()->get('idstore'))
        ];
        return $this->response->setJSON($response);
    }

    // public function checkEditWorkerShiftAjax() {
    //     $response = [
    //         'success' => true,
    //         'worker' => $this->mShiftschedule->getWorkerFreeShiftException($this->request->getPost('editid'), $this->request->getPost('editdate'), session()->get('idstore'))
    //     ];
    //     return $this->response->setJSON($response);
    // }

    public function checkWorkerJobAjax() {
        $response = [
            'success' => true,
            'worker' => $this->mSchedule->getWorkerFreeJob($this->request->getPost('start_date'), $this->request->getPost('end_date'), session()->get('idstore'))
        ];
        return $this->response->setJSON($response);
    }

    public function checkExistingShiftData($worker_id, $dates) {
        if(substr($dates, 22) == "") {
            $getShiftScheduleByWorkerId = $this->mShiftschedule->getShiftScheduleByWorkerId($worker_id);
        }
        else {
            $getShiftScheduleByWorkerId = $this->mShiftschedule->getShiftScheduleByWorkerIdException(substr($dates, 21), $worker_id);
        }

        foreach($getShiftScheduleByWorkerId as $s) {
            if(!($this->isDateGreater(substr($dates, 0, 10), $s['date']) ||
                $this->isDateGreater($s['date'], substr($dates, 11, 10)))
            ) {
                return FALSE;
            }
        }

        return TRUE;
    }

    public function troubleshift()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'Schedule Shift | B.M Apps &copy; Gramedia ' . date('Y');
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

            $data['getStore'] = $this->mStore->getStore();
            $data['getDataTableStore'] = $this->mStore->getDataTableStore();
            $data['getKWHMeter1'] = $this->mStore->getKWHMeter1();
            $data['getKWHMeter2'] = $this->mStore->getKWHMeter2();

            $data['getDataWorkerByStore'] = $this->mSchedule->getDataWorkerByStore(session()->get('idstore'));
            $data['getDataShift'] = $this->mSchedule->getDataShift();

            $data['getShiftScheduleByStore'] = $this->mShiftschedule->getShiftScheduleByStore(session()->get('idstore'));

            $data['validation'] = \Config\Services::validation();

            $data['getStoreEquipmentByStore'] = $this->mEquipment->getStoreEquipmentByStore(session()->get('idstore'));

            if($data['role_id'] == 99) {
                return view('vScheduletroubleshift', $data);
            }
            else {
                return view('vFrontscheduletroubleshift', $data);
            }
            // echo " Hello Schedule";
        }
    }

    public function applyShiftFilter() {
        session();
        echo "<script>console.log('filter 1');</script>";
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'filter_start_date' => [
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'valid_date' => '{field} must be a valid date'
                    ],
                    'label' => 'Start Date'
                ],
                'filter_end_date' => [
                    'rules' => 'required|valid_date|isDateGreaterOrEqual[' . $this->request->getPost('filter_start_date') . ']',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'valid_date' => '{field} must be a valid date',
                        'isDateGreaterOrEqual' => '{field} must be greater than or equal to start date'
                    ],
                    'label' => 'End Date'
                ]
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/troubleshift')->withInput()->with('validation', $validation);
            }

            session()->setFlashdata('filterapplied', true);
            return redirect()->to('/troubleshift')->withInput();
        }
    }

    public function saveShift() {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        // echo ($idUrl);
        // die();
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if (!$this->validate([
                'date' => [
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'valid_date' => '{field} must be a valid date'
                    ],
                    'label' => 'Date'
                ],
                'worker_id' => [
                    'rules' => 'required|checkExistingShiftData[' . $this->request->getPost('date') . ' ' . $this->request->getPost('date') . ']',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'checkExistingShiftData' => "This employee's schedule is full during the time period"
                    ],
                    'label' => 'Name'
                ],
                'description' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Description'
                ],
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/troubleshift')->withInput()->with('validation', $validation);
            }

            $data['url'] = $this->request->uri->getSegment(1);
            $data = [
                'date' => $this->request->getPost('date'),
                'store' => $this->request->getPost('store'),
                'worker_id' => $this->request->getPost('worker_id'),
                'shift' => $this->request->getPost('shift'),
                'description' => $this->request->getPost('description'),
                'date_created' => time(),
                'date_updated' => time(),
                'status_deleted' => 0
            ];
            if ($this->mShiftschedule->insert($data)) {
                session()->setFlashdata('success', 'Shift has been added');
                return redirect()->to('/troubleshift');
            } else {
                session()->setFlashdata('error', 'Fail to add shift');
                return redirect()->to('/troubleshift');
            }
        }
    }

    public function updateShift($id) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        // echo ($idUrl);
        // die();
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            if (!$this->validate([
                'editdate' => [
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'valid_date' => '{field} must be a valid date'
                    ],
                    'label' => 'Date'
                ],
                'editworker' => [
                    'rules' => 'required|checkExistingShiftData[' . $this->request->getVar('editdate') . ' ' . $this->request->getVar('editdate') . ' ' . $id . ']',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'checkExistingShiftData' => "This employee's schedule is full during the time period"
                    ],
                    'label' => 'Name'
                ],
                'editdescription' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Description'
                ],
                'editshift' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'
                    ],
                    'label' => 'Shift'
                ]
            ])) {
                $validation = \Config\Services::validation();
                session()->setFlashdata('error', 'Fail to update shift, input invalid');
                return redirect()->to('/troubleshift')->withInput()->with('validation', $validation);
            }

            $data = [
                'date' => $this->request->getVar('editdate'),
                'worker_id' => $this->request->getVar('editworker'),
                'shift' => $this->request->getVar('editshift'),
                'description' => $this->request->getVar('editdescription'),
                'date_updated' => time(),
                'status_deleted' => 0
            ];
            // dd($data);

            if ($this->mShiftschedule->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Shift has been updated');
                return redirect()->to('/troubleshift');
            } else {
                session()->setFlashdata('error', 'Fail to update shift');
                return redirect()->to('/troubleshift');
            }
        }
    }

    public function deleteShift($id = 0) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        // echo ($id);
        // die();
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data = [
                'date_updated' => time(),
                'status_deleted' => 1
            ];

            if ($this->mShiftschedule->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Shift has been deleted');
                return redirect()->to('/troubleshift');
            } else {
                session()->setFlashdata('warning', 'Fail to delete shift');
                return redirect()->to('/troubleshift');
            }
        }
    }

    public function troublejobout()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'Schedule Job - OUT | B.M Apps &copy; Gramedia ' . date('Y');
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

            $data['getStore'] = $this->mStore->getStore();
            $data['getDataTableStore'] = $this->mStore->getDataTableStore();
            $data['getKWHMeter1'] = $this->mStore->getKWHMeter1();
            $data['getKWHMeter2'] = $this->mStore->getKWHMeter2();

            $data['getDataWorkerByStore'] = $this->mSchedule->getDataWorkerByStore(session()->get('idstore'));
            $data['getDataShift'] = $this->mSchedule->getDataShift();

            $data['getScheduleByStoreOut'] = $this->mSchedule->getScheduleByStoreOut(session()->get('idstore'));

            $data['validation'] = \Config\Services::validation();

            $data['getStoreEquipmentByStore'] = $this->mEquipment->getStoreEquipmentByStore(session()->get('idstore'));

            if($data['role_id'] == 99) {
                return view('vScheduletroublejobout', $data);
            }
            else {
                return view('vFrontscheduletroublejobout', $data);
            }
            // echo " Hello Schedule";
        }
    }

    public function applyScheduleOutFilter() {
        session();
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'filter_start_date' => [
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'valid_date' => '{field} must be a valid date'
                    ],
                    'label' => 'Start Date'
                ],
                'filter_end_date' => [
                    'rules' => 'required|valid_date|isDateGreaterOrEqual[' . $this->request->getPost('filter_start_date') . ']',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'valid_date' => '{field} must be a valid date',
                        'isDateGreaterOrEqual' => '{field} must be greater than or equal to start date'
                    ],
                    'label' => 'End Date'
                ]
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/troublejobout')->withInput()->with('validation', $validation);
            }

            session()->setFlashdata('filterapplied', true);
            return redirect()->to('/troublejobout')->withInput();
        }
    }

    public function applyScheduleInFilter() {
        session();
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            if(!$this->validate([
                'filter_start_date' => [
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'valid_date' => '{field} must be a valid date'
                    ],
                    'label' => 'Start Date'
                ],
                'filter_end_date' => [
                    'rules' => 'required|valid_date|isDateGreaterOrEqual[' . $this->request->getPost('filter_start_date') . ']',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'valid_date' => '{field} must be a valid date',
                        'isDateGreaterOrEqual' => '{field} must be greater than or equal to start date'
                    ],
                    'label' => 'End Date'
                ]
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/troublejobin')->withInput()->with('validation', $validation);
            }

            session()->setFlashdata('filterapplied', true);
            return redirect()->to('/troublejobin')->withInput();
        }
    }

    public function isDateGreaterOrEqual($end_date, $start_date) {
        $date1 = date_create($start_date);
        $date2 = date_create($end_date);
        $diff = date_diff($date1, $date2);

        if($diff->format("%R%a") >= 0)
            return TRUE;
        else
            return FALSE;
    }

    public function isDateGreater($end_date, $start_date) {
        $date1 = date_create($start_date);
        $date2 = date_create($end_date);
        $diff = date_diff($date1, $date2);

        if($diff->format("%R%a") > 0)
            return TRUE;
        else
            return FALSE;
    }

    public function checkExistingScheduleData($worker_id, $dates) {
        if(substr($dates, 22) == "") {
            $getScheduleByWorkerId = $this->mSchedule->getScheduleByWorkerId($worker_id);
        }
        else {
            $getScheduleByWorkerId = $this->mSchedule->getScheduleByWorkerIdException(substr($dates, 21), $worker_id);
        }

        foreach($getScheduleByWorkerId as $s) {
            if(!($this->isDateGreater(substr($dates, 0, 10), $s['end_date']) ||
                $this->isDateGreater($s['start_date'], substr($dates, 11, 10)))
            ) {
                return FALSE;
            }
        }

        return TRUE;
    }

    public function saveSchedule() {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        // echo ($idUrl);
        // die();
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            if (!$this->validate([
                'start_date' => [
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'valid_date' => '{field} must be a valid date'
                    ],
                    'label' => 'Start Date'
                ],
                'end_date' => [
                    'rules' => 'required|valid_date|isDateGreaterOrEqual[' . $this->request->getPost('start_date') . ']',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'valid_date' => '{field} must be a valid date',
                        'isDateGreaterOrEqual' => '{field} must be greater than or equal to start date'
                    ],
                    'label' => 'End Date'
                ],
                'worker_id' => [
                    'rules' => 'required|checkExistingScheduleData[' . $this->request->getPost('start_date') . ' ' . $this->request->getPost('end_date') . ']',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'checkExistingScheduleData' => "This employee's schedule is full during the time period"
                    ],
                    'label' => 'Name'
                ],
                'description' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Description'
                ]
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/troublejobout')->withInput()->with('validation', $validation);
            }

            $data['url'] = $this->request->uri->getSegment(1);
            $data = [
                'start_date' => $this->request->getPost('start_date'),
                'end_date' => $this->request->getPost('end_date'),
                'init_store' => $this->request->getPost('init_store'),
                'dest_store' => $this->request->getPost('dest_store'),
                'worker_id' => $this->request->getPost('worker_id'),
                'description' => $this->request->getPost('description'),
                'date_created' => time(),
                'date_updated' => time(),
                'status_approved' => 0,
                'status_deleted' => 0
            ];
            if ($this->mSchedule->insert($data)) {
                session()->setFlashdata('success', 'Job assignment schedule has been added');
                return redirect()->to('/troublejobout');
            } else {
                session()->setFlashdata('error', 'Fail to add job assignment schedule');
                return redirect()->to('/troublejobout');
            }
        }
    }

    public function updateSchedule($id) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        // echo ($idUrl);
        // die();
        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            if(!$this->validate([
                'editstartdate' => [
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'valid_date' => '{field} must be a valid date'
                    ],
                    'label' => 'Start Date'
                ],
                'editenddate' => [
                    'rules' => 'required|valid_date|isDateGreaterOrEqual['. $this->request->getVar('editstartdate') . ']',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'valid_date' => '{field} must be a valid date',
                        'isDateGreaterOrEqual' => '{field} must be greater than or equal to start date'
                    ],
                    'label' => 'End Date'
                ],
                'editworker' => [
                    'rules' => 'required|checkExistingScheduleData[' . $this->request->getVar('editstartdate') . ' ' . $this->request->getVar('editenddate') . ' ' . $id . ']',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'checkExistingScheduleData' => "This employee's schedule is full during the time period"
                    ],
                    'label' => 'Name'
                ],
                'editdescription' => [
                    'rules' => 'max_length[2000]',
                    'errors' => [
                        'max_length' => '{field} too long: Max {param} characters'
                    ],
                    'label' => 'Description'
                ]
            ])) {
                $validation = \Config\Services::validation();
                session()->setFlashdata('error', 'Fail to update job schedule, input invalid');
                return redirect()->to('/troublejobout')->withInput()->with('validation', $validation);
            }

            $data = [
                'start_date' => $this->request->getVar('editstartdate'),
                'end_date' => $this->request->getVar('editenddate'),
                'dest_store' => $this->request->getVar('editdeststore'),
                'worker_id' => $this->request->getVar('editworker'),
                'description' => $this->request->getVar('editdescription'),
                'date_updated' => time(),
                'status_deleted' => 0
            ];
            // dd($data);

            if ($this->mSchedule->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Job schedule has been updated');
                return redirect()->to('/troublejobout');
            } else {
                session()->setFlashdata('error', 'Fail to update job schedule');
                return redirect()->to('/troublejobout');
            }
        }
    }

    public function deleteSchedule($id = 0) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        // echo ($id);
        // die();
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data = [
                'date_updated' => time(),
                'status_deleted' => 1
            ];

            if ($this->mSchedule->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Job schedule has been deleted');
                return redirect()->to('/troublejobout');
            } else {
                session()->setFlashdata('warning', 'Fail to delete job schedule');
                return redirect()->to('/troublejobout');
            }
        }
    }

    public function troublejobin() {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'Schedule Job - IN | B.M Apps &copy; Gramedia ' . date('Y');
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

            $data['showModal'] = session()->get('showModal');
            $data['location'] = session()->get('location');
            $data['level'] = session()->get('level');
            $data['status_deleted'] = session()->get('status_deleted');

            $data['getStore'] = $this->mStore->getStore();
            $data['getDataTableStore'] = $this->mStore->getDataTableStore();
            $data['getKWHMeter1'] = $this->mStore->getKWHMeter1();
            $data['getKWHMeter2'] = $this->mStore->getKWHMeter2();

            $data['getDataWorkerByStore'] = $this->mSchedule->getDataWorkerByStore(session()->get('idstore'));
            $data['getDataShift'] = $this->mSchedule->getDataShift();

            $data['getScheduleByStoreIn'] = $this->mSchedule->getScheduleByStoreIn(session()->get('idstore'));

            $data['validation'] = \Config\Services::validation();

            $data['getStoreEquipmentByStore'] = $this->mEquipment->getStoreEquipmentByStore(session()->get('idstore'));

            if($data['role_id'] == 99) {
                return view('vScheduletroublejobin', $data);
            }
            else {
                return redirect()->to('/404');
            }
            // echo " Hello Schedule";
        }
    }

    public function approveRejectSchedule($id = 0) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        // echo ($id);
        // die();
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data = [
                'date_updated' => time(),
                'status_approved' => $this->request->getVar('modalapproverejectdescription')
            ];

            if ($this->mSchedule->update($idUrl, $data)) {
                session()->setFlashdata('success', 'Job schedule approval status has been updated');
                return redirect()->to('/troublejobin');
            } else {
                session()->setFlashdata('warning', 'Fail to update job schedule approval status');
                return redirect()->to('/troublejobin');
            }
        }
    }
}
