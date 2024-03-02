<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_pelanggan extends CI_Model
{
    public function GetPelanggan()
    {
        $query = "SELECT * FROM tb_pelanggan";
        return $this->db->query($query);
    }

    public function GetIdPelanggan()
    {
        $query = "SELECT * FROM tb_pelanggan ORDER BY id_pelanggan DESC LIMIT 1";
        return $this->db->query($query);
    }

    public function GetPelangganById($id)
    {
        $query = "SELECT * FROM tb_pelanggan WHERE id_pelanggan = '$id'";
        return $this->db->query($query);
    }
}

/* End of file Model_pelanggan.php */
