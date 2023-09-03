<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSettingHarga extends Model
{
    public function getAllData()
    {
        return $this->db->table('tbl_sampah')
            ->join('tbl_jenis_sampah', 'tbl_jenis_sampah.id_jenis_sampah = tbl_sampah.id_jenis_sampah ', 'left')
            ->orderBy('id_meta', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function insertData($data)
    {
        $this->db->table('tbl_sampah')
            ->insert($data);
    }

    public function editData($data)
    {
        $this->db->table('tbl_sampah')
            ->where('id_meta', $data['id_meta'])
            ->update($data);
    }

    public function deleteData($data)
    {
        $this->db->table('tbl_sampah')
            ->where('id_meta', $data['id_meta'])
            ->delete($data);
    }

    public function detailData($id_meta)
    {
        return $this->db->table('tbl_sampah')
            ->where('id_meta', $id_meta)
            ->get()
            ->getResultArray();
    }
}
