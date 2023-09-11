<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTransaksiSampah;
use App\Models\ModelNasabah;
use App\Models\ModelTabungan;
use App\Models\ModelJenisSampah;
use App\Models\ModelHargaSampah;
use App\Models\ModelOrderSampah;
use App\Models\ModelLembaga;

class TransaksiLembaga extends BaseController
{
    public function __construct()
    {
        $this->ModelTransaksiSampah = new ModelTransaksiSampah();
        $this->ModelNasabah = new ModelNasabah();
        $this->ModelTabungan = new ModelTabungan();
        $this->ModelJenisSampah = new ModelJenisSampah();
        $this->ModelHargaSampah = new ModelHargaSampah();
        $this->ModelOrderSampah = new ModelOrderSampah();
        $this->ModelLembaga = new ModelLembaga();

        helper('form');
    }

    public function index()
    {
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Transaksi Lembaga',
            'lembaga' => $this->ModelLembaga->getAllData(),
            'nasabah' => $this->ModelNasabah->getAllData(),
            'jenissampah' => $this->ModelJenisSampah->getAllData(),
        ];

        return view('v_TransaksiLembaga', $data);
    }

    public function insertData()
    {
        $id_nasabah = $this->request->getPost('id_nasabah');
        $jenis = $this->request->getPost('jenis');
        $jml = !empty($this->request->getPost('jumlah')) ? $this->request->getPost('jumlah') : $this->request->getPost('berat');
        $id_jenis_sampah = $this->request->getPost('id_jenis_sampah');

        $data = [
            'nasabah_id' => $id_nasabah,
            'jenis' => $jenis,
            'jumlah' => $jml,
            'id_jenis_sampah' => $id_jenis_sampah,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $nasabah = $this->ModelNasabah->detailData($id_nasabah);

        $harga_sampah = $this->ModelHargaSampah->detailDataByJenis($id_jenis_sampah);

        if (empty($harga_sampah)) {
            session()->setFlashdata('delete', 'Jenis Sampah Tidak Ditemukan !');
            return redirect()->to('/TransaksiSampah');
        }

        $newSaldo = $nasabah['saldo'];
        if ($jenis == 1) {
            $newSaldo = ($nasabah['saldo'] - $jml);
        } else {
            $newSaldo = ($nasabah['saldo'] + ($jml * $harga_sampah['harga']));
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

    public function detailTransaksiLembaga($id_lembaga)
    {
        $lembaga = $this->ModelLembaga->detailData($id_lembaga);
        $order_lembaga = $this->ModelOrderSampah->getDataBylembaga($id_lembaga);
        $jenis_sampah = $this->ModelJenisSampah->getAllData();

        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Order Lembaga',
            'lembaga' => $lembaga,
            'order_lembaga' => $order_lembaga,
            'jenis_sampah' => $jenis_sampah
        ];
        // dd($data);
        return view('v_detailTransaksiLembaga', $data);
    }

    public function detailOrderLembaga()
    {
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Detail Order Lembaga',
        ];
        // dd($data);
        return view('v_detailOrderLembaga', $data);
    }

    public function ajaxStokJenis()
    {
        $jenis_sampah = $this->ModelTransaksiSampah->getAllData([
            'tbl_transaksi_sampah.id_jenis_sampah' => $this->request->getPost('id_jenis_sampah'),
            'jenis' => 2
        ]);

        $berat = 0;
        foreach ($jenis_sampah as $key => $value) {
            $berat += $value['jumlah'];
        }

        return json_encode(['data' => $berat]);
    }

    public function ajaxOrder()
    {
        $id_lembaga = $this->request->getPost('id_lembaga');
        $arr_jenis_sampah = $this->request->getPost('arr_jenis_sampah');
        $arr_berat = $this->request->getPost('arr_berat');

        $insertOrder = $this->ModelLembaga->insertOrder($id_lembaga, $arr_jenis_sampah, $arr_berat);

        if (!$insertOrder) {
            $data = [
                'success' => false,
                'data' => 'Terjadi kesalahan !'
            ];
        } else {
            $data = [
                'success' => true,
                'data' => 'Berhasil diinsert !'
            ];
        }

        return json_encode($data);
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
