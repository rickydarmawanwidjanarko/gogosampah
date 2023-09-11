<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelHargaPupuk extends Model
{
    public function getAllData()
    {
        return $this->db->table('tbl_harga_pupuk')
            ->join('tbl_jenis_pupuk', 'tbl_jenis_pupuk.id_jenis_pupuk = tbl_harga_pupuk.id_jenis_pupuk ', 'left')
            ->orderBy('id_harga_pupuk', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function insertData($data)
    {
        $this->db->table('tbl_harga_pupuk')
            ->insert($data);
    }

    public function editData($data)
    {
        $this->db->table('tbl_harga_pupuk')
            ->where('id_harga_pupuk', $data['id_harga_pupuk'])
            ->update($data);
    }

    public function deleteData($data)
    {
        $this->db->table('tbl_harga_pupuk')
            ->where('id_harga_pupuk', $data['id_harga_pupuk'])
            ->delete($data);
    }

    public function detailData($id_harga_pupuk)
    {
        return $this->db->table('tbl_harga_pupuk')
            ->where('id_harga_pupuk', $id_harga_pupuk)
            ->get()
            ->getResultArray();
    }

    public function detailDataByJenis($id_jenis_pupuk)
    {
        return $this->db->table('tbl_harga_pupuk')
            ->where('id_jenis_pupuk', $id_jenis_pupuk)
            ->get()
            ->getRowArray();
    }
}
