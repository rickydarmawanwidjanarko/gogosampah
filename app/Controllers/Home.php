<?php

namespace App\Controllers;

use App\Models\ModelAuth;

class Home extends BaseController
{
    public function __construct()
    {
        $this->ModelAuth = new ModelAuth();
        helper('form');
    }

    public function index()
    {
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Login - Nasabah',
            'validation' => \Config\Services::validation(),
        ];
        echo view('v_Login-nasabah', $data);
    }
}
