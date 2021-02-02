<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class ControllerKerusakanmotor extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelKerusakanmotor');
    }

    public function tambahkerusakanmotor_post()
    {
        $validasitoken = $this->authorizationtoken->validateToken();

        if (!empty($validasitoken) && $validasitoken['status'] === TRUE) {
            $tgl_masuk = $this->input->post('tgl_masuk');
            $tgl_selesai = $this->input->post('tgl_selesai');
            $tgl_keluar = $this->input->post('tgl_keluar');
            $kode_alat_wo = $this->input->post('kode_alat_wo');
            $kode_pemakai = $this->input->post('kode_pemakai');
            $material_bearing = $this->input->post('material_bearing');
            $material_kawat_kg = $this->input->post('material_kawat_kg');
            $nomor_wo = $this->input->post('nomor_wo');
            $keterangan = $this->input->post('keterangan');
            $dll = $this->input->post('dll');
            $tgl_dibuat = date("Y-m-d");
            $tgl_diupdate = date("Y-m-d");
            $id_user = $this->input->post('id_user');

            $datakerusakanmotor = array(
                'tgl_masuk' => $tgl_masuk,
                'tgl_selesai' => $tgl_selesai,
                'tgl_keluar' => $tgl_keluar,
                'kode_alat_wo' => $kode_alat_wo,
                'kode_pemakai' => $kode_pemakai,
                'material_bearing' => $material_bearing,
                'material_kawat_kg' => $material_kawat_kg,
                'nomor_wo' => $nomor_wo,
                'keterangan' => $keterangan,
                'dll' => $dll,
                'tgl_dibuat' => $tgl_dibuat,
                'tgl_diupdate' => $tgl_diupdate,
                'id_user' => $id_user
            );

            if ($this->ModelKerusakanmotor->tambahkerusakanmotor($datakerusakanmotor)) {
                $keterangan = array(
                    'berhasil' => true,
                    'pesan' => 'Berhasil Menambahkan Kerusakan Motor'
                );

                $this->set_response(
                    $keterangan,
                    200
                );
            } else {
                $keterangan = array(
                    'berhasil' => false,
                    'pesan' => 'Gagal Menambahkan Kerusakan Motor'
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

    public function lihatkerusakanmotor_get()
    {
        $validasitoken = $this->authorizationtoken->validateToken();

        if (!empty($validasitoken) && $validasitoken['status'] === TRUE) {
            $id_user = $this->uri->segment(3);

            $wherekerusakanmotor = array(
                'id_user' => $id_user
            );

            $datakerusakanmotor = $this->ModelKerusakanmotor->lihatkerusakanmotor($wherekerusakanmotor);

            $keterangan = array(
                'berhasil' => true,
                'pesan' => 'Berhasil Mendapatkan Kerusakan Motor',
                'alatwo' => $datakerusakanmotor
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

    public function lihatsatukerusakanmotor_get()
    {
        $validasitoken = $this->authorizationtoken->validateToken();

        if (!empty($validasitoken) && $validasitoken['status'] === TRUE) {
            $id_user = $this->uri->segment(3);
            $id = $this->uri->segment(4);

            $wherekerusakanmotor = array(
                'id_user' => $id_user,
                'id' => $id
            );

            $datakerusakanmotor = $this->ModelKerusakanmotor->lihatkerusakanmotor($wherekerusakanmotor);

            $keterangan = array(
                'berhasil' => true,
                'pesan' => 'Berhasil Mendapatkan Kerusakan Motor',
                'alatwo' => $datakerusakanmotor
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

    public function hapuskerusakanmotor_get()
    {
        $validasitoken = $this->authorizationtoken->validateToken();

        if (!empty($validasitoken) && $validasitoken['status'] === TRUE) {
            $id_user = $this->uri->segment(3);
            $id = $this->uri->segment(4);

            $wherekerusakanmotor = array(
                'id_user' => $id_user,
                'id' => $id
            );

            if ($this->ModelKerusakanmotor->hapuskerusakanmotor($wherekerusakanmotor)) {
                $keterangan = array(
                    'berhasil' => true,
                    'pesan' => 'Berhasil Menghapus Kerusakan Motor',
                );
    
                $this->set_response(
                    $keterangan,
                    200
                );
            } else {
                $keterangan = array(
                    'berhasil' => false,
                    'pesan' => 'Gagal Menghapus Kerusakan Motor',
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

    public function ubahkerusakanmotor_post()
    {
        $validasitoken = $this->authorizationtoken->validateToken();

        if (!empty($validasitoken) && $validasitoken['status'] === TRUE) {
            $id_user = $this->uri->segment(3);
            $id = $this->uri->segment(4);

            $tgl_masuk = $this->input->post('tgl_masuk');
            $tgl_selesai = $this->input->post('tgl_selesai');
            $tgl_keluar = $this->input->post('tgl_keluar');
            $kode_alat_wo = $this->input->post('kode_alat_wo');
            $kode_pemakai = $this->input->post('kode_pemakai');
            $material_bearing = $this->input->post('material_bearing');
            $material_kawat_kg = $this->input->post('material_kawat_kg');
            $nomor_wo = $this->input->post('nomor_wo');
            $keterangan = $this->input->post('keterangan');
            $dll = $this->input->post('dll');
            $tgl_diupdate = date("Y-m-d");
            $id_user = $this->input->post('id_user');

            $datakerusakanmotor = array(
                'tgl_masuk' => $tgl_masuk,
                'tgl_selesai' => $tgl_selesai,
                'tgl_keluar' => $tgl_keluar,
                'kode_alat_wo' => $kode_alat_wo,
                'kode_pemakai' => $kode_pemakai,
                'material_bearing' => $material_bearing,
                'material_kawat_kg' => $material_kawat_kg,
                'nomor_wo' => $nomor_wo,
                'keterangan' => $keterangan,
                'dll' => $dll,
                'tgl_diupdate' => $tgl_diupdate,
                'id_user' => $id_user
            );

            $wherealatwo = array(
                'id_user' => $id_user,
                'id' => $id
            );

            if ($this->ModelKerusakanmotor->ubahkerusakanmotor($wherealatwo, $datakerusakanmotor)) {
                $keterangan = array(
                    'berhasil' => true,
                    'pesan' => 'Berhasil Mengubah Kerusakan Motor'
                );
    
                $this->set_response(
                    $keterangan,
                    200
                );
            } else {
                $keterangan = array(
                    'berhasil' => false,
                    'pesan' => 'Gagal Mengubah Kerusakan Motor'
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
