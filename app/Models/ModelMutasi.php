<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMutasi extends Model
{
    public function getAllData()
    {
        return $this->db->table('tbl_mutasi')
            ->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_mutasi.nasabah_id ', 'left')
            ->orderBy('id_mutasi', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function insertData($data)
    {
        $this->db->table('tbl_mutasi')
            ->insert($data);
    }

    public function editData($data)
    {
        $this->db->table('tbl_mutasi')
            ->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_mutasi.nasabah_id ', 'left')
            ->join('tbl_tabungan', 'tbl_tabungan.nasabah_id = tbl_mutasi.nasabah_id ', 'left')
            ->where('id_mutasi', $data['id_mutasi'])
            ->update($data);
    }

    public function deleteData($data)
    {

        $this->db->table('tbl_mutasi')
            ->where('id_mutasi', $data['id_mutasi'])
            ->delete($data);
    }

    public function detailData($nasabah_id)
    {
        return $this->db->table('tbl_mutasi')
            ->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_mutasi.nasabah_id ', 'left')
            ->where('nasabah_id', $nasabah_id)
            ->get()
            ->getResultArray();
    }

    public function totalSaldo($nasabah_id)
    {
        return $this->db->table('tbl_mutasi')
            ->selectSum('nominal_masuk')
            ->where('nasabah_id', $nasabah_id)
            ->get()
            ->getRowArray();
    }

    public function totalDebit($nasabah_id)
    {
        return $this->db->table('tbl_mutasi')
            ->selectSum('jumlah')
            ->where('jenis', '1')
            ->where('nasabah_id', $nasabah_id)
            ->get()
            ->getRowArray();
    }

    public function totalKredit($nasabah_id)
    {
        return $this->db->table('tbl_mutasi')
            ->selectSum('jumlah')
            ->where('jenis', '2')
            ->where('nasabah_id', $nasabah_id)
            ->get()
            ->getRowArray();
    }
}
