<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLevel extends Model
{
    public function getAllData()
    {
        return $this->db->table('tbl_level')
            ->orderBy('id_level', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function insertData($data)
    {
        $this->db->table('tbl_level')
            ->insert($data);
    }

    public function editData($data)
    {
        $this->db->table('tbl_level')
            ->where('id_level', $data['id_level'])
            ->update($data);
    }

    public function deleteData($data)
    {

        $this->db->table('tbl_level')
            ->where('id_level', $data['id_level'])
            ->delete($data);
    }
}
