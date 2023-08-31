<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPengguna;
use App\Models\ModelLevel;

class Pengguna extends BaseController
{
    public function __construct()
    {
        $this->ModelPengguna = new ModelPengguna();
        $this->ModelLevel = new ModelLevel();
        helper('form');
    }

    public function index()
    {
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Pengguna',
            'pengguna' => $this->ModelPengguna->getAllData(),
            'level' => $this->ModelLevel->getAllData(),
        ];
        return view('v_Pengguna', $data);
    }

    public function insertData()
    {
        $file = $this->request->getFile('foto');
        $nama_file = $file->getRandomName();
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'foto' => $nama_file,
        ];
        $file->move('foto/', $nama_file);
        $this->ModelPengguna->insertData($data);
        session()->setFlashdata('tambah', 'Data Berhasil Di Tambahkan.');
        return redirect()->to('/Pengguna');
    }

    public function editData($id_user)
    {
        $file = $this->request->getFile('foto');
        if ($file->getError() == 4) {
            $data = [
                'id_user' => $id_user,
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            ];
            $this->ModelPengguna->editData($data);
        } else {
            $user = $this->ModelPengguna->detailData($id_user);
            if ($user['foto'] !== "") {
                unlink('./foto/' . $user['foto']);
            }

            $nama_file = $file->getRandomName();
            $data = [
                'id_user' => $id_user,
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'foto' => $nama_file,
            ];
            $file->move('foto/', $nama_file);
            $this->ModelPengguna->editData($data);
        }
        session()->setFlashdata('edit', 'Data Berhasil Di Ubah.');
        return redirect()->to('/Pengguna');
    }

    public function deleteData($id_user)
    {
        $user = $this->ModelPengguna->detailData($id_user);
        if ($user['foto'] !== "") {
            unlink('./foto/' . $user['foto']);
        }
        $data = [
            'id_user' => $id_user,
        ];
        $this->ModelPengguna->deleteData($data);
        session()->setFlashdata('delete', 'Data Berhasil Di Delete.');
        return redirect()->to('/Pengguna');
    }
}
