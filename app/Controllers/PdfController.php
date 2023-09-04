<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ModelTransaksiSampah;
use App\Models\ModelNasabah;
use App\Models\ModelTabungan;
use App\Models\ModelJenisSampah;
use App\Models\ModelHargaSampah;

class PdfController extends Controller
{
    public function __construct()
    {
        $this->ModelTransaksiSampah = new ModelTransaksiSampah();
        $this->ModelNasabah = new ModelNasabah();
        $this->ModelTabungan = new ModelTabungan();
        $this->ModelJenisSampah = new ModelJenisSampah();
        $this->ModelHargaSampah = new ModelHargaSampah();
        helper('form');
    }

    public function view_pdf($id_nasabah)
    {
        $data_nasabah = $this->ModelNasabah->detailData($id_nasabah);
        $data_tabungan = $this->ModelTabungan->detailData($id_nasabah);
        $data_transaksi_sampah = $this->ModelTransaksiSampah->detailData($id_nasabah);
        $data_jenis_sampah = $this->ModelJenisSampah->getAllData();
        $total_saldo = $this->ModelTabungan->totalSaldo($id_nasabah);
        $total_debit = $this->ModelTransaksiSampah->totalDebit($id_nasabah);
        $total_kredit = $this->ModelTransaksiSampah->totalKredit($id_nasabah);
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Invoice',
            'transaksisampah' => $data_transaksi_sampah,
            'jenissampah' => $data_jenis_sampah,
            'nasabah' => $data_nasabah,
            'tabungan' => $data_tabungan,
            'tot_saldo' => $total_saldo,
            'tot_debit' => $total_debit,
            'tot_kredit' => $total_kredit,
        ];
        // dd($data);
        return view('v_Pdf', $data);
    }

    public function generate($id_nasabah)
    {
        $data_nasabah = $this->ModelNasabah->detailData($id_nasabah);
        $data_tabungan = $this->ModelTabungan->detailData($id_nasabah);
        $data_transaksi_sampah = $this->ModelTransaksiSampah->detailData($id_nasabah);
        $data_jenis_sampah = $this->ModelJenisSampah->getAllData();
        $total_saldo = $this->ModelTabungan->totalSaldo($id_nasabah);
        $total_debit = $this->ModelTransaksiSampah->totalDebit($id_nasabah);
        $total_kredit = $this->ModelTransaksiSampah->totalKredit($id_nasabah);
        $data = [
            'title' => 'Gogogreen',
            'subtitle' => 'Invoice',
            'transaksisampah' => $data_transaksi_sampah,
            'jenissampah' => $data_jenis_sampah,
            'nasabah' => $data_nasabah,
            'tabungan' => $data_tabungan,
            'tot_saldo' => $total_saldo,
            'tot_debit' => $total_debit,
            'tot_kredit' => $total_kredit,
        ];
        return view('v_CetakPdf', $data);
    }
}
