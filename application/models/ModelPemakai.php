<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ModelPemakai extends CI_Model
{

    public function tambahpemakai($datapemakai)
    {
        $query = $this->db->insert('tbl_pemakai', $datapemakai);

        $this->db->db_debug = false;

        if (!$query) {
            return false;
        } else {
            return true;
        }
    }

    public function lihatpemakai($wherepemakai)
    {
        $query = $this->db->get_where('tbl_pemakai', $wherepemakai);

        return $query->result();
    }

    public function lihatsatupemakai($wherepemakai)
    {
        $query = $this->db->get_where('tbl_pemakai', $wherepemakai);

        return $query->result();
    }

    public function ubahpemakai($wherepemakai, $datapemakai)
    {
        $query = $this->db->where($wherepemakai);
        $query = $this->db->update('tbl_pemakai', $datapemakai);

        $this->db->db_debug = false;

        if (!$query) {
            return false;
        } else {
            return true;
        }
    }

    public function hapuspemakai($wherepemakai)
    {
        $query = $this->db->where($wherepemakai);
        $query = $this->db->delete('tbl_pemakai');

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
}

/* End of file ModelPemakai.php */
