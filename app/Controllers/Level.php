<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelLevel;

class Level extends BaseController
{
    public function __construct()
    {
        $this->ModelLevel = new ModelLevel();
        helper('form');
    }
    public function index()
    {
        $data = [
            'title' => 'E-Surat | PIM',
            'subtitle' => 'Level',
            'level' => $this->ModelLevel->getAllData(),
        ];
        return view('v_level', $data);
    }
    public function insertData()
    {
        $data = [
            'level' => $this->request->getPost('level'),
        ];
        $this->ModelLevel->insertData($data);
        session()->setFlashdata('tambah', 'Data Berhasil Di Tambahkan.');
        return redirect()->to('/level');
    }

    public function editData($id_level)
    {
        $data = [
            'id_level' => $id_level,
            'level' => $this->request->getPost('level'),
        ];
        $this->ModelLevel->editData($data);
        session()->setFlashdata('edit', 'Data Berhasil Di Edit.');
        return redirect()->to('/level');
    }

    public function deleteData($id_level)
    {
        $data = [
            'id_level' => $id_level,
        ];
        $this->ModelLevel->deleteData($data);
        session()->setFlashdata('delete', 'Data Berhasil Di Delete.');
        return redirect()->to('/level');
    }
}
