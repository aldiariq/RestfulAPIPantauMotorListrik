<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class ControllerAlatwo extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelAlatwo');
    }

    public function tambahalatwo_post()
    {
        $validasitoken = $this->authorizationtoken->validateToken();

        if (!empty($validasitoken) && $validasitoken['status'] === TRUE) {
            $kode_alat_wo = $this->input->post('kode_alat_wo');
            $nama_alat_wo = $this->input->post('nama_alat_wo');
            $keterangan_alat_wo = $this->input->post('keterangan_alat_wo');
            $tgl_beli_alat_wo = $this->input->post('tgl_beli_alat_wo');
            $usia_maksimum_alat_wo = $this->input->post('usia_maksimum_alat_wo');
            $usia_service_rekomendasi = $this->input->post('usia_service_rekomendasi');
            $tgl_dibuat = date("Y-m-d");
            $tgl_diupdate = date("Y-m-d");
            $id_user = $this->input->post('id_user');

            $dataalatwo = array(
                'kode_alat_wo' => $kode_alat_wo,
                'nama_alat_wo' => $nama_alat_wo,
                'keterangan_alat_wo' => $keterangan_alat_wo,
                'tgl_beli_alat_wo' => $tgl_beli_alat_wo,
                'usia_maksimum_alat_wo' => $usia_maksimum_alat_wo,
                'usia_service_rekomendasi' => $usia_service_rekomendasi,
                'tgl_dibuat' => $tgl_dibuat,
                'tgl_diupdate' => $tgl_diupdate,
                'id_user' => $id_user
            );

            if ($this->ModelAlatwo->tambahalatwo($dataalatwo)) {
                $keterangan = array(
                    'berhasil' => true,
                    'pesan' => 'Berhasil Menambahkan Alat WO'
                );

                $this->set_response(
                    $keterangan,
                    200
                );
            } else {
                $keterangan = array(
                    'berhasil' => false,
                    'pesan' => 'Gagal Menambahkan Alat WO'
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

    public function lihatalatwo_get()
    {
        $validasitoken = $this->authorizationtoken->validateToken();

        if (!empty($validasitoken) && $validasitoken['status'] === TRUE) {
            $id_user = $this->uri->segment(3);

            $wherealatwo = array(
                'id_user' => $id_user
            );

            $dataalatwo = $this->ModelAlatwo->lihatalatwo($wherealatwo);

            $keterangan = array(
                'berhasil' => true,
                'pesan' => 'Berhasil Mendapatkan Alat WO',
                'alatwo' => $dataalatwo
            );

            $this->set_response(
                $keterangan,
                200
            );
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

    public function lihatsatualatwo_get()
    {
        $validasitoken = $this->authorizationtoken->validateToken();

        if (!empty($validasitoken) && $validasitoken['status'] === TRUE) {
            $id_user = $this->uri->segment(3);
            $id = $this->uri->segment(4);

            $wherealatwo = array(
                'id_user' => $id_user,
                'id' => $id
            );

            $dataalatwo = $this->ModelAlatwo->lihatalatwo($wherealatwo);

            $keterangan = array(
                'berhasil' => true,
                'pesan' => 'Berhasil Mendapatkan Alat WO',
                'alatwo' => $dataalatwo
            );

            $this->set_response(
                $keterangan,
                200
            );
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

    public function hapusalatwo_get()
    {
        $validasitoken = $this->authorizationtoken->validateToken();

        if (!empty($validasitoken) && $validasitoken['status'] === TRUE) {
            $id_user = $this->uri->segment(3);
            $id = $this->uri->segment(4);

            $wherealatwo = array(
                'id_user' => $id_user,
                'id' => $id
            );

            if ($this->ModelAlatwo->hapusalatwo($wherealatwo)) {
                $keterangan = array(
                    'berhasil' => true,
                    'pesan' => 'Berhasil Menghapus Alat WO',
                );
    
                $this->set_response(
                    $keterangan,
                    200
                );
            } else {
                $keterangan = array(
                    'berhasil' => false,
                    'pesan' => 'Gagal Menghapus Alat WO',
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

    public function ubahalatwo_post()
    {
        $validasitoken = $this->authorizationtoken->validateToken();

        if (!empty($validasitoken) && $validasitoken['status'] === TRUE) {
            $id_user = $this->uri->segment(3);
            $id = $this->uri->segment(4);

            $kode_alat_wo = $this->input->post('kode_alat_wo');
            $nama_alat_wo = $this->input->post('nama_alat_wo');
            $keterangan_alat_wo = $this->input->post('keterangan_alat_wo');
            $tgl_beli_alat_wo = $this->input->post('tgl_beli_alat_wo');
            $usia_maksimum_alat_wo = $this->input->post('usia_maksimum_alat_wo');
            $usia_service_rekomendasi = $this->input->post('usia_service_rekomendasi');
            $tgl_diupdate = date("Y-m-d");
            $id_user = $this->input->post('id_user');

            $wherealatwo = array(
                'id_user' => $id_user,
                'id' => $id
            );

            $dataalatwo = array(
                'kode_alat_wo' => $kode_alat_wo,
                'nama_alat_wo' => $nama_alat_wo,
                'keterangan_alat_wo' => $keterangan_alat_wo,
                'tgl_beli_alat_wo' => $tgl_beli_alat_wo,
                'usia_maksimum_alat_wo' => $usia_maksimum_alat_wo,
                'usia_service_rekomendasi' => $usia_service_rekomendasi,
                'tgl_diupdate' => $tgl_diupdate,
                'id_user' => $id_user
            );

            if ($this->ModelAlatwo->ubahalatwo($wherealatwo, $dataalatwo)) {
                $keterangan = array(
                    'berhasil' => true,
                    'pesan' => 'Berhasil Mengubah Alat WO'
                );
    
                $this->set_response(
                    $keterangan,
                    200
                );
            } else {
                $keterangan = array(
                    'berhasil' => false,
                    'pesan' => 'Gagal Mengubah Alat WO'
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
}

/* End of file ControllerPengguna.php */
