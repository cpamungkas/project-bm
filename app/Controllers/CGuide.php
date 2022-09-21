<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MGuide;
use App\Models\MEquipment;
use CodeIgniter\HTTP\Request;

class CGuide extends BaseController {
    public function __construct() {
        $this->mGuide = new MGuide();
        $this->mEquipment = new MEquipment();
    }

    public function index() {
        $data['url'] = $this->request->uri->getSegment(1);

        if(!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        else {
            $data['title'] = 'User Guide | B.M Apps &copy; Gramedia ' . date('Y');

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

            $data['getUserGuide'] = $this->mGuide->getUserGuide();

            $data['getStoreEquipmentByStore'] = $this->mEquipment->getStoreEquipmentByStore(session()->get('idstore'));
            
            return view('vGuide', $data);
        }
    }
}
