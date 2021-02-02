<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelKonfirmasipendaftaran extends CI_Model {
    public function tambahkonfirmasi($datakonfirmasi)
    {
        $query = $this->db->insert('tbl_konfirmasi_pendaftaran', $datakonfirmasi);

        $this->db->db_debug = false;

        if (!$query) {
            return false;
        } else {
            return true;
        }
    }

    public function cekkonfirmasi($wherekonfirmasi)
    {
        $query = $this->db->get_where('tbl_konfirmasi_pendaftaran', $wherekonfirmasi);

        return $query->result();
    }

    public function hapuskonfirmasi($wherekonfirmasi)
    {
        $query = $this->db->where($wherekonfirmasi);
        $query = $this->db->delete('tbl_konfirmasi_pendaftaran');

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
}

/* End of file ModelKonfirmasipendaftaran.php */
