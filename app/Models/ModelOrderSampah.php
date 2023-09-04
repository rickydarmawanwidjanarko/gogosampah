<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelOrderSampah extends Model
{
    public function getAllData()
    {
        return $this->db->table('tbl_order_sampah')
            ->get()
            ->getResultArray();
    }

    public function getDataBylembaga($id_lembaga)
    {
        return $this->db->table('tbl_order_sampah')
            ->where('id_lembaga', $id_lembaga)
            ->get()
            ->getResultArray();
    }
}
