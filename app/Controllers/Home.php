<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $session = session();
        $data['url'] = $this->request->uri->getSegment(1);
        if (!$session->get('isLoggedIn')) {
            $data['captcha'] = $this->_get_captcha(4) . '' . $this->_get_captcha(2) . '' . $this->_get_captcha(3);
            return view('vLogin', $data);
        } else {
            if (session()->get('level') == 99) {
                return redirect()->to('/admin');
            } elseif (session()->get('level') == 1) {
                return redirect()->to('/manager'); //dashboard manager
            } elseif (session()->get('level') == 2) {
                return redirect()->to('/supervisor'); //dashboard superior or superintendent
            } elseif (session()->get('level') == 3) {
                return redirect()->to('/worker'); //dashboard worker or user
            } else {
                return redirect()->to('/');
            }
        }
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
