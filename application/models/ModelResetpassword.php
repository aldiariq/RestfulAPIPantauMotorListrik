<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelResetpassword extends CI_Model {

    public function tambahresetpassword($dataresetpassword)
    {
        $query = $this->db->insert('tbl_reset_password', $dataresetpassword);

        $this->db->db_debug = false;

        if (!$query) {
            return false;
        } else {
            return true;
        }
    }

    public function cekresetpassword($whereresetpassword)
    {
        $query = $this->db->get_where('tbl_reset_password', $whereresetpassword);

        return $query->result();
    }

    public function hapusresetpassword($whereresetpassword)
    {
        $query = $this->db->where($whereresetpassword);
        $query = $this->db->delete('tbl_reset_password');

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
}

/* End of file ModelKonfirmasipendaftaran.php */
