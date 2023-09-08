<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPupuk extends Model
{
    protected $table = 'tbl_pupuk';
    public function getAllData()
    {
        return $this->db->table('tbl_pupuk')
            ->join('tbl_jenis_pupuk', 'tbl_jenis_pupuk.id_jenis_pupuk = tbl_pupuk.id_jenis_pupuk ', 'left')
            ->orderBy('id_pupuk', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function insertData($data)
    {
        $this->db->table('tbl_pupuk')->insert($data);
        $this->updateStock($data['id_jenis_pupuk']);
    }

    public function detailData($id_jenis_pupuk)
    {
        return $this->db->table('tbl_pupuk')
            ->select('stock')
            ->where('id_jenis_pupuk', $id_jenis_pupuk)
            ->get()
            ->getRowArray();
    }

    public function getTotalJumlahMasuk($id_jenis_pupuk)
    {
        return $this->db->table($this->table)
            ->selectSum('jumlah_masuk')
            ->where('id_jenis_pupuk', $id_jenis_pupuk)
            ->get()
            ->getRowArray();
    }

    public function updateStock($id_jenis_pupuk)
    {
        $totalPreviousJumlahMasuk = $this->getTotalJumlahMasuk($id_jenis_pupuk);
        $this->db->table($this->table)
            ->where('id_jenis_pupuk', $id_jenis_pupuk)
            ->update(['stock' => $totalPreviousJumlahMasuk['jumlah_masuk']]);
    }

    public function getSaldoTerakhir()
    {
        return $this->db->table('tbl_pupuk')
            ->select('stock')
            ->orderBy('id_pupuk DESC')
            ->limit(1)
            ->get()
            ->getRowArray();
    }
}
