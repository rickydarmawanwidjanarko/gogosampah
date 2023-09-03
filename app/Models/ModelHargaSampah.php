<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelHargaSampah extends Model
{
    public function getAllData()
    {
        return $this->db->table('tbl_harga_sampah')
            ->join('tbl_jenis_sampah', 'tbl_jenis_sampah.id_jenis_sampah = tbl_harga_sampah.id_jenis_sampah ', 'left')
            ->orderBy('id_harga_sampah', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function insertData($data)
    {
        $this->db->table('tbl_harga_sampah')
            ->insert($data);
    }

    public function editData($data)
    {
        $this->db->table('tbl_harga_sampah')
            ->where('id_harga_sampah', $data['id_harga_sampah'])
            ->update($data);
    }

    public function deleteData($data)
    {
        $this->db->table('tbl_harga_sampah')
            ->where('id_harga_sampah', $data['id_harga_sampah'])
            ->delete($data);
    }

    public function detailData($id_harga_sampah)
    {
        return $this->db->table('tbl_harga_sampah')
            ->where('id_harga_sampah', $id_harga_sampah)
            ->get()
            ->getResultArray();
    }

    public function detailDataByJenis($id_jenis_sampah)
    {
        return $this->db->table('tbl_harga_sampah')
            ->where('id_jenis_sampah', $id_jenis_sampah)
            ->get()
            ->getRowArray();
    }
}
