<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelLembaga;

class Lembaga extends BaseController
{
    public function __construct()
    {
        $this->ModelLembaga = new ModelLembaga();
        helper('form');
    }

    public function index()
    {
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Lembaga',
            'lembaga' => $this->ModelLembaga->getAllData(),
        ];
        return view('v_Lembaga', $data);
    }

    public function insertData()
    {
        $data = [
            'nama_lembaga' => $this->request->getPost('nama_lembaga'),
            'telp' => $this->request->getPost('telp'),
            'alamat' => $this->request->getPost('alamat'),
        ];
        $this->ModelLembaga->insertData($data);
        session()->setFlashdata('tambah', 'Data Berhasil Di Tambahkan.');
        return redirect()->to('/Lembaga');
    }

    public function editData($id_lembaga)
    {
            $data = [
                'id_lembaga' => $id_lembaga,
                'nama_lembaga' => $this->request->getPost('nama_lembaga'),
                'telp' => $this->request->getPost('telp'),
                'alamat' => $this->request->getPost('alamat'),
            ];
            $this->ModelLembaga->editData($data);
            session()->setFlashdata('edit', 'Data Berhasil Di Ubah.');
            return redirect()->to('/Lembaga');
        }
    

    public function deleteData($id_lembaga)
    {
       $pelanggan = $this->ModelLembaga->detailData($id_lembaga);
        $data = [
            'id_lembaga' => $id_lembaga,
        ];
        $this->ModelLembaga->deleteData($data);
        session()->setFlashdata('delete', 'Data Berhasil Di Delete.');
        return redirect()->to('/Lembaga');
    }
}
