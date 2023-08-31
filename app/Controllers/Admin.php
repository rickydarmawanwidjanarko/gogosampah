<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Dashboard',
            'validation' => \Config\Services::validation(),
        ];
        // dd($data);
        echo view('Admin/v_Dashboard', $data);
    }
}
