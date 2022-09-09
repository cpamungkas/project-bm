<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MUser;
use App\Models\MStore;
use CodeIgniter\HTTP\Request;

class CWorker extends BaseController
{
    public function __construct()
    {
        $this->mUser = new MUser();
        $this->mStore = new MStore();
        // $this->request = new Request();
        helper(['form', 'url']);
    }

    public function index()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'Dashboard | B.M Apps &copy; Gramedia ' . date('Y');
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
            $data['superior_name_id'] = session()->get('superior_name_id');
            $data['location'] = session()->get('location');
            $data['level'] = session()->get('level');
            $data['status_deleted'] = session()->get('status_deleted');
            $data['totalstore'] = $this->mStore->getTotalStore();
            $data['totaluser'] = $this->mUser->getTotalUser();
            $data['totalequipment'] = 0; //$this->mStore->getTotalEquipment();
            $data['totalmaintenance'] = 0; //$this->mStore->getTotalMaintenance();
            $data['totaloperational'] = 0; //$this->mStore->getTotalOperational();
            $data['totalcomplaint'] = 0; //$this->mStore->getTotalComplaint();
            $data['totalreport'] = 0; //$this->mStore->getTotalReport();
            return view('vWorker', $data);
        }
    }

    public function employee()
    {
        //echo " Hello Employee";

        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'Dashboard | B.M Apps &copy; Gramedia ' . date('Y');
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

            $data['getStore'] = $this->mStore->getStore();
            $data['getDataTableStore'] = $this->mStore->getDataTableStore();
            $data['getKWHMeter1'] = $this->mStore->getKWHMeter1();
            $data['getKWHMeter2'] = $this->mStore->getKWHMeter2();

            if ($data['level'] == 99) {
                $data['getDataRole'] = (new mUser())->getDataRoleAdmin();
                $data['getDataSuperiorRole'] = (new mUser())->getDataSuperiorRole();
            } else {
                $data['getDataRole'] = (new mUser())->getDataRole();
                $data['getDataSuperiorRole'] = (new mUser())->getDataSuperiorRole();
            }
            $data['getDataEmployee'] = (new mUser())->getDataEmployee();
            $data['getDataSuperiorName'] = (new mUser())->getDataSuperiorName();
            $data['getDataLevel'] = (new mUser())->getDataLevel();
            $data['getDataLocation'] = (new mUser())->getDataLocation();

            $data['validation'] = \Config\Services::validation();
            return view('vEmployee', $data);
        }
    }

    public function saveEmployee()
    {
        session();
        $data['url'] = $this->request->uri->getSegment(1);
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;

        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            if (!$this->validate([
                'nik' => [
                    'rules' => 'required|min_length[6]|max_length[6]|is_unique[tb_user.nik]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'min_length' => '{field} too short. min {param} characters.',
                        'max_length' => '{field} must be {param} characters',
                        'is_unique' => '{field} already exists'
                    ],
                    'label' => 'NIK'
                ],
                'nameworker' => [
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'min_length' => '{field} too short. Min {param} characters'

                    ],
                    'label' => 'Name'
                ],
                'initial' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be empty'

                    ],
                    'label' => 'Initial'
                ],
                'email' => [
                    'rules' => 'required|valid_email|is_unique[tb_user.email]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'valid_email' => 'You must provide a valid email address.',
                        'is_unique' => '{field} already exists'
                    ],
                    'label' => 'Email'
                ],
                'username' => [
                    'rules' => 'required|max_length[15]|is_unique[tb_user.email]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} must be {param} characters',
                        'is_unique' => '{field} already exists'
                    ],
                    'label' => 'Username'
                ],
                'password' => [
                    'rules' => 'required|min_length[8]|max_length[32]|alpha_numeric',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'min_length' => 'Your {field} is too short. Min {param} characters.',
                        'max_length' => '{field} max {param} characters',
                        'is_unique' => '{field} already exists'
                    ],
                    'label' => 'Password'
                ],
                'confirmpassword' => [
                    'rules' => 'required|min_length[8]|max_length[32]|alpha_numeric|matches[password]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'min_length' => 'Your {field} is too short. Min {param} characters.',
                        'max_length' => '{field} max {param} characters',
                        'matches' => '{field} does not match!'
                    ],
                    'label' => 'Confirm Password'
                ],

            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/employee')->withInput()->with('validation', $validation);
            }
            $employeeModel = new MUser();
            if ($this->request->getPost('superiorrole') == 13) {
                $superiornameid = 99;
            } else {
                $superiornameid = $this->request->getPost('superiorname');
            }
            $data = [
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT), // $this->request->getPost('password'),
                'nik' => $this->request->getPost('nik'),
                'name' => $this->request->getPost('nameworker'),
                'initial' => $this->request->getPost('initial'),
                'email' => $this->request->getPost('email'),
                'image' => 'default.jpg',
                'is_active' => 1,
                'role_id' => $this->request->getPost('employeerole'),
                'superior_role_id' => $this->request->getPost('superiorrole'),
                'superior_name_id' => $superiornameid, //$this->request->getPost('superiorname'),
                'location' => $this->request->getPost('location'),
                'level' => $this->request->getPost('level'),
                'date_created' => time(),
                'date_updated' => time(),
                'date_deleted' => time(),
                'status_deleted' => 0
            ];

            if ($employeeModel->insert($data)) {
                //$session->setFlashdata("success", "Success. " . "NIK : " . $this->request->getPost('nik') . " has be saved.");
                session()->setFlashdata('success', 'Employee : ' . ucwords($this->request->getPost('name')) . ' has been added');
                return redirect()->to('/employee');
            } else {
                session()->setFlashdata('warning', 'Data not saved!');
                return redirect()->to('/employee');
            }
        }
    }

    public function updateEmployee()
    {
        $session = session();
        $idUrl = $this->request->uri->getSegment(3);
        $userModel = new MUser();

        if (!$session->get('isLoggedIn')) {
            $data['title'] = 'Log In | B.M Apps &copy; Gramedia ' . date('Y');
            return view('vLogin', $data);
        } else {
            //validation           
            $editId = $this->request->getPost('editid');
            $editNIK = $this->request->getPost('editnik');
            $editName = $this->request->getPost('editName');
            $editInitial = $this->request->getPost('editinitial');
            $editEmail = $this->request->getPost('editemail');
            $editUsername = $this->request->getPost('editusername');
            $editPassword = $this->request->getPost('editpassword');
            $editSuperiorRole = $this->request->getPost('editsuperiorrole');
            $editsuperiorname = $this->request->getPost('editsuperiorname');
            $editemployeerole = $this->request->getPost('editemployeerole');
            $editlevel = $this->request->getPost('editlevel');
            $editlocation = $this->request->getPost('editlocation');

            // dd($editsuperiorname);

            $employeeModel = new MUser();
            if ($this->request->getPost('editsuperiorrole') == 13) {
                $superiornameid = 99;
            } else {
                $superiornameid = $this->request->getPost('editsuperiorname');
            }
            $nik = $this->request->getPost('editnik');
            $password = $this->request->getPost('editpassword');
            $data = $userModel->where('nik', $nik)->first();
            $pass = $data['password'];


            if (trim($password) == '') {
                $passwordold = $data['password'];
            } else {
                $passwordold = password_hash($this->request->getPost('editpassword'), PASSWORD_DEFAULT);
            }

            $data = [
                'nik' => $this->request->getPost('editnik'),
                'name' => $this->request->getPost('editname'),
                'initial' => $this->request->getPost('editinitial'),
                'email' => $this->request->getPost('editemail'),
                'username' => $this->request->getPost('editusername'),
                'password' => $passwordold,
                // 'image' => 'default.jpg',
                // 'is_active' => 1,
                'superior_role_id' => $this->request->getPost('editsuperiorrole'),
                'superior_name_id' => $this->request->getPost('editsuperiorname'),
                'role_id' => $this->request->getPost('editemployeerole'),
                'level' => $this->request->getPost('editlevel'),
                'location' => $this->request->getPost('editlocation'),
                'date_updated' => time(),
                'date_deleted' => time(),
                'status_deleted' => 0
            ];

            if ($employeeModel->update($idUrl, $data)) {
                $session->setFlashdata("success", "Worker : " . $this->request->getPost('editname') . " (" . $this->request->getPost('editnik') . ") has been update.");
                return redirect()->to('/employee');
            } else {
                session()->setFlashdata('warning', 'Data not saved!');
                return redirect()->to('/employee');
            }
        }
    }

    public function deleteEmployee()
    {
        $session = session();
        $idUrl = $this->request->uri->getSegment(3);
        $userModel = new MUser();
        if (!$session->get('isLoggedIn')) {
            $data['title'] = 'Log In | B.M Apps &copy; Gramedia ' . date('Y');
            return view('vLogin', $data);
        } else {
            //validation
            $employeeModel = new MUser();
            $data = [
                'date_updated' => time(),
                'date_deleted' => time(),
                'status_deleted' => 1
            ];

            if ($employeeModel->update($idUrl, $data)) {
                $session->setFlashdata("success", "Worker : " . $this->request->getPost('modaldelname') . " (" . $this->request->getPost('modaldelnik') . ") has been deleted.");
                return redirect()->to('/employee');
            } else {
                session()->setFlashdata('warning', 'Data not deleted!');
                return redirect()->to('/employee');
            }
        }
    }

    function getDataSuperiorName2()
    {
        $id = $this->request->getPost('id');
        $data = (new MUser())->getDataSuperiorName2($id);
        echo json_encode($data);
    }

    function getDataSuperiorNameFilter()
    {
        $id = $this->request->getPost('id');
        $data = (new MUser())->getDataSuperiorNameFilter($id);
        // dd($data);
        echo json_encode($data);
    }

    function getDataemployeeById()
    {
        $id = $this->request->getPost('id');
        $data = (new MUser())->getDataemployeeById($id);
        echo json_encode($data);
    }

    public function checkSuperiorRoleAjax()
    {
        $idRole = $this->request->getPost('employeerole');
        $data = (new MUser())->getSuperiorRole($idRole);
        echo json_encode($data);
    }

    public function checkSuperiorNameAjax()
    {
        $idSuperiorRole = $this->request->getPost('idSuperiorName');
        $data = (new MUser())->getSuperiorName($idSuperiorRole);
        echo json_encode($data);
    }

    public function checkFilterSuperiorRoleByEmployeeRole()
    {
        $idFilterSuperiorRole = $this->request->getPost('idSuperiorRole');
        $data = (new MUser())->getFilterSuperiorRoleByEmployeeRole($idFilterSuperiorRole);
        echo json_encode($data);
    }
}
