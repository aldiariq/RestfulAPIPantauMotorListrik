<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ModelKerusakanmotor extends CI_Model
{

    public function tambahkerusakanmotor($datakerusakanmotor)
    {
        $query = $this->db->insert('tbl_kerusakan_motor', $datakerusakanmotor);

        $this->db->db_debug = false;

        if (!$query) {
            return false;
        } else {
            return true;
        }
    }

    public function lihatkerusakanmotor($wherekerusakanmotor)
    {
        $query = $this->db->get_where('tbl_kerusakan_motor', $wherekerusakanmotor);
        return $query->result();
    }

    public function ubahkerusakanmotor($wherekerusakanmotor, $datakerusakanmotor)
    {
        $query = $this->db->where($wherekerusakanmotor);
        $query = $this->db->update('tbl_kerusakan_motor', $datakerusakanmotor);

        $this->db->db_debug = false;

        if (!$query) {
            return false;
        } else {
            return true;
        }
    }

    public function hapuskerusakanmotor($wherekerusakanmotor)
    {
        $query = $this->db->where($wherekerusakanmotor);
        $query = $this->db->delete('tbl_kerusakan_motor');

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
}

/* End of file ModelPengguna.php */
