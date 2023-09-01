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


    public function detailTabungan($id_nasabah)
    {
        $data_nasabah = $this->ModelNasabah->detailData($id_nasabah);
        $data_tabungan = $this->ModelTabungan->detailData($id_nasabah);
        $total_saldo = $this->ModelTabungan->totalSaldo($id_nasabah);
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Transaksi Tabungan',
            'nasabah' => $data_nasabah,
            'tabungan' => $data_tabungan,
            'tot_saldo' => $total_saldo,
        ];
        // dd($data);
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

    public function editData($id_tabungan)
    {
        $data = [
            'id_tabungan' => $id_tabungan,
            'nominal_masuk' => $this->request->getPost('nominal_masuk'),
            'tgl_masuk' => $this->request->getPost('tgl_masuk'),
        ];
        $this->ModelTabungan->editData($data);
        session()->setFlashdata('edit', 'Data Berhasil Di Ubah.');
        return redirect()->to('/Tabungan');
    }


    public function deleteData($id_tabungan)
    {
        $data = [
            'id_tabungan' => $id_tabungan,
        ];
        $this->ModelTabungan->deleteData($data);
        session()->setFlashdata('delete', 'Data Berhasil Di Delete.');
        return redirect()->to('/Tabungan');
    }
}
