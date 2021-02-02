<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class ControllerPemakai extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelPemakai');
    }

    public function tambahpemakai_post()
    {
        $validasitoken = $this->authorizationtoken->validateToken();

        if (!empty($validasitoken) && $validasitoken['status'] === TRUE) {
            $kode_pemakai = $this->input->post('kode_pemakai');
            $keterangan_pemakai = $this->input->post('keterangan_pemakai');
            $tgl_dibuat = date("Y-m-d");
            $tgl_diupdate = date("Y-m-d");
            $id_user = $this->input->post('id_user');

            $datapemakai = array(
                'kode_pemakai' => $kode_pemakai,
                'keterangan_pemakai' => $keterangan_pemakai,
                'tgl_dibuat' => $tgl_dibuat,
                'tgl_diupdate' => $tgl_diupdate,
                'id_user' => $id_user
            );

            if ($this->ModelPemakai->tambahpemakai($datapemakai)) {
                $keterangan = array(
                    'berhasil' => true,
                    'pesan' => 'Berhasil Menambahkan Pemakai'
                );

                $this->set_response(
                    $keterangan,
                    200
                );
            } else {
                $keterangan = array(
                    'berhasil' => false,
                    'pesan' => 'Gagal Menambahkan Pemakai'
                );

                $this->set_response(
                    $keterangan,
                    401
                );
            }
        } else {
            $keterangan = array(
                'berhasil' => false,
                'pesan' => 'Token Tidak Valid'
            );

            $this->set_response(
                $keterangan,
                401
            );
        }
    }

    public function lihatpemakai_get()
    {
        $validasitoken = $this->authorizationtoken->validateToken();

        if (!empty($validasitoken) && $validasitoken['status'] === TRUE) {
            $id_user = $this->uri->segment(3);

            $wherepemakai = array(
                'id_user' => $id_user
            );

            $datapemakai = $this->ModelPemakai->lihatpemakai($wherepemakai);

            $keterangan = array(
                'berhasil' => true,
                'pesan' => 'Berhasil Mendapatkan Data Pemakai',
                'pemakai' => $datapemakai
            );

            $this->set_response(
                $keterangan,
                401
            );
        } else {
            $keterangan = array(
                'berhasil' => false,
                'pesan' => 'Token Tidak Valid',
                'pemakai' => null
            );

            $this->set_response(
                $keterangan,
                401
            );
        }
    }

    public function lihatsatupemakai_get()
    {
        $validasitoken = $this->authorizationtoken->validateToken();

        if (!empty($validasitoken) && $validasitoken['status'] === TRUE) {
            $id_user = $this->uri->segment(3);
            $id = $this->uri->segment(4);

            $wherepemakai = array(
                'id_user' => $id_user,
                'id' => $id
            );

            $datapemakai = $this->ModelPemakai->lihatsatupemakai($wherepemakai);

            $keterangan = array(
                'berhasil' => true,
                'pesan' => 'Berhasil Mendapatkan Data Pemakai',
                'pemakai' => $datapemakai
            );

            $this->set_response(
                $keterangan,
                200
            );
        } else {
            $keterangan = array(
                'berhasil' => false,
                'pesan' => 'Token Tidak Valid',
                'pemakai' => null
            );

            $this->set_response(
                $keterangan,
                401
            );
        }
    }

    public function hapuspemakai_get()
    {
        $validasitoken = $this->authorizationtoken->validateToken();

        if (!empty($validasitoken) && $validasitoken['status'] === TRUE) {
            $id_user = $this->uri->segment(3);
            $id = $this->uri->segment(4);

            $wherepemakai = array(
                'id_user' => $id_user,
                'id' => $id
            );

            if ($this->ModelPemakai->hapuspemakai($wherepemakai)) {
                $keterangan = array(
                    'berhasil' => true,
                    'pesan' => 'Berhasil Menghapus Pemakai',
                );
    
                $this->set_response(
                    $keterangan,
                    200
                );
            } else {
                $keterangan = array(
                    'berhasil' => false,
                    'pesan' => 'Gagal Menghapus Pemakai',
                );
    
                $this->set_response(
                    $keterangan,
                    401
                );
            }
        } else {
            $keterangan = array(
                'berhasil' => false,
                'pesan' => 'Token Tidak Valid',
            );

            $this->set_response(
                $keterangan,
                401
            );
        }
        
    }

    public function ubahpemakai_post()
    {
        $validasitoken = $this->authorizationtoken->validateToken();

        if (!empty($validasitoken) && $validasitoken['status'] === TRUE) {
            $id_user = $this->uri->segment(3);
            $id = $this->uri->segment(4);

            $wherepemakai = array(
                'id_user' => $id_user,
                'id' => $id,
                'tgl_diupdate' => date("Y-m-d")
            );

            $kode_pemakai = $this->input->post('kode_pemakai');
            $keterangan_pemakai = $this->input->post('keterangan_pemakai');

            $datapemakai = array(
                'kode_pemakai' => $kode_pemakai,
                'keterangan_pemakai' => $keterangan_pemakai
            );

            if ($this->ModelPemakai->ubahpemakai($wherepemakai, $datapemakai)) {
                $keterangan = array(
                    'berhasil' => true,
                    'pesan' => 'Berhasil Mengubah Pemakai',
                );

                $this->set_response(
                    $keterangan,
                    200
                );
            } else {
                $keterangan = array(
                    'berhasil' => false,
                    'pesan' => 'Gagal Mengubah Pemakai',
                );

                $this->set_response(
                    $keterangan,
                    401
                );
            }
        } else {
            $keterangan = array(
                'berhasil' => false,
                'pesan' => 'Token Tidak Valid',
                'pemakai' => null
            );

            $this->set_response(
                $keterangan,
                401
            );
        }
    }
}

/* End of file Controllername.php */
