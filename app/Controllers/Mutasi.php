<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelMutasi;
use App\Models\ModelNasabah;

class Mutasi extends BaseController
{
    public function __construct()
    {
        $this->ModelMutasi = new ModelMutasi();
        $this->ModelNasabah = new ModelNasabah();
        helper('form');
    }

    public function index()
    {
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Mutasi Tabungan',
            'mutasi' => $this->ModelMutasi->getAllData(),
            'nasabah' => $this->ModelNasabah->getAllData(),
        ];
        return view('v_Mutasi', $data);
    }

    public function insertData()
    {
        $data = [
            'nasabah_id' => $this->request->getPost('nasabah_id'),
            'nominal_masuk' => $this->request->getPost('nominal_masuk'),
            'tgl_masuk' => $this->request->getPost('tgl_masuk'),
        ];
        $this->ModelMutasi->insertData($data);
        session()->setFlashdata('tambah', 'Data Berhasil Di Tambahkan.');
        return redirect()->to('/Mutasi');
    }

    public function editData($id_mutasi)
    {
        $data = [
            'id_mutasi' => $id_mutasi,
            'nama_lembaga' => $this->request->getPost('nama_lembaga'),
            'telp' => $this->request->getPost('telp'),
            'alamat' => $this->request->getPost('alamat'),
        ];
        $this->ModelMutasi->editData($data);
        session()->setFlashdata('edit', 'Data Berhasil Di Ubah.');
        return redirect()->to('/Mutasi');
    }


    public function deleteData($id_mutasi)
    {
        $id_mutasi = $this->ModelMutasi->detailData($id_mutasi);
        $data = [
            'id_mutasi' => $id_mutasi,
        ];
        $this->ModelMutasi->deleteData($data);
        session()->setFlashdata('delete', 'Data Berhasil Di Delete.');
        return redirect()->to('/Mutasi');
    }
}
