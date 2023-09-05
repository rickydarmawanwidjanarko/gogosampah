<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelNasabah extends Model
{
    public function getAllData()
    {
        return $this->db->table('tbl_nasabah')
            ->join('tbl_level', 'tbl_level.id_level = tbl_nasabah.id_level ', 'left')
            ->join('tbl_agama', 'tbl_agama.id_agama = tbl_nasabah.id_agama ', 'left')
            ->orderBy('id_nasabah', 'ASC')
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

    public function getProfile()
    {
        return $this->db->table('tbl_nasabah')
            ->join('tbl_agama', 'tbl_agama.id_agama = tbl_nasabah.id_agama ', 'left')
            ->where('id_nasabah', session()->get('id_nasabah'))
            ->get()
            ->getRowArray();
    }
}
