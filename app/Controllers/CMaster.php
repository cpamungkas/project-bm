<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MUser;
use App\Models\MStore;
use App\Models\MMaster;
use CodeIgniter\HTTP\Request;

class CMaster extends BaseController
{
    public function __construct()
    {
        $this->mUser = new MUser();
        $this->mStore = new MStore();
        $this->mMaster = new MMaster();
        // $this->request = new Request();
        helper(['form', 'url']);
    }

    public function index()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            if (session()->get('level') == 99) {
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
                return view('vAdmin', $data);
            } else {
                return view('404');
            }
        }
    }

    public function indexLevel()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            if (session()->get('level') == 99) {
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
                $data['getDataLevel'] = (new mMaster())->getDataLevel();

                $data['validation'] = \Config\Services::validation();
                return view('admin/vLevel', $data);
            } else {
                return view('404');
            }
        }
    }

    public function saveLevel()
    {
        session();
        $data['url'] = $this->request->uri->getSegment(1);
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;

        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            if (!$this->validate([
                'level' => [
                    'rules' => 'required|is_unique[tb_level.Level]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'is_unique' => '{field} already exists'
                    ],
                    'label' => 'Level'
                ],
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/level')->withInput()->with('validation', $validation);
            }

            $levelModel = new MMaster();
            $data = [
                'Level' => ucwords($this->request->getPost('level')),
                'menu_access' => 0,
                'date_created' => time(),
                'date_updated' => time(),
                'status_deleted' => 0
            ];

            if ($levelModel->insert($data)) {
                session()->setFlashdata('success', 'Level : ' . ucwords($this->request->getPost('level')) . ' has been added');
                return redirect()->to('/level');
            } else {
                session()->setFlashdata('warning', 'Data not saved!');
                return redirect()->to('/level');
            }
        }
    }

    public function updateLevel()
    {
        $session = session();
        $idUrl = $this->request->uri->getSegment(3);

        if (!$session->get('isLoggedIn')) {
            $data['title'] = 'Log In | B.M Apps &copy; Gramedia ' . date('Y');
            return view('vLogin', $data);
        } else {
            //validation           

            $levelModel = new MMaster();
            $data = [
                'Level' => ucwords($this->request->getPost('editlevel')),
                'menu_access' => 0,
                'date_updated' => time(),
            ];

            if ($levelModel->update($idUrl, $data)) {
                $session->setFlashdata("success", "Level : " . $this->request->getPost('editlevel') . " has been updated.");
                return redirect()->to('/level');
            } else {
                session()->setFlashdata('warning', 'Data not saved!');
                return redirect()->to('/level');
            }
        }
    }

    public function deleteLevel()
    {
        $session = session();
        $idUrl = $this->request->uri->getSegment(3);

        if (!$session->get('isLoggedIn')) {
            $data['title'] = 'Log In | B.M Apps &copy; Gramedia ' . date('Y');
            return view('vLogin', $data);
        } else {
            //validation
            $levelModel = new MMaster();
            $data = [
                'date_updated' => time(),
                'date_deleted' => time(),
                'status_deleted' => 1
            ];

            if ($levelModel->update($idUrl, $data)) {
                $session->setFlashdata("success", "Level : " . $this->request->getPost('modaldellevel') . " has been deleted.");
                return redirect()->to('/level');
            } else {
                session()->setFlashdata('warning', 'Data not deleted!');
                return redirect()->to('/level');
            }
        }
    }

    public function indexRole()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            if (session()->get('level') == 99) {
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
                return view('vRole', $data);
            } else {
                return view('404');
            }
        }
    }
    public function indexSuperior()
    {
        $data['url'] = $this->request->uri->getSegment(1);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            if (session()->get('level') == 99) {
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
                return view('vSuperior', $data);
            } else {
                return view('404');
            }
        }
    }
}
