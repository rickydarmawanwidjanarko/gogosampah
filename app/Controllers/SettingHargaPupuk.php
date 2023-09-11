<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelJenisPupuk;
use App\Models\ModelHargaPupuk;

class SettingHargaPupuk extends BaseController
{
    public function __construct()
    {
        $this->ModelJenisPupuk = new ModelJenisPupuk();
        $this->ModelHargaPupuk = new ModelHargaPupuk();
        helper('form');
    }

    public function index()
    {
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Setting Harga Pupuk',
            'jenispupuk' => $this->ModelJenisPupuk->getAllData(),
            'settinghargapupuk' => $this->ModelHargaPupuk->getAllData(),
        ];
        return view('v_SettingHargaPupuk', $data);
    }

    public function insertData()
    {
        $data = [
            'id_jenis_pupuk' => $this->request->getPost('id_jenis_pupuk'),
            'berat' => $this->request->getPost('berat'),
            'harga' => $this->request->getPost('harga'),
        ];
        $this->ModelHargaPupuk->insertData($data);
        session()->setFlashdata('tambah', 'Data Berhasil Di Tambahkan.');
        return redirect()->to('/SettingHargaPupuk');
    }

    public function editData($id_harga_pupuk)
    {
        $data = [
            'id_harga_pupuk' => $id_harga_pupuk,
            // 'id_jenis_pupuk' => $this->request->getPost('id_jenis_pupuk'),
            'berat' => $this->request->getPost('berat'),
            'harga' => $this->request->getPost('harga'),
        ];
        $this->ModelHargaPupuk->editData($data);
        session()->setFlashdata('edit', 'Data Berhasil Di Ubah.');
        return redirect()->to('/SettingHargaPupuk');
    }


    public function deleteData($id_jenis_pupuk)
    {
        $id_jenis_pupuk = $this->ModelJenisPupuk->detailData($id_jenis_pupuk);
        $data = [
            'id_jenis_pupuk' => $id_jenis_pupuk,
        ];
        $this->ModelHargaPupuk->deleteData($data);
        session()->setFlashdata('delete', 'Data Berhasil Di Delete.');
        return redirect()->to('/SettingHargaPupuk');
    }
}
