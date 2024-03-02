<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_produk extends CI_Model
{
    public function GetProduk()
    {
        $query = "SELECT * FROM tb_produk";
        return $this->db->query($query);
    }
    public function GetProdukById($id)
    {
        $query = "SELECT * FROM tb_produk WHERE id_produk = '$id'";
        return $this->db->query($query);
    }
}

/* End of file Model_produk.php */
