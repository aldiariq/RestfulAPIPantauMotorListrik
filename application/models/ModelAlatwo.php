<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ModelAlatwo extends CI_Model
{

    public function tambahalatwo($dataalatwo)
    {
        $query = $this->db->insert('tbl_alat_wo', $dataalatwo);

        $this->db->db_debug = false;

        if (!$query) {
            return false;
        } else {
            return true;
        }
    }

    public function lihatalatwo($wherealatwo)
    {
        $query = $this->db->get_where('tbl_alat_wo', $wherealatwo);
        return $query->result();
    }

    public function ubahalatwo($wherealatwo, $dataalatwo)
    {
        $query = $this->db->where($wherealatwo);
        $query = $this->db->update('tbl_alat_wo', $dataalatwo);

        $this->db->db_debug = false;

        if (!$query) {
            return false;
        } else {
            return true;
        }
    }

    public function hapusalatwo($wherealatwo)
    {
        $query = $this->db->where($wherealatwo);
        $query = $this->db->delete('tbl_alat_wo');

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
}

/* End of file ModelPengguna.php */
