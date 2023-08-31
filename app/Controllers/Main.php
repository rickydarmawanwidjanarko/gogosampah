<?php

namespace App\Controllers;


class Main extends BaseController
{
    public function __construct()
    {
        helper('form');
    }

    public function index()
    {
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Dashboard - Nasabah',
        ];
        return view('Nasabah/v_dashboard', $data);
    }
}
