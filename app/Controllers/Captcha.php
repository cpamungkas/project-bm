<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MUser;
use CodeIgniter\HTTP\Request;

class Captcha extends BaseController
{
    function __construct()
    {
        parent::__construct();
        // Load the captcha helper
        $this->load->helper('captcha');
    }

    public function index()
    {
        // If captcha form is submitted
        if ($this->input->post('submit')) {
            $inputCaptcha = $this->input->post('captcha');
            $sessCaptcha = $this->session->userdata('captchaCode');
            if ($inputCaptcha === $sessCaptcha) {
                echo 'Captcha code matched.';
            } else {
                echo 'Captcha code was not match, please try again.';
            }
        }

        // Captcha configuration
        $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url() . 'captcha_images/',
            'img_width'     => '150',
            'img_height'    => 50,
            'word_length'   => 8,
            'font_size'     => 16
        );
        $captcha = create_captcha($config);

        // Unset previous captcha and store new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode', $captcha['word']);

        // Send captcha image to view
        $data['captchaImg'] = $captcha['image'];

        // Load the view
        $this->load->view('captcha/index', $data);
    }

    public function refresh()
    {
        // Captcha configuration
        $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url() . 'captcha_images/',
            'img_width'     => '150',
            'img_height'    => 50,
            'word_length'   => 8,
            'font_size'     => 16
        );
        $captcha = create_captcha($config);

        // Unset previous captcha and store new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode', $captcha['word']);

        // Display captcha image
        echo $captcha['image'];
    }
}
