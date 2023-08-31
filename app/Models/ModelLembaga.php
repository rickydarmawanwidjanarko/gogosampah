<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLembaga extends Model
{
    public function getAllData()
    {
        return $this->db->table('tbl_lembaga')
            ->orderBy('id_lembaga', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function insertData($data)
    {
        $this->db->table('tbl_lembaga')
            ->insert($data);
    }

    public function editData($data)
    {
        $this->db->table('tbl_lembaga')
            ->where('id_lembaga', $data['id_lembaga'])
            ->update($data);
    }

    public function deleteData($data)
    {
        $this->db->table('tbl_lembaga')
            ->where('id_lembaga', $data['id_lembaga'])
            ->delete($data);
    }

    public function detailData($id_lembaga)
    {
        return $this->db->table('tbl_lembaga')
            ->where('id_lembaga', $id_lembaga)
            ->get()
            ->getRowArray();
    }
}
