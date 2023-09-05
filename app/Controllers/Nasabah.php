<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelNasabah;
use App\Models\ModelLevel;
use App\Models\ModelAgama;

class Nasabah extends BaseController
{
    public function __construct()
    {
        $this->ModelNasabah = new ModelNasabah();
        $this->ModelLevel = new ModelLevel();
        $this->ModelAgama = new ModelAgama();
        helper('form');
    }

    public function index()
    {
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Nasabah',
            'nasabah' => $this->ModelNasabah->getAllData(),
            'level' => $this->ModelLevel->getAllData(),
            'agama' => $this->ModelAgama->getAllData(),
        ];
        return view('v_Nasabah', $data);
    }

    public function insertData()
    {
        $file = $this->request->getFile('foto');
        $nama_file = $file->getRandomName();
        $data = [
            'username_nasabah' => $this->request->getPost('username_nasabah'),
            'password_nasabah' => $this->request->getPost('password_nasabah'),
            'nama_nasabah' => $this->request->getPost('nama_nasabah'),
            'id_level' => $this->request->getPost('id_level'),
            'id_agama' => $this->request->getPost('id_agama'),
            'jk' => $this->request->getPost('jk'),
            'nik' => $this->request->getPost('nik'),
            'telp' => $this->request->getPost('telp'),
            'alamat' => $this->request->getPost('alamat'),
            'foto' => $nama_file,
            'saldo' => 0
        ];
        $file->move('foto/', $nama_file);
        $this->ModelNasabah->insertData($data);
        session()->setFlashdata('tambah', 'Data Berhasil Di Tambahkan.');
        return redirect()->to('/Nasabah');
    }

    public function editData($id_nasabah)
    {
        $file = $this->request->getFile('foto');
        if ($file->getError() == 4) {
            $data = [
                'id_nasabah' => $id_nasabah,
                'username_nasabah' => $this->request->getPost('username_nasabah'),
                'password_nasabah' => $this->request->getPost('password_nasabah'),
                'nama_nasabah' => $this->request->getPost('nama_nasabah'),
                'id_level' => $this->request->getPost('id_level'),
                'id_agama' => $this->request->getPost('id_agama'),
                'jk' => $this->request->getPost('jk'),
                'nik' => $this->request->getPost('nik'),
                'telp' => $this->request->getPost('telp'),
                'alamat' => $this->request->getPost('alamat'),
            ];
            $this->ModelNasabah->editData($data);
        } else {
            $user = $this->ModelNasabah->detailData($id_nasabah);
            if ($user['foto'] !== "") {
                unlink('./foto/' . $user['foto']);
            }

            $nama_file = $file->getRandomName();
            $data = [
                'id_nasabah' => $id_nasabah,
                'username_nasabah' => $this->request->getPost('username_nasabah'),
                'password_nasabah' => $this->request->getPost('password_nasabah'),
                'nama_nasabah' => $this->request->getPost('nama_nasabah'),
                'id_level' => $this->request->getPost('id_level'),
                'id_agama' => $this->request->getPost('id_agama'),
                'nik' => $this->request->getPost('nik'),
                'telp' => $this->request->getPost('telp'),
                'alamat' => $this->request->getPost('alamat'),
                'foto' => $nama_file,
            ];
            $file->move('foto/', $nama_file);
            $this->ModelNasabah->editData($data);
        }
        session()->setFlashdata('edit', 'Data Berhasil Di Ubah.');
        return redirect()->to('/Nasabah');
    }

    public function deleteData($id_nasabah)
    {
        $nasabah = $this->ModelNasabah->detailData($id_nasabah);
        if ($nasabah['foto'] !== "") {
            unlink('./foto/' . $nasabah['foto']);
        }
        $data = [
            'id_nasabah' => $id_nasabah,
        ];
        $this->ModelNasabah->deleteData($data);
        session()->setFlashdata('delete', 'Data Berhasil Di Delete.');
        return redirect()->to('/Nasabah');
    }
}
