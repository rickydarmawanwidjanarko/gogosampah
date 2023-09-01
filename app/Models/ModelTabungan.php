<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTabungan extends Model
{
    public function getAllData()
    {
        return $this->db->table('tbl_tabungan')
            ->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_tabungan.nasabah_id ', 'left')
            ->orderBy('id_tabungan', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function insertData($data)
    {
        $this->db->table('tbl_tabungan')
            ->insert($data);
    }

    public function editData($data)
    {
        $this->db->table('tbl_tabungan')
            ->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_tabungan.nasabah_id ', 'left')
            ->where('id_tabungan', $data['id_tabungan'])
            ->update($data);
    }

    public function deleteData($data)
    {

        $this->db->table('tbl_tabungan')
            ->where('id_tabungan', $data['id_tabungan'])
            ->delete($data);
    }

    public function detailData($nasabah_id)
    {
        return $this->db->table('tbl_tabungan')
            ->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_tabungan.nasabah_id ', 'left')
            ->where('nasabah_id', $nasabah_id)
            ->get()
            ->getResultArray();
    }

    public function totalSaldo($nasabah_id)
    {
        return $this->db->table('tbl_tabungan')
            ->selectSum('nominal_masuk')
            ->where('nasabah_id', $nasabah_id)
            ->get()
            ->getRowArray();
    }
}
