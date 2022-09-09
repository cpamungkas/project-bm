<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MUser;
use App\Models\MStore;
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
        $this->mSchedule = new MSchedule();
        $this->mShiftschedule = new MShiftschedule();
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
            return view('vSchedule', $data);
            // echo " Hello Schedule";
        }
    }

    public function techshift()
    {
        //test

        // echo '<pre>';
        // // var_dump($this->mSchedule->checkFreeShiftSchedule('2022-08-26', 2));
        // $schdule = $this->mSchedule->checkFreeShiftSchedule('2022-08-22', 2);

        // if ($schdule != null) {
        //     echo 'true';
        // }
        //  echo 'false';
        // die;
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

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

        $data['getKWHMeter1'] = $this->mStore->getKWHMeter1();
        $data['getKWHMeter2'] = $this->mStore->getKWHMeter2();

        $data['getDataWorkerByStore'] = $this->mSchedule->getDataWorkerByStore(session()->get('idstore'));
        $data['getDataShift'] = $this->mSchedule->getDataShift();

        $data['validation'] = \Config\Services::validation();


        //? cek admin atau bukan
        if (session()->get('role_id') != 99) {
            //? cek filter tanggal tabel
            if ($this->request->getPost('start_date') != null and $this->request->getPost('end_date') != null) {
                $where = [
                    'tb_job_shift.date >=' => convertDate($this->request->getPost('start_date')),
                    'tb_job_shift.date <=' => convertDate($this->request->getPost('end_date')),
                ];
                $data['getDataTableShift'] = $this->mSchedule->getDataTableTechShift($where, false);
                $data['oldInput'] = [
                    'start_date' => $this->request->getPost('start_date'),
                    'end_date' => $this->request->getPost('end_date'),
                ];
            } else {
                $data['getDataTableShift'] = $this->mSchedule->getDataTableTechShift(null, false);
            }
            return view('vUserScheduletechshift', $data);
        }
        $data['getDataTableShift'] = $this->mSchedule->getDataTableTechShift();

        return view('vScheduletechshift', $data);
    }

    public function techjobout()
    {
        // echo '<pre>';
        // var_dump($this->mSchedule->getDataTableTechJob());
        // die;
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'Job Assignment - OUT | B.M Apps &copy; Gramedia ' . date('Y');
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


            $data['getKWHMeter1'] = $this->mStore->getKWHMeter1();
            $data['getKWHMeter2'] = $this->mStore->getKWHMeter2();

            $data['getDataWorkerByStore'] = $this->mSchedule->getDataWorkerByStore(session()->get('idstore'));

            $data['validation'] = \Config\Services::validation();

            //? cek admin atau bukan
            if (session()->get('role_id') != 99) {
                //? cek filter tanggal tabel
                if ($this->request->getPost('start_date') != null and $this->request->getPost('end_date') != null) {
                    $where = [
                        'tb_job_assignment.start_date >=' => convertDate($this->request->getPost('start_date')),
                        'tb_job_assignment.start_date <=' => convertDate($this->request->getPost('end_date')),
                    ];
                    $data['getDataTableTechJobOut'] = $this->mSchedule->getDataTableTechJob($where, false);
                    $data['oldInput'] = [
                        'start_date' => $this->request->getPost('start_date'),
                        'end_date' => $this->request->getPost('end_date'),
                    ];
                } else {
                    $data['getDataTableTechJobOut'] = $this->mSchedule->getDataTableTechJob(null, false);
                }
                return view('vUserScheduletechjobout', $data);
            }
            $data['getDataTableTechJobOut'] = $this->mSchedule->getDataTableTechJob();

            return view('vScheduletechjobout', $data);
        }
    }

    public function saveTechJobOut()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {

            $rules = [
                'start_date' => [
                    'rules' => 'required|valid_date[d-m-Y]',
                    'label' => 'Start Date',
                ],
                'end_date'  => [
                    'rules' => 'required|valid_date[d-m-Y]',
                    'label' => 'End Date',
                ],
                'to_store' => [
                    'rules' => 'required|numeric',
                    'label' => 'To Store',
                ],
                'name' => [
                    'rules' => 'required|numeric|checkFreeTechJobSchedule[name,start_date,end_date]',
                    'label' => 'Worker Name',
                    'errors' => [
                        'checkFreeTechJobSchedule' => "This employee's schedule is full during the time period!"
                    ],
                ],
                'description' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Description',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/techjobout')->withInput()->with('validation', $validation);
            }
            $dataInput = [
                "start_date"    =>  convertDate($this->request->getPost('start_date')),
                "end_date"      =>  convertDate($this->request->getPost('end_date')),
                "from_store"    =>  session()->get('idstore'),
                "to_store"      =>  $this->request->getPost('to_store'),
                "idUser"        =>  $this->request->getPost('name'),
                "description"   =>  $this->request->getPost('description'),
            ];

            $input = $this->mSchedule->saveTechJobOut($dataInput);

            if ($input) {
                session()->setFlashdata('success', 'Job Assignment OUT has been added');
                return redirect()->to('/techjobout', 201);
            }

            session()->setFlashdata('error', 'Job Assignment OUT has not been added');
            return redirect()->to('/techjobout', 500);
        }
    }

    public function editTechJobOut($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'start_date_edit' => [
                    'rules' => 'required|valid_date[d-m-Y]',
                    'label' => 'Start Date',
                ],
                'end_date_edit'  => [
                    'rules' => 'required|valid_date[d-m-Y]',
                    'label' => 'End Date',
                ],
                'to_store_edit' => [
                    'rules' => 'required|numeric',
                    'label' => 'To Store',
                ],
                'name_edit' => [
                    'rules' => 'required|numeric',
                    'label' => 'Worker Name',
                ],
                'description_edit' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Description',
                ],
            ];

            if (!$this->validate($rules)) {
                session()->setFlashdata('error', 'Job Assignment OUT has not been edited. Data is not valid');
                $validation = \Config\Services::validation();
                return redirect()->to('/techjobout')->withInput()->with('validation', $validation);
            }

            $dataEdit = [
                "start_date"    =>  convertDate($this->request->getPost('start_date_edit')),
                "end_date"      =>  convertDate($this->request->getPost('end_date_edit')),
                "to_store"      =>  $this->request->getPost('to_store_edit'),
                "idUser"        =>  $this->request->getPost('name_edit'),
                "description"   =>  $this->request->getPost('description_edit'),
            ];

            $edit = $this->mSchedule->editTechJobOut($dataEdit, $id);

            if ($edit) {
                session()->setFlashdata('success', 'Job Assignment OUT has been edited');
                return redirect()->to('/techjobout', 200);
            }

            session()->setFlashdata('error', 'Job Assignment OUT has not been edited');
            return redirect()->to('/techjobout', 500);
        }
    }

    public function deleteTechJobOut($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        $delete = $this->mSchedule->deleteTechJobOut($id);

        if ($delete) {
            session()->setFlashdata('success', 'Job Assignment OUT has been deleted');
            return redirect()->to('/techjobout', 200);
        }

        session()->setFlashdata('error', 'Job Assignment OUT has not been deleted');
        return redirect()->to('/techjobout', 500);
    }

    public function techjobin()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'Job Assignment - IN | B.M Apps &copy; Gramedia ' . date('Y');
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
            $tbWhere = [
                "tb_job_assignment.to_store" => session()->get('idstore'),
                "tb_job_assignment.status" => "PENDING",
            ];
            $data['getDataTableTechJobIn'] = $this->mSchedule->getDataTableTechJob($tbWhere);
            $data['getKWHMeter1'] = $this->mStore->getKWHMeter1();
            $data['getKWHMeter2'] = $this->mStore->getKWHMeter2();

            $data['getDataWorkerByStore'] = $this->mSchedule->getDataWorkerByStore(session()->get('idstore'));
            $data['getDataShift'] = $this->mSchedule->getDataShift();

            $data['validation'] = \Config\Services::validation();
            return view('vScheduletechjobin', $data);
        }
    }

    public function submitTechJobIn($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $rules = [
                'description' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Description',
                ],
                'btnSubmitTechJobIn' => [
                    'rules' => 'required|in_list[APPROVED,REJECTED]',
                    'label' => 'Status Approval',
                ],
            ];

            if (!$this->validate($rules)) {
                session()->setFlashdata('error', 'Job Assignment IN has not been edited. Data is not valid');
                $validation = \Config\Services::validation();
                return redirect()->to('/techjobin')->withInput()->with('validation', $validation);
            }

            $dataSubmit = [
                "status"        =>  $this->request->getPost('btnSubmitTechJobIn'),
            ];

            if ($this->request->getPost('btnSubmitTechJobIn') !== "APPROVED") {
                $dataSubmit += ["description"   =>  $this->request->getPost('description')];
            }

            $Submit = $this->mSchedule->editTechJobOut($dataSubmit, $id);

            if ($Submit) {
                session()->setFlashdata('success', 'Job Assignment IN has been submitted');
                return redirect()->to('/techjobin', 200);
            }

            session()->setFlashdata('error', 'Job Assignment IN has not been submitted');
            return redirect()->to('/techjobin', 500);
        }
    }

    public function saveTechShift()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {

            $rules = [
                'date' => [
                    'rules' => 'required|valid_date[d-m-Y]',
                    'label' => 'Date',
                ],
                'name' => [
                    'rules' => 'required|numeric|checkFreeShiftSchedule[' . convertDate($this->request->getPost('date')) . ']',
                    'label' => 'Name',
                    'errors' => [
                        'checkFreeShiftSchedule' => "This employee's schedule is full during the time period!"
                    ],
                ],
                'select_shift'  => [
                    'rules' => 'required|numeric',
                    'label' => 'Shift',
                ],
                'description' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Description',
                ],
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to('/techshift')->withInput()->with('validation', $validation);
            }
            $dataInput = [
                "date"    =>  convertDate($this->request->getPost('date')),
                "idShift"    =>  $this->request->getPost('select_shift'),
                "idStore"      =>  session()->get('idstore'),
                "idUser"        =>  $this->request->getPost('name'),
                "description"   =>  $this->request->getPost('description'),
            ];

            $input = $this->mSchedule->saveTechShift($dataInput);

            if ($input) {
                session()->setFlashdata('success', 'Shift has been added');
                return redirect()->to('/techshift', 201);
            }

            session()->setFlashdata('error', 'Shift has not been added');
            return redirect()->to('/techshift', 500);
        }
    }

    public function editTechShift($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {

            $rules = [
                'date' => [
                    'rules' => 'required|valid_date[d-m-Y]',
                    'label' => 'Date',
                ],
                'name' => [
                    'rules' => 'required|numeric',
                    'label' => 'Name',
                ],
                'select_shift'  => [
                    'rules' => 'required|numeric',
                    'label' => 'Shift',
                ],
                'description' => [
                    'rules' => 'required|max_length[2000]',
                    'label' => 'Description',
                ],
            ];

            if (!$this->validate($rules)) {
                session()->setFlashdata('error', 'Shift has not been edited. Data is not valid');
                $validation = \Config\Services::validation();
                return redirect()->to('/techshift')->withInput()->with('validation', $validation);
            }

            $dataEdit = [
                "date"          =>  convertDate($this->request->getPost('date')),
                "idShift"       =>  $this->request->getPost('select_shift'),
                "idUser"        =>  $this->request->getPost('name'),
                "description"   =>  $this->request->getPost('description'),
            ];

            $edit = $this->mSchedule->editTechShift($dataEdit, $id);

            if ($edit) {
                session()->setFlashdata('success', 'Shift has been edited');
                return redirect()->to('/techshift', 200);
            }

            session()->setFlashdata('error', 'Shift has not been edited');
            return redirect()->to('/techshift', 500);
        }
    }

    public function deleteTechShift($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        $delete = $this->mSchedule->deleteTechShift($id);

        if ($delete) {
            session()->setFlashdata('success', 'Shift has been deleted');
            return redirect()->to('/techshift', 200);
        }

        session()->setFlashdata('error', 'Shift has not been deleted');
        return redirect()->to('/techshift', 500);
    }

    public function checkWorkerShiftAjax()
    {
        $response = [
            'success' => true,
            'worker' => $this->mSchedule->getWorkerFreeShift(convertDate($this->request->getPost('date')), session()->get('idstore'))
        ];
        return $this->response->setJSON($response);
    }

    public function checkWorkerTechJobAjax()
    {
        $response = [
            'success' => true,
            'worker' => $this->mSchedule->checkWorkerTechJobAjax(convertDate($this->request->getPost('start_date')), convertDate($this->request->getPost('end_date')), session()->get('idstore'))
        ];
        return $this->response->setJSON($response);
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
            return view('vScheduletroubleshift', $data);
            // echo " Hello Schedule";
        }
    }

    public function saveShift()
    {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        // echo ($idUrl);
        // die();
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
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

    public function updateShift($id)
    {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        // echo ($idUrl);
        // die();
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
            //25aug2022 30aug2034
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

    public function deleteShift($id = 0)
    {
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
            return view('vScheduletroublejobout', $data);
            // echo " Hello Schedule";
        }
    }

    public function isDateGreaterOrEqual($end_date, $start_date)
    {
        $date1 = date_create($start_date);
        $date2 = date_create($end_date);
        $diff = date_diff($date1, $date2);

        if ($diff->format("%R%a") >= 0)
            return TRUE;
        else
            return FALSE;
    }

    public function isDateGreater($end_date, $start_date)
    {
        $date1 = date_create($start_date);
        $date2 = date_create($end_date);
        $diff = date_diff($date1, $date2);

        if ($diff->format("%R%a") > 0)
            return TRUE;
        else
            return FALSE;
    }

    public function checkExistingScheduleData($worker_id, $dates)
    {
        if (substr($dates, 22) == "") {
            $getScheduleByWorkerId = $this->mSchedule->getScheduleByWorkerId($worker_id);
        } else {
            $getScheduleByWorkerId = $this->mSchedule->getScheduleByWorkerIdException(substr($dates, 21), $worker_id);
        }

        foreach ($getScheduleByWorkerId as $s) {
            if (!($this->isDateGreater(substr($dates, 0, 10), $s['end_date']) ||
                $this->isDateGreater($s['start_date'], substr($dates, 11, 10)))) {
                return FALSE;
            }
        }

        return TRUE;
    }

    public function saveSchedule()
    {
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
                ],
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

    public function updateSchedule($id)
    {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        // echo ($idUrl);
        // die();
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            if (!$this->validate([
                'editstartdate' => [
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'valid_date' => '{field} must be a valid date'
                    ],
                    'label' => 'Start Date'
                ],
                'editenddate' => [
                    'rules' => 'required|valid_date|isDateGreaterOrEqual[' . $this->request->getVar('editstartdate') . ']',
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

    public function deleteSchedule($id = 0)
    {
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

    public function troublejobin()
    {
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
            return view('vScheduletroublejobin', $data);
            // echo " Hello Schedule";
        }
    }

    public function approveRejectSchedule($id = 0)
    {
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
