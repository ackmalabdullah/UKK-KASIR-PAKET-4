<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_petugas extends CI_Model
{
    public function GetPetugas()
    {
        $query = "SELECT * FROM tb_petugas";
        return $this->db->query($query);
    }

    public function GetPetugasById($id)
    {
        $query = "SELECT * FROM tb_petugas WHERE id_user = '$id'";
        return $this->db->query($query);
    }
}

/* End of file Model_petugas.php */
