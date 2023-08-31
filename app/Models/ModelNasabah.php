<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelNasabah extends Model
{
    public function getAllData()
    {
        return $this->db->table('tbl_nasabah')
            ->join('tbl_level', 'tbl_level.id_level = tbl_nasabah.id_level ', 'left')
            ->orderBy('id_nasabah', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getTujuan()
    {
        return $this->db->table('tbl_nasabah')
            ->where('tbl_nasabah.id_nasabah !=',  session()->get('id_nasabah'))
            ->get()
            ->getResultArray();
    }

    public function insertData($data)
    {
        $this->db->table('tbl_nasabah')
            ->insert($data);
    }

    public function editData($data)
    {
        $this->db->table('tbl_nasabah')
            ->where('id_nasabah', $data['id_nasabah'])
            ->update($data);
    }

    public function deleteData($data)
    {
        $this->db->table('tbl_nasabah')
            ->where('id_nasabah', $data['id_nasabah'])
            ->delete($data);
    }

    public function detailData($id_nasabah)
    {
        return $this->db->table('tbl_nasabah')
            ->where('id_nasabah', $id_nasabah)
            ->get()
            ->getRowArray();
    }
}
