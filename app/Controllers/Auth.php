<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAuth;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->ModelAuth = new ModelAuth();
        helper('form');
    }

    public function index()
    {
    }

    public function login()
    {
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Login - Admin',
            'validation' => \Config\Services::validation(),
        ];
        echo view('v_Login-admin', $data);
    }

    public function cek_login_admin()
    {
        if ($this->validate([
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ],
            ]
        ])) {
            //valid
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $cek_login = $this->ModelAuth->login_admin($username, $password);
            if ($cek_login) {
                session()->set('nama_lengkap', $cek_login['nama_lengkap']);
                session()->set('username', $cek_login['username']);
                session()->set('level', 'Admin');
                session()->set('foto', $cek_login['foto']);
                return redirect()->to(base_url('Admin'));
            } else {
                session()->setFlashdata('pesan', 'Username atau Password Salah !');
                return redirect()->to(base_url('Auth/login'));
            }
        } else {
            //tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Auth/login'));
        }
    }

    public function logout()
    {
        session()->remove('nama_lengkap');
        session()->remove('username');
        session()->remove('id_user');
        session()->remove('id_level');
        session()->remove('foto');
        session()->setFlashdata('pesan', 'Logout Success');
        return redirect()->to(base_url('auth/login'));
    }

    // Login Nasabah
    public function cek_login_nasabah()
    {
        if ($this->validate([
            'username_nasabah' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'password_nasabah' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ],
            ]
        ])) {
            //valid
            $username_nasabah = $this->request->getPost('username_nasabah');
            $password_nasabah = $this->request->getPost('password_nasabah');
            $cek_login = $this->ModelAuth->login_nasabah($username_nasabah, $password_nasabah);
            if ($cek_login) {
                session()->set('id_nasabah', $cek_login['id_nasabah']);
                session()->set('nama_nasabah', $cek_login['nama_nasabah']);
                session()->set('username_nasabah', $cek_login['username_nasabah']);
                session()->set('foto', $cek_login['foto']);
                session()->set('level', 'Nasabah');
                return redirect()->to('Main');
            } else {
                session()->setFlashdata('pesan', 'Username atau Password Salah !');
                return redirect()->to(base_url('Home'));
            }
        } else {
            //tidak valid
            $validation =  \Config\Services::validation();
            return redirect()->to('Home')->withInput()->with('validation', $validation);
        }
    }

    public function logout_nasabah()
    {
        session()->remove('username_nasabah');
        session()->remove('nama_nasabah');
        session()->remove('level');
        session()->remove('foto');
        session()->setFlashdata('pesan', 'Logout Success');
        return redirect()->to(base_url('Home'));
    }
}
