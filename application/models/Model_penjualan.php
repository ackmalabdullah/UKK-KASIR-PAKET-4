<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_penjualan extends CI_Model
{

    public function GetPenjualan()
    {
        $query = "SELECT * FROM tb_penjualan
        JOIN tb_pelanggan ON tb_pelanggan.id_pelanggan = tb_penjualan.id_pelanggan
        ORDER BY id_penjualan DESC ";
        return $this->db->query($query);
    }

    public function GetIdPenjualan()
    {
        $query = "SELECT id_penjualan FROM tb_penjualan ORDER BY id_penjualan DESC LIMIT 1";
        return $this->db->query($query);
    }

    public function GetPenjualanById($id_penjualan)
    {
        $query = "SELECT * FROM tb_penjualan WHERE id_penjualan = '$id_penjualan'";
        return $this->db->query($query);
    }

    public function GetDetailPenjualanById($id_penjualan)
    {
        $query = "SELECT tb_pelanggan.id_pelanggan, tb_pelanggan.nama, tb_penjualan.id_penjualan,tb_penjualan.bayar, tb_penjualan.tanggal_penjualan, tb_detailpenjualan.jumlah_produk, tb_produk.nama_produk, tb_produk.harga FROM tb_detailpenjualan 
        JOIN tb_penjualan ON tb_penjualan.id_penjualan = tb_detailpenjualan.id_penjualan
        JOIN tb_pelanggan ON tb_pelanggan.id_pelanggan = tb_penjualan.id_pelanggan
        JOIN tb_produk ON tb_produk.id_produk = tb_detailpenjualan.id_produk
        WHERE tb_detailpenjualan.id_penjualan = '$id_penjualan'";
        return $this->db->query($query);
    }

    public function FilterPenjualan($tanggal_awal, $tanggal_akhir)
    {
        $query = "SELECT * FROM tb_penjualan
        JOIN tb_pelanggan ON tb_pelanggan.id_pelanggan = tb_penjualan.id_pelanggan
        WHERE tanggal_penjualan BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY total_bayar,tanggal_penjualan ASC ";
        return $this->db->query($query);
    }
}

/* End of file Model_penjualan.php */
