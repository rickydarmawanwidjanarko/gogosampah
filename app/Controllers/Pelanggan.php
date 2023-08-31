<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPelanggan;
use App\Models\ModelLevel;

class Pelanggan extends BaseController
{
    public function __construct()
    {
        $this->ModelPelanggan = new ModelPelanggan();
        $this->ModelLevel = new ModelLevel();
        helper('form');
    }

    public function index()
    {
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Pelanggan',
            'pelanggan' => $this->ModelPelanggan->getAllData(),
            'level' => $this->ModelLevel->getAllData(),
        ];
        return view('v_Pelanggan', $data);
    }

    public function insertData()
    {
        $data = [
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'telp' => $this->request->getPost('telp'),
            'alamat' => $this->request->getPost('alamat'),
        ];
        $this->ModelPelanggan->insertData($data);
        session()->setFlashdata('tambah', 'Data Berhasil Di Tambahkan.');
        return redirect()->to('/Pelanggan');
    }

    public function editData($id_pelanggan)
    {
            $data = [
                'id_pelanggan' => $id_pelanggan,
                'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
                'telp' => $this->request->getPost('telp'),
                'alamat' => $this->request->getPost('alamat'),
            ];
            $this->ModelPelanggan->editData($data);
            session()->setFlashdata('edit', 'Data Berhasil Di Ubah.');
            return redirect()->to('/Pelanggan');
        }
    

    public function deleteData($id_pelanggan)
    {
       $pelanggan = $this->ModelPelanggan->detailData($id_pelanggan);
        $data = [
            'id_pelanggan' => $id_pelanggan,
        ];
        $this->ModelPelanggan->deleteData($data);
        session()->setFlashdata('delete', 'Data Berhasil Di Delete.');
        return redirect()->to('/Pelanggan');
    }
}
