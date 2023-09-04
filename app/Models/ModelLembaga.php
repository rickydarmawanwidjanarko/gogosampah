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

    public function insertOrder($id_lembaga, $arr_jenis_sampah, $arr_berat) {

        $total = 0;
        foreach ($arr_jenis_sampah as $key => $id_jenis_sampah) {
            $harga_jenis_sampah = $this->db->table('tbl_harga_sampah')
                ->where('id_jenis_sampah', $id_jenis_sampah)
                ->get()
                ->getRowArray();
            
            if (empty($harga_jenis_sampah)) {
                return false;
            }

            $total += $harga_jenis_sampah['harga'] * $arr_berat[$key];
        }

        $this->db->table('tbl_order_sampah')->insert([
            'id_lembaga' => $id_lembaga,
            'kode_order' => 'ORD' . strtoupper(uniqid()),
            'created_at' => date('Y-m-d H:i:s'),
            'total' => $total
        ]);
        $last_id = $this->db->insertID();

        foreach ($arr_jenis_sampah as $key => $id_jenis_sampah) {
            $harga_jenis_sampah = $this->db->table('tbl_harga_sampah')
                ->where('id_jenis_sampah', $id_jenis_sampah)
                ->get()
                ->getRowArray();

            $this->db->table('tbl_order_sampah_detail')->insert([
                'id_order_sampah' => $last_id,
                'id_lembaga' => $id_lembaga,
                'id_jenis_sampah' => $id_jenis_sampah,
                'berat' => $arr_berat[$key],
                'subtotal' => $harga_jenis_sampah['harga'] * $arr_berat[$key]
            ]);
        }

        return true;
    }
}
