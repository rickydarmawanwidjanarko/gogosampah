<?php

namespace App\Controllers;


class Profile extends BaseController
{
    public function __construct()
    {
        helper('form');
    }

    public function index()
    {
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Detail - Nasabah',
        ];
        return view('Nasabah/v_detail', $data);
    }
}
