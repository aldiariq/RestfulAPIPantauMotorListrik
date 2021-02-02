<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ModelUser extends CI_Model
{

    public function daftaruser($datauser)
    {
        $query = $this->db->insert('tbl_user', $datauser);

        $this->db->db_debug = false;

        if (!$query) {
            return false;
        } else {
            return true;
        }
    }

    public function masukuser($datauser)
    {
        $query = $this->db->get_where('tbl_user', $datauser);

        if ($query->num_rows() != 1) {
            return false;
        } else {
            return true;
        }
    }

    public function getuser($datauser)
    {
        $query = $this->db->select('id, nip, nama, alamat, nohp, email, foto, status, statusaktivasi, tgl_dibuat, tgl_diupdate');
        $query = $this->db->from('tbl_user');
        $query = $this->db->where($datauser);
        $query = $this->db->get();
        return $query->result();
    }

    public function getpasswordlamauser($datauser){
        $query = $this->db->select('password');
        $query = $this->db->from('tbl_user');
        $query = $this->db->where($datauser);
        $query = $this->db->get();
        return $query->result();
    }

    public function gantipassworduser($datauser, $passworduser){
        $query = $this->db->where($datauser);
        $query = $this->db->update('tbl_user', $passworduser);

        $this->db->db_debug = false;

        if (!$query) {
            return false;
        } else {
            return true;
        }
    }

    public function aktivasiuser($whereuser, $datauser)
    {
        $query = $this->db->where($whereuser);
        $query = $this->db->update('tbl_user', $datauser);

        $this->db->db_debug = false;

        if (!$query) {
            return false;
        } else {
            return true;
        }
    }
}

/* End of file ModelPengguna.php */
