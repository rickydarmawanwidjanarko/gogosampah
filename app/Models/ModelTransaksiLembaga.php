<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTransaksiLembaga extends Model
{
    public function getAllData()
    {
        return $this->db->table('tbl_transaksi_lembaga')
            ->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_transaksi_lembaga.nasabah_id ', 'left')
            ->join('tbl_jenis_sampah', 'tbl_jenis_sampah.id_jenis_sampah = tbl_transaksi_lembaga.id_jenis_sampah ', 'left')
            ->orderBy('id_transaksi_sampah', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function insertData($data)
    {
        $this->db->table('tbl_transaksi_lembaga')
            ->insert($data);
    }

    public function editData($data)
    {
        $this->db->table('tbl_transaksi_lembaga')
            ->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_transaksi_lembaga.nasabah_id ', 'left')
            ->join('tbl_tabungan', 'tbl_tabungan.nasabah_id = tbl_transaksi_lembaga.nasabah_id ', 'left')
            ->where('id_transaksi_sampah', $data['id_transaksi_sampah'])
            ->update($data);
    }

    public function deleteData($data)
    {

        $this->db->table('tbl_transaksi_lembaga')
            ->where('id_transaksi_sampah', $data['id_transaksi_sampah'])
            ->delete($data);
    }

    public function detailData($nasabah_id)
    {
        return $this->db->table('tbl_transaksi_lembaga')
            ->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_transaksi_lembaga.nasabah_id ', 'left')
            ->join('tbl_jenis_sampah', 'tbl_jenis_sampah.id_jenis_sampah = tbl_transaksi_lembaga.id_jenis_sampah ', 'left')
            ->where('nasabah_id', $nasabah_id)
            ->get()
            ->getResultArray();
    }

    public function totalSaldo($nasabah_id)
    {
        return $this->db->table('tbl_transaksi_lembaga')
            ->selectSum('nominal_masuk')
            ->where('nasabah_id', $nasabah_id)
            ->get()
            ->getRowArray();
    }

    public function totalDebit($nasabah_id)
    {
        return $this->db->table('tbl_transaksi_lembaga')
            ->selectSum('jumlah')
            ->where('jenis', '1')
            ->where('nasabah_id', $nasabah_id)
            ->get()
            ->getRowArray();
    }

    public function totalKredit($nasabah_id)
    {
        return $this->db->table('tbl_transaksi_lembaga')
            ->selectSum('jumlah')
            ->where('jenis', '2')
            ->where('nasabah_id', $nasabah_id)
            ->get()
            ->getRowArray();
    }
}
