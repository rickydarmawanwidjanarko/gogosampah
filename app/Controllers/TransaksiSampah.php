<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTransaksiSampah;
use App\Models\ModelNasabah;
use App\Models\ModelTabungan;
use App\Models\ModelJenisSampah;

class TransaksiSampah extends BaseController
{
    public function __construct()
    {
        $this->ModelTransaksiSampah = new ModelTransaksiSampah();
        $this->ModelNasabah = new ModelNasabah();
        $this->ModelTabungan = new ModelTabungan();
        $this->ModelJenisSampah = new ModelJenisSampah();
        helper('form');
    }

    public function index()
    {
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Transaksi Sampah',
            'transaksisampah' => $this->ModelTransaksiSampah->getAllData(),
            'nasabah' => $this->ModelNasabah->getAllData(),
            'jenissampah' => $this->ModelJenisSampah->getAllData(),
        ];
        return view('v_TransaksiSampah', $data);
    }

    public function insertData()
    {
        $id_nasabah = $this->request->getPost('id_nasabah');
        $jenis = $this->request->getPost('jenis');
        $jml = !empty($this->request->getPost('jumlah')) ? $this->request->getPost('jumlah') : $this->request->getPost('berat');

        $data = [
            'nasabah_id' => $id_nasabah,
            'jenis' => $jml,
            'jumlah' => $jml,
            'id_jenis_sampah' => $this->request->getPost('id_jenis_sampah'),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $nasabah = $this->ModelNasabah->detailData($id_nasabah);

        $newSaldo = $nasabah['saldo'];
        if ($jenis == 1) {
            $newSaldo = $nasabah['saldo'] - $jml;
        } else {
            $newSaldo = $nasabah['saldo'] + $jml;
        }

        $dataUpdate = [
            'id_nasabah' => $id_nasabah,
            'saldo' => $newSaldo
        ];
            $this->ModelNasabah->editData($dataUpdate);
        $this->ModelTransaksiSampah->insertData($data);


        session()->setFlashdata('tambah', 'Data Berhasil Di Tambahkan.');
        return redirect()->to('/TransaksiSampah');
    }

    public function editData($id_transaksi_sampah)
    {
        $id_nasabah = $this->request->getPost('id_nasabah');
        $data = [
            'id_transaksi_sampah' => $id_transaksi_sampah,
            'jenis' => $this->request->getPost('jenis'),
            'jumlah' => $this->request->getPost('jumlah'),
            'id_jenis_sampah' => $this->request->getPost('id_jenis_sampah'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->ModelTransaksiSampah->editData($data);
        session()->setFlashdata('edit', 'Data Berhasil Di Ubah.');
        return redirect()->to('/TransaksiSampah/detailTransaksiSampah/' . $id_nasabah);
    }

    public function detailTransaksiSampah($id_nasabah)
    {
        $data_nasabah = $this->ModelNasabah->detailData($id_nasabah);
        $data_tabungan = $this->ModelTabungan->detailData($id_nasabah);
        $data_transaksi_sampah = $this->ModelTransaksiSampah->detailData($id_nasabah);
        $data_jenis_sampah = $this->ModelJenisSampah->getAllData();
        $total_saldo = $this->ModelTabungan->totalSaldo($id_nasabah);
        $total_debit = $this->ModelTransaksiSampah->totalDebit($id_nasabah);
        $total_kredit = $this->ModelTransaksiSampah->totalKredit($id_nasabah);
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Transaksi Sampah',
            'transaksisampah' => $data_transaksi_sampah,
            'jenissampah' => $data_jenis_sampah,
            'nasabah' => $data_nasabah,
            'tabungan' => $data_tabungan,
            'tot_saldo' => $total_saldo,
            'tot_debit' => $total_debit,
            'tot_kredit' => $total_kredit,
        ];
        // dd($data);
        return view('v_detailTransaksiSampah', $data);
    }


    public function deleteData($id_transaksi_sampah)
    {
        $data = [
            'id_transaksi_sampah' => $id_transaksi_sampah,
        ];
        $this->ModelTransaksiSampah->deleteData($data);
        session()->setFlashdata('delete', 'Data Berhasil Di Delete.');
        return redirect()->to('/TransaksiSampah');
    }
}
