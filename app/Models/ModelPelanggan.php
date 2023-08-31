<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPelanggan extends Model
{
    public function getAllData()
    {
        return $this->db->table('tbl_pelanggan')
            ->orderBy('id_pelanggan', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function insertData($data)
    {
        $this->db->table('tbl_pelanggan')
            ->insert($data);
    }

    public function editData($data)
    {
        $this->db->table('tbl_pelanggan')
            ->where('id_pelanggan', $data['id_pelanggan'])
            ->update($data);
    }

    public function deleteData($data)
    {
        $this->db->table('tbl_pelanggan')
            ->where('id_pelanggan', $data['id_pelanggan'])
            ->delete($data);
    }

    public function detailData($id_pelanggan)
    {
        return $this->db->table('tbl_pelanggan')
            ->where('id_pelanggan', $id_pelanggan)
            ->get()
            ->getRowArray();
    }
}
