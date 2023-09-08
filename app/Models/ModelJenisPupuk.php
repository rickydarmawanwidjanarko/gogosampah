<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelJenisPupuk extends Model
{
    public function getAllData()
    {
        return $this->db->table('tbl_jenis_pupuk')
            ->orderBy('id_jenis_pupuk', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function insertData($data)
    {
        $this->db->table('tbl_jenis_pupuk')
            ->insert($data);
    }

    public function editData($data)
    {
        $this->db->table('tbl_jenis_pupuk')
            ->where('id_jenis_pupuk', $data['id_jenis_pupuk'])
            ->update($data);
    }

    public function deleteData($data)
    {
        $this->db->table('tbl_jenis_pupuk')
            ->where('id_jenis_pupuk', $data['id_jenis_pupuk'])
            ->delete($data);
    }

    public function detailData($id_jenis_pupuk)
    {
        return $this->db->table('tbl_jenis_pupuk')
            ->where('id_jenis_pupuk', $id_jenis_pupuk)
            ->get()
            ->getResultArray();
    }
}
