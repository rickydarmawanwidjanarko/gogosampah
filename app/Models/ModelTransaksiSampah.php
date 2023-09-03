<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTransaksiSampah extends Model
{
    public function getAllData()
    {
        return $this->db->table('tbl_transaksi_sampah')
            ->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_transaksi_sampah.nasabah_id ', 'left')
            ->join('tbl_jenis_sampah', 'tbl_jenis_sampah.id_jenis_sampah = tbl_transaksi_sampah.id_jenis_sampah ', 'left')
            ->orderBy('id_transaksi_sampah', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function insertData($data)
    {
        $this->db->table('tbl_transaksi_sampah')
            ->insert($data);
    }

    public function editData($data)
    {
        $this->db->table('tbl_transaksi_sampah')
            ->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_transaksi_sampah.nasabah_id ', 'left')
            ->join('tbl_tabungan', 'tbl_tabungan.nasabah_id = tbl_transaksi_sampah.nasabah_id ', 'left')
            ->where('id_transaksi_sampah', $data['id_transaksi_sampah'])
            ->update($data);
    }

    public function deleteData($data)
    {

        $this->db->table('tbl_transaksi_sampah')
            ->where('id_transaksi_sampah', $data['id_transaksi_sampah'])
            ->delete($data);
    }

    public function detailData($nasabah_id)
    {
        return $this->db->table('tbl_transaksi_sampah')
            ->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_transaksi_sampah.nasabah_id ', 'left')
            ->join('tbl_jenis_sampah', 'tbl_jenis_sampah.id_jenis_sampah = tbl_transaksi_sampah.id_jenis_sampah ', 'left')
            ->where('nasabah_id', $nasabah_id)
            ->get()
            ->getResultArray();
    }

    public function totalSaldo($nasabah_id)
    {
        return $this->db->table('tbl_transaksi_sampah')
            ->selectSum('nominal_masuk')
            ->where('nasabah_id', $nasabah_id)
            ->get()
            ->getRowArray();
    }

    public function totalDebit($nasabah_id)
    {
        return $this->db->table('tbl_transaksi_sampah')
            ->selectSum('jumlah')
            ->where('jenis', '1')
            ->where('nasabah_id', $nasabah_id)
            ->get()
            ->getRowArray();
    }

    public function totalKredit($nasabah_id)
    {
        return $this->db->table('tbl_transaksi_sampah')
            ->selectSum('jumlah')
            ->where('jenis', '2')
            ->where('nasabah_id', $nasabah_id)
            ->get()
            ->getRowArray();
    }
}
