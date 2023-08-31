<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAuth extends Model
{
    public function login_admin($username, $password)
    {
        return $this->db->table('tbl_user')
            ->where([
                'username' => $username,
                'password' => $password,
            ])
            ->get()->getRowArray();
    }

    public function login_nasabah($username_nasabah, $password_nasabah)
    {
        return $this->db->table('tbl_nasabah')
            ->where([
                'username_nasabah' => $username_nasabah,
                'password_nasabah' => $password_nasabah,
            ])
            ->get()->getRowArray();
    }
}
