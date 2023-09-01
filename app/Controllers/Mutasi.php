<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelMutasi;
use App\Models\ModelNasabah;
use App\Models\ModelTabungan;

class Mutasi extends BaseController
{
    public function __construct()
    {
        $this->ModelMutasi = new ModelMutasi();
        $this->ModelNasabah = new ModelNasabah();
        $this->ModelTabungan = new ModelTabungan();
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
            'jenis' => $this->request->getPost('jenis'),
            'jumlah' => $this->request->getPost('jumlah'),
            'created_at' => $this->request->getPost('created_at'),
        ];
        $this->ModelMutasi->insertData($data);
        session()->setFlashdata('tambah', 'Data Berhasil Di Tambahkan.');
        return redirect()->to('/Mutasi');
    }

    public function editData($id_mutasi)
    {
        $id_nasabah = $this->request->getPost('id_nasabah');
        $data = [
            'id_mutasi' => $id_mutasi,
            'jenis' => $this->request->getPost('jenis'),
            'jumlah' => $this->request->getPost('jumlah'),
            'created_at' => $this->request->getPost('created_at'),
            'updated_at' => $this->request->getPost('updated_at'),
        ];
        $this->ModelMutasi->editData($data);
        session()->setFlashdata('edit', 'Data Berhasil Di Ubah.');
        return redirect()->to('/Mutasi/DetailMutasi/' . $id_nasabah);
    }

    public function detailMutasi($id_nasabah)
    {
        $data_nasabah = $this->ModelNasabah->detailData($id_nasabah);
        $data_tabungan = $this->ModelTabungan->detailData($id_nasabah);
        $data_mutasi = $this->ModelMutasi->detailData($id_nasabah);
        $total_saldo = $this->ModelTabungan->totalSaldo($id_nasabah);
        $total_debit = $this->ModelMutasi->totalDebit($id_nasabah);
        $total_kredit = $this->ModelMutasi->totalKredit($id_nasabah);
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Transaksi Mutasi',
            'mutasi' => $data_mutasi,
            'nasabah' => $data_nasabah,
            'tabungan' => $data_tabungan,
            'tot_saldo' => $total_saldo,
            'tot_debit' => $total_debit,
            'tot_kredit' => $total_kredit,
        ];
        // dd($data);
        return view('v_detailMutasi', $data);
    }


    public function deleteData($id_mutasi)
    {
        $data = [
            'id_mutasi' => $id_mutasi,
        ];
        $this->ModelMutasi->deleteData($data);
        session()->setFlashdata('delete', 'Data Berhasil Di Delete.');
        return redirect()->to('/Mutasi');
    }
}
