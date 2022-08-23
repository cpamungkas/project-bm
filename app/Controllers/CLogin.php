<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MUser;
use CodeIgniter\HTTP\Request;

class CLogin extends BaseController
{
    public function __construct()
    {
        $this->mUser = new MUser();
        // $this->request = new Request();
        helper(['form', 'url']);
    }

    public function index()
    {
        $data['captcha'] = $this->_get_captcha(4) . '' . $this->_get_captcha(3) . '' . $this->_get_captcha(2);
        return view('vLogin', $data);
    }

    public function login()
    {
        echo "login";
    }

    public function loginAuth()
    {
        helper(['form', 'url']);
        if (strtolower($this->request->getPost('captcha_real')) == strtolower($this->request->getPost('captcha'))) {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $data = $this->mUser->getUser($username);
            if ($data) {
                if (password_verify($password, $data['password'])) {
                    session()->set('id', $data['id']);
                    session()->set('username', $data['username']);
                    session()->set('name', $data['name']);
                    session()->set('nik', $data['nik']);
                    session()->set('email', $data['email']);
                    session()->set('image', $data['image']);
                    session()->set('initial', $data['initial']);
                    session()->set('is_active', $data['is_active']);
                    session()->set('role_id', $data['role_id']);

                    $dataRole = $this->mUser->getDataRoleUser($data['role_id']);
                    session()->set('roleuser', $dataRole->role);

                    session()->set('superior_role_id', $data['superior_role_id']);
                    session()->set('level', $data['level']);
                    session()->set('idstore', $data['location']);
                    $dataLocation = $this->mUser->getLocationByUser($data['location']);
                    session()->set('location', $dataLocation->location);
                    session()->set('isLoggedIn', TRUE);

                    if (session()->get('level') == 99) {
                        session()->setFlashdata('loginsuccessmsg', 'Hello, ' . $data['name']);
                        return redirect()->to('/admin');
                    } elseif (session()->get('level') == 1) {
                        session()->setFlashdata('loginsuccessmsg', 'Hello, ' . $data['name']);
                        return redirect()->to('/manager'); //dashboard manager
                    } elseif (session()->get('level') == 2) {
                        session()->setFlashdata('loginsuccessmsg', 'Hello, ' . $data['name']);
                        return redirect()->to('/supervisor'); //dashboard superior or superintendent
                    } elseif (session()->get('level') == 3) {
                        session()->setFlashdata('loginsuccessmsg', 'Hello, ' . $data['name']);
                        return redirect()->to('/worker'); //dashboard worker or user
                    } else {
                        return redirect()->to('/');
                    }
                } else {
                    session()->setFlashdata('error', 'Password incorrect');
                    return redirect()->to('/');
                }
            } else {
                session()->setFlashdata('error', 'NIK not found');
                return redirect()->to('/');
            }
        } else {
            session()->setFlashdata('error', 'Captcha code was not match, please try again');
            return redirect()->to('/');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    private function _get_captcha($param)
    {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $num = range(0, 63);
        $result = '';
        shuffle($num);
        for ($x = 0; $x < $param; $x++) {
            $result .= substr($alphabet, $num[$x], 1);
        }
        return $result;
    }
}
