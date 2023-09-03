<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelJenisSampah;

class JenisSampah extends BaseController
{
    public function __construct()
    {
        $this->ModelJenisSampah = new ModelJenisSampah();
        helper('form');
    }

    public function index()
    {
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Jenis Sampah',
            'jenissampah' => $this->ModelJenisSampah->getAllData(),
        ];
        return view('v_JenisSampah', $data);
    }

    public function insertData()
    {
        $data = [
            'jenis_sampah' => $this->request->getPost('jenis_sampah'),
            'harga' => $this->request->getPost('harga'),
        ];
        $this->ModelJenisSampah->insertData($data);
        session()->setFlashdata('tambah', 'Data Berhasil Di Tambahkan.');
        return redirect()->to('/JenisSampah');
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
        return redirect()->to('/JenisSampah');
    }


    public function deleteData($id_jenis_sampah)
    {
        $id_jenis_sampah = $this->ModelJenisSampah->detailData($id_jenis_sampah);
        $data = [
            'id_jenis_sampah' => $id_jenis_sampah,
        ];
        $this->ModelJenisSampah->deleteData($data);
        session()->setFlashdata('delete', 'Data Berhasil Di Delete.');
        return redirect()->to('/JenisSampah');
    }
}
