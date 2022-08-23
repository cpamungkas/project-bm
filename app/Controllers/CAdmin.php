<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MUser;
use App\Models\MStore;
use CodeIgniter\HTTP\Request;

class CAdmin extends BaseController
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
}
