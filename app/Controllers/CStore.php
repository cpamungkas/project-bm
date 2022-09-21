<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MUser;
use App\Models\MStore;
use App\Models\MEquipment;
use CodeIgniter\HTTP\Request;

class CStore extends BaseController
{
    public function __construct()
    {
        $this->mUser = new MUser();
        $this->mStore = new MStore();
        $this->mEquipment = new MEquipment();

        // $this->request = new Request();
        helper(['form', 'url']);
    }

    public function index()
    {
        session();
        $data['url'] = $this->request->uri->getSegment(1);
        // $data['idUrl'] = $this->request->uri->getSegment(3);

        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $data['title'] = 'Store | B.M Apps &copy; Gramedia ' . date('Y');
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

            $data['validation'] = \Config\Services::validation();

            $data['getStoreEquipmentByStore'] = $this->mEquipment->getStoreEquipmentByStore(session()->get('idstore'));
            
            return view('vStore', $data);
            // echo " Hello STore";
        }
    }

    public function saveStore() {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        // echo ($idUrl);
        // die();
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            if (!$this->validate([
                'storecode' => [
                    'rules' => 'required|max_length[5]|is_unique[tb_store.StoreCode]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'max_length' => '{field} must be {param} characters or fewer',
                        'is_unique' => '{field} already exists'
                    ],
                    'label' => 'Store Code'
                ],
                'storename' => [
                    'rules' => 'required|is_unique[tb_store.StoreName]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'is_unique' => '{field} already exists'
                    ],
                    'label' => 'Store Name'
                ],
                'idpln1' => [
                    'rules' => 'required|min_length[12]|max_length[12]|is_unique[tb_store.idPLN1]',
                    'errors' => [
                        'required' => '{field} cannot be empty',
                        'min_length' => '{field} too short. min {param} characters.',
                        'max_length' => '{field} must be {param} characters',
                        'is_unique' => '{field} already exists'
                    ],
                    'label' => 'ID PLN 1'
                ],
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/store')->withInput()->with('validation', $validation);
            }
            if ($this->request->getPost('kwhmeter1') == 0) {
                session()->setFlashdata('errorkwhmeter1', 'Please fill KWH Meter 1');
                $validation = \Config\Services::validation();
                return redirect()->to('/store')->withInput()->with('validation', $validation);
            }

            if ($this->request->getPost('kwhmeter2') != 0) {
                if (!$this->validate([
                    'idpln2' => [
                        'rules' => 'required|min_length[12]|max_length[12]|is_unique[tb_store.idPLN2]',
                        'errors' => [
                            'required' => '{field} cannot be empty',
                            'min_length' => '{field} too short. min {param} characters.',
                            'max_length' => '{field} must be {param} characters',
                            'is_unique' => '{field} already exists'
                        ],
                        'label' => 'ID PLN 2'
                    ],
                ])) {
                    $validation = \Config\Services::validation();
                    return redirect()->to('/store')->withInput()->with('validation', $validation);
                }
            }

            //$storeModel = new MStore();
            $data['url'] = $this->request->uri->getSegment(1);
            $data = [
                'StoreName' => ucwords($this->request->getPost('storename')),
                'StoreCode' => $this->request->getPost('storecode'),
                'KWHMeter1' => $this->request->getPost('kwhmeter1'),
                'idPLN1' => $this->request->getPost('idpln1'),
                'KWHMeter2' => ($this->request->getPost('kwhmeter2') == 0) ? 1 : $this->request->getPost('kwhmeter2'),
                'idPLN2' => ($this->request->getPost('idpln2') == '') ? 0 : $this->request->getPost('idpln2'),
                'date_created' => time(),
                'date_updated' => time(),
                'status_deleted' => 0
            ];
            if ($this->mStore->insert($data)) {
                session()->setFlashdata('success', 'Store : ' . ucwords($this->request->getPost('storename')) . ' has been added');
                return redirect()->to('/store');
            } else {
                session()->setFlashdata('error', 'Store : ' . ucwords($this->request->getPost('storename')) . ' has not been added');
                return redirect()->to('/store');
            }
        }
    }

    public function updateStore($id) {
        session();
        $idUrl = $this->request->uri->getSegment(3);
        $data['url'] = $idUrl;
        // echo ($idUrl);
        // die();
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            if ($this->request->getPost('editstorecode') == '') {
                if (!$this->validate([
                    'editstorecode' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} cannot be empty'
                        ],
                        'label' => 'Store Code'
                    ],
                ])) {

                    $validation = \Config\Services::validation();
                    return redirect()->to('/store')->withInput()->with('validation', $validation);
                }
            }

            if ($this->request->getPost('editstorename') == '') {
                if (!$this->validate([
                    'editstorename' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} cannot be empty'
                        ],
                        'label' => 'Store Name'
                    ],
                ])) {
                    // echo json_encode(array("status" => FALSE));
                    $validation = \Config\Services::validation();
                    //echo json_encode($validation);

                    session()->setFlashdata('error', 'store name cannot be empty');
                    return redirect()->to('/store')->withInput()->with('validation', $validation);
                    //return redirect()->to('/store');
                }
            }

            $idpln1 = $this->request->getPost('editidpln1', true);
            if ($idpln1 == "") {
                if (!$this->validate([
                    'editidpln1' => [
                        'rules' => 'required|min_length[12]|max_length[12]',
                        'errors' => [
                            'required' => '{field} cannot be empty',
                            'min_length' => '{field} too short, min {param} characters.',
                            'max_length' => '{field} must be {param} characters',
                        ],
                        'label' => 'ID PLN 1'
                    ],
                ])) {
                    echo json_encode(array("status" => FALSE));
                    $validation = \Config\Services::validation();
                    return redirect()->to('/store')->withInput()->with('validation', $validation);
                }
            }

            // if ($this->request->getPost('editidpln1') == ' ') {
            //     if (!$this->validate([
            //         'editidpln1' => [
            //             'rules' => 'required|min_length[12]|max_length[12]',
            //             'errors' => [
            //                 'required' => '{field} cannot be empty',
            //                 'min_length' => '{field} too short, min {param} characters.',
            //                 'max_length' => '{field} must be {param} characters',
            //             ],
            //             'label' => 'ID PLN 1'
            //         ],
            //     ])) {
            //         $validation = \Config\Services::validation();
            //         return redirect()->to('/store')->withInput()->with('validation', $validation);
            //     }
            // }


            // if (!$this->validate([
            //     'modaleditstorecode' => [
            //         'rules' => 'required',
            //         'errors' => [
            //             'required' => '{field} cannot be empty',
            //             'max_length' => '{field} must be {param} characters or fewer'                      
            //         ],
            //         'label' => 'Store Code'
            //     ],
            //     'modaleditstorename' => [
            //         'rules' => 'required',
            //         'errors' => [
            //             'required' => '{field} cannot be empty'
            //         ],
            //         'label' => 'Store Name'
            //     ],
            //     'modaleditidpln1' => [
            //         'rules' => 'required|min_length[12]|max_length[12]',
            //         'errors' => [
            //             'required' => '{field} cannot be empty',
            //             'min_length' => '{field} too short, min {param} characters.',
            //             'max_length' => '{field} must be {param} characters or fewer'
            //         ],
            //         'label' => 'ID PLN 1'
            //     ],
            // ])) {
            //     $validation = \Config\Services::validation();
            //     return redirect()->to('/store')->withInput()->with('validation', $validation);
            // }

            // if ($this->request->getPost('modaleditkwhmeter1') == 0) {
            //     session()->setFlashdata('errormodaleditkwhmeter1', 'Please fill KWH Meter 1');
            //     $validation = \Config\Services::validation();
            //     return redirect()->to('/store')->withInput()->with('validation', $validation);
            // }

            $data = [
                'StoreName' => ucwords($this->request->getVar('editstorename')),
                'StoreCode' => $this->request->getVar('editstorecode'),
                'KWHMeter1' => $this->request->getVar('editkwhmeter1'),
                'idPLN1' => $this->request->getVar('editidpln1'),
                'KWHMeter2' => ($this->request->getVar('editkwhmeter2') == 0) ? 1 : $this->request->getVar('editkwhmeter2'),
                'idPLN2' => ($this->request->getVar('editidpln2') == '') ? 0 : $this->request->getVar('editidpln2'),
                'date_updated' => time(),
                'status_deleted' => 0
            ];
            // dd($data);

            if ($this->mStore->update($idUrl, $data)) {
                //echo json_encode(array("status" => TRUE));
                session()->setFlashdata("success", "Store " . ucwords($this->request->getVar('editstorename')) . " has been updated.");
                return redirect()->to('/store');
            } else {
                //echo json_encode(array("status" => FALSE));
                session()->setFlashdata('error', 'Data not saved!');
                return redirect()->to('/store');
            }
        }
    }

    public function deleteStore($id = 0) {
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
                'date_deleted' => time(),
                'status_deleted' => 1
            ];

            if ($this->mStore->update($idUrl, $data)) {
                session()->setFlashdata("success", "Store " . ucwords($this->request->getPost('modaldeletestorename')) . " has been deleted.");
                return redirect()->to('/store');
            } else {
                session()->setFlashdata('warning', 'Data not deleted!');
                return redirect()->to('/store');
            }
        }
    }
}
