<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPupuk;
use App\Models\ModelJenisPupuk;


class Pupuk extends BaseController
{
    public function __construct()
    {
        $this->ModelPupuk = new ModelPupuk();
        $this->ModelJenisPupuk = new ModelJenisPupuk();

        helper('form');
    }

    public function index()
    {
        $saldoTerakhirData = $this->ModelPupuk->getSaldoTerakhir();
        $saldoTerakhir = $saldoTerakhirData ? $saldoTerakhirData['stock'] : 0;
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Stock Pupuk',
            'pupuk' => $this->ModelPupuk->getAllData(),
            'jenispupuk' => $this->ModelJenisPupuk->getAllData(),
            'saldoTerakhir' => $saldoTerakhir,
        ];
        return view('v_Pupuk', $data);
    }

    public function insertData()
    {
        $id_jenis_pupuk = $this->request->getPost('id_jenis_pupuk');
        $nama_penyetor = $this->request->getPost('nama_penyetor');
        $tgl_masuk = $this->request->getPost('tgl_masuk');
        $jumlah_masuk = (float)$this->request->getPost('jumlah_masuk');
        $previousStockData = $this->ModelPupuk->detailData($id_jenis_pupuk);
        $totalPreviousJumlahMasuk = $this->ModelPupuk->getTotalJumlahMasuk($id_jenis_pupuk);
        if (!is_numeric($totalPreviousJumlahMasuk)) {
            $totalPreviousJumlahMasuk = 0;
        }
        $newStock = $totalPreviousJumlahMasuk + $jumlah_masuk;
        $data = [
            'id_jenis_pupuk' => $id_jenis_pupuk,
            'nama_penyetor' => $nama_penyetor,
            'tgl_masuk' => $tgl_masuk,
            'jumlah_masuk' => $jumlah_masuk,
            'stock' => $newStock,
        ];
        $this->ModelPupuk->insertData($data);
        session()->setFlashdata('tambah', 'Data Berhasil Di Tambahkan.');
        return redirect()->to('/Pupuk');
    }

    public function editData($id_pupuk)
    {
        $data = [
            'id_pupuk' => $id_pupuk,
            'nama_pupuk' => $this->request->getPost('nama_pupuk'),
            'harga' => $this->request->getPost('harga'),
            'stock' => $this->request->getPost('stock'),
        ];
        $this->ModelPupuk->editData($data);
        session()->setFlashdata('edit', 'Data Berhasil Di Ubah.');
        return redirect()->to('/StockPupuk');
    }


    public function deleteData($id_pupuk)
    {
        $pelanggan = $this->ModelPupuk->detailData($id_pupuk);
        $data = [
            'id_pupuk' => $id_pupuk,
        ];
        $this->ModelPupuk->deleteData($data);
        session()->setFlashdata('delete', 'Data Berhasil Di Delete.');
        return redirect()->to('/StockPupuk');
    }

    public function detailPupuk($id_stock_pupuk)
    {
        $data_pupuk = $this->ModelPupuk->detailData($id_stock_pupuk);
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Data Pupuk',
            'pupuk' => $data_pupuk,
        ];
        // dd($data);
        return view('v_detailPupuk', $data);
    }
}
