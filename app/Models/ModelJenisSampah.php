<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelJenisSampah extends Model
{
    public function getAllData()
    {
        return $this->db->table('tbl_jenis_sampah')
            ->orderBy('id_jenis_sampah', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function insertData($data)
    {
        $this->db->table('tbl_jenis_sampah')
            ->insert($data);
    }

    public function editData($data)
    {
        $this->db->table('tbl_jenis_sampah')
            ->where('id_jenis_sampah', $data['id_jenis_sampah'])
            ->update($data);
    }

    public function deleteData($data)
    {
        $this->db->table('tbl_jenis_sampah')
            ->where('id_jenis_sampah', $data['id_jenis_sampah'])
            ->delete($data);
    }

    public function detailData($id_jenis_sampah)
    {
        return $this->db->table('tbl_jenis_sampah')
            ->where('id_jenis_sampah', $id_jenis_sampah)
            ->get()
            ->getRowArray();
    }
}
