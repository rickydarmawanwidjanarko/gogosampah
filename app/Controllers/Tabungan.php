<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTabungan;
use App\Models\ModelNasabah;

class Tabungan extends BaseController
{
    public function __construct()
    {
        $this->ModelTabungan = new ModelTabungan();
        $this->ModelNasabah = new ModelNasabah();
        helper('form');
    }

    public function index()
    {
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Transaksi Tabungan',
            'tabungan' => $this->ModelTabungan->getAllData(),
            'nasabah' => $this->ModelNasabah->getAllData(),
        ];
        return view('v_Tabungan', $data);
    }


    public function detailTabungan($id_tabungan)
    {
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Transaksi Tabungan',
            'tabungan' => $this->ModelTabungan->detailData($id_tabungan),
        ];
        return view('v_detailTabungan', $data);
    }

    public function insertData()
    {
        $data = [
            'nasabah_id' => $this->request->getPost('nasabah_id'),
            'nominal_masuk' => $this->request->getPost('nominal_masuk'),
            'tgl_masuk' => $this->request->getPost('tgl_masuk'),
        ];
        $this->ModelTabungan->insertData($data);
        session()->setFlashdata('tambah', 'Data Berhasil Di Tambahkan.');
        return redirect()->to('/Tabungan');
    }

    public function editData($id_lembaga)
    {
        $data = [
            'id_lembaga' => $id_lembaga,
            'nama_lembaga' => $this->request->getPost('nama_lembaga'),
            'telp' => $this->request->getPost('telp'),
            'alamat' => $this->request->getPost('alamat'),
        ];
        $this->ModelTabungan->editData($data);
        session()->setFlashdata('edit', 'Data Berhasil Di Ubah.');
        return redirect()->to('/Tabungan');
    }


    public function deleteData($id_lembaga)
    {
        $pelanggan = $this->ModelTabungan->detailData($id_lembaga);
        $data = [
            'id_lembaga' => $id_lembaga,
        ];
        $this->ModelTabungan->deleteData($data);
        session()->setFlashdata('delete', 'Data Berhasil Di Delete.');
        return redirect()->to('/Tabungan');
    }
}
