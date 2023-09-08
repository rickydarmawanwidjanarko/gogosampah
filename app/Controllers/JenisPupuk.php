<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelJenisPupuk;

class JenisPupuk extends BaseController
{
    public function __construct()
    {
        $this->ModelJenisPupuk = new ModelJenisPupuk();
        helper('form');
    }

    public function index()
    {
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Jenis Pupuk',
            'jenispupuk' => $this->ModelJenisPupuk->getAllData(),
        ];
        return view('v_JenisPupuk', $data);
    }

    public function insertData()
    {
        $data = [
            'jenis_pupuk' => $this->request->getPost('jenis_pupuk'),
        ];
        $this->ModelJenisPupuk->insertData($data);
        session()->setFlashdata('tambah', 'Data Berhasil Di Tambahkan.');
        return redirect()->to('/JenisPupuk');
    }

    public function editData($id_jenis_pupuk)
    {
        $data = [
            'id_jenis_pupuk' => $id_jenis_pupuk,
            'jenis_pupuk' => $this->request->getPost('nama_lembaga'),
        ];
        $this->ModelJenisPupuk->editData($data);
        session()->setFlashdata('edit', 'Data Berhasil Di Ubah.');
        return redirect()->to('/JenisPupuk');
    }


    public function deleteData($id_jenis_pupuk)
    {
        $id_jenis_pupuk = $this->ModelJenisPupuk->detailData($id_jenis_pupuk);
        $data = [
            'id_jenis_pupuk' => $id_jenis_pupuk,
        ];
        $this->ModelJenisPupuk->deleteData($data);
        session()->setFlashdata('delete', 'Data Berhasil Di Delete.');
        return redirect()->to('/JenisPupuk');
    }
}
