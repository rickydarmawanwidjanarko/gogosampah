<?php

namespace App\Controllers;

use App\Models\ModelNasabah;
use App\Models\ModelAgama;

class Profile extends BaseController
{
    public function __construct()
    {
        $this->ModelNasabah = new ModelNasabah();
        $this->ModelAgama = new ModelAgama();
        helper('form');
    }

    public function index()
    {
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Detail Biodata',
            'nasabah' => $this->ModelNasabah->getProfile(),
            'agama' => $this->ModelAgama->getAllData(),
        ];
        // dd($data);
        echo view('Nasabah/v_Profile', $data);
    }

    public function updateFoto($id_nasabah)
    {
        if ($this->validate([
            'foto' => [
                'label' => 'Foto',
                'rules' => 'max_size[foto,1024]',
                'errors' => [
                    'max_size' => 'Ukuran {field} Max 1024kb.',
                ]
            ]
        ])) {

            //hapus foto lama
            $nasabah = $this->ModelNasabah->getProfile($id_nasabah);
            if ($nasabah['foto'] != "" or $nasabah['foto'] != null) {
                unlink('./foto/' . $nasabah['foto']);
            }

            $file = $this->request->getFile('foto');
            $nama_file = $file->getRandomName();
            $data = [
                'id_nasabah' => $id_nasabah,
                'foto' => $nama_file,
            ];
            //upload File Foto
            $file->move('foto/', $nama_file);
            $this->ModelNasabah->editData($data);
            session()->setFlashdata('pesan', 'Foto Berhasil Di Update.');
            return redirect()->to('Profile');
        } else {
            //jika ada validasi
            $validation =  \Config\Services::validation();
            return redirect()->to('Profile')->withInput()->with('validation', $validation);
        }
    }
}
