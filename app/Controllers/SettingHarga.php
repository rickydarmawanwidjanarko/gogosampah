<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelJenisSampah;
use App\Models\ModelSettingHarga;

class SettingHarga extends BaseController
{
    public function __construct()
    {
        $this->ModelJenisSampah = new ModelJenisSampah();
        $this->ModelSettingHarga = new ModelSettingHarga();
        helper('form');
    }

    public function index()
    {
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Setting Harga',
            'jenissampah' => $this->ModelJenisSampah->getAllData(),
            'settingharga' => $this->ModelSettingHarga->getAllData(),
        ];
        return view('v_SettingHarga', $data);
    }

    public function insertData()
    {
        $data = [
            'id_jenis_sampah' => $this->request->getPost('id_jenis_sampah'),
            'berat' => $this->request->getPost('berat'),
            'harga' => $this->request->getPost('harga'),
        ];
        $this->ModelJenisSampah->insertData($data);
        session()->setFlashdata('tambah', 'Data Berhasil Di Tambahkan.');
        return redirect()->to('/SettingHarga');
    }

    public function editData($id_jenis_sampah)
    {
        $data = [
            'id_jenis_sampah' => $id_jenis_sampah,
            'jenis_sampah' => $this->request->getPost('nama_lembaga'),
            'harga' => $this->request->getPost('harga'),
        ];
        $this->ModelJenisSampah->editData($data);
        session()->setFlashdata('edit', 'Data Berhasil Di Ubah.');
        return redirect()->to('/SettingHarga');
    }


    public function deleteData($id_jenis_sampah)
    {
        $id_jenis_sampah = $this->ModelJenisSampah->detailData($id_jenis_sampah);
        $data = [
            'id_jenis_sampah' => $id_jenis_sampah,
        ];
        $this->ModelJenisSampah->deleteData($data);
        session()->setFlashdata('delete', 'Data Berhasil Di Delete.');
        return redirect()->to('/SettingHarga');
    }
}
