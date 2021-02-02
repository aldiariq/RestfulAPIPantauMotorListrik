<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class ControllerUser extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelUser');
        $this->load->model('ModelKonfirmasipendaftaran');
        $this->load->model('ModelResetpassword');
    }

    public function daftaruser_post()
    {
        $nip = $this->input->post('nip');
        $password = md5($this->input->post('password'));
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $nohp = $this->input->post('nohp');
        $email = $this->input->post('email');

        if (!is_dir('./FileUpload/Foto/' . $nip)) {
            mkdir('./FileUpload/Foto/' . $nip, 0777, TRUE);
        }

        $config['upload_path'] = './FileUpload/Foto/' . $nip;
        $config['allowed_types'] = '*';
        $config['max_size']    = '1000000';
        $config['remove_spaces'] = TRUE;
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);
        $upload = $this->upload->do_upload('foto');
        $upload = $this->upload->data();

        $foto = $upload['file_name'];
        $status = 'USER';
        $statusaktivasi = 'TIDAKAKTIF';
        $tgl_dibuat = date("Y-m-d");
        $tgl_diupdate = date("Y-m-d");

        $datapengguna = array(
            'nip' => $nip,
            'password' => $password,
            'nama' => $nama,
            'alamat' => $alamat,
            'nohp' => $nohp,
            'email' => $email,
            'foto' => $foto,
            'status' => $status,
            'statusaktivasi' => $statusaktivasi,
            'tgl_dibuat' => $tgl_dibuat,
            'tgl_diupdate' => $tgl_diupdate
        );

        if ($this->ModelUser->daftaruser($datapengguna)) {
            $datauser = array(
                'email' => $email
            );

            $kodeunik = random_string('alnum', 32);

            foreach ($this->ModelUser->getuser($datauser) as $data) {
                $datakonfirmasi = array(
                    'email' => $email,
                    'kodeunik' => $kodeunik,
                    'id_user' => $data->id
                );
            }

            if ($this->ModelKonfirmasipendaftaran->tambahkonfirmasi($datakonfirmasi)) {

                $emailtujuan = $email;

                $this->email->from('sistem@monitoring.com', 'Sistem');
                $this->email->to($emailtujuan);

                $this->email->subject('Konfirmasi Email');
                $this->email->message('Klik Link Berikut Untuk Aktivasi Akun <a href="' . base_url() . "api/aktivasiuser/" . $kodeunik . '">AKTIF</a>');

                $this->email->set_mailtype('html');

                $this->email->send();

                $keterangan = array(
                    'berhasil' => true,
                    'pesan' => 'Berhasil Mendaftarkan User'
                );

                $this->set_response(
                    $keterangan,
                    200
                );
            } else {
                $keterangan = array(
                    'berhasil' => false,
                    'pesan' => 'Gagal Mendaftarkan User'
                );

                $this->set_response(
                    $keterangan,
                    401
                );
            }
        } else {
            $keterangan = array(
                'berhasil' => false,
                'pesan' => 'Gagal Mendaftarkan User'
            );

            $this->set_response(
                $keterangan,
                401
            );
        }
    }

    public function masukuser_post()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $datauser = array(
            'email' => $email,
            'password' => md5($password),
            'statusaktivasi' => 'AKTIF'
        );

        if ($this->ModelUser->masukuser($datauser)) {
            foreach ($this->ModelUser->getuser($datauser) as $data) {
                $datatoken = array(
                    'id' => $data->id,
                    'email' => $data->email,
                    'time' => time()
                );
            }

            $tokenuser = $this->authorizationtoken->generateToken($datatoken);

            $keterangan = array(
                'berhasil' => true,
                'pesan' => 'Berhasil Masuk',
                'token' => $tokenuser,
                'pengguna' => $this->ModelUser->getuser($datauser)
            );

            $this->set_response(
                $keterangan,
                200
            );
        } else {
            $keterangan = array(
                'berhasil' => false,
                'pesan' => 'Gagal Masuk',
                'token' => null,
                'pengguna' => null
            );

            $this->set_response(
                $keterangan,
                401
            );
        }
    }

    public function lihatdatauser_get()
    {
        $validasitoken = $this->authorizationtoken->validateToken();

        if (!empty($validasitoken) && $validasitoken['status'] === TRUE) {
            $id = $this->uri->segment(3);

            $whereuser = array('id' => $id);

            $datauser = $this->ModelUser->getuser($whereuser);

            $keterangan = array(
                'berhasil' => true,
                'pesan' => 'Berhasil Mendapatkan Info User',
                'pengguna' => $datauser
            );

            $this->set_response(
                $keterangan,
                200
            );
        } else {
            $keterangan = array(
                'berhasil' => false,
                'pesan' => 'Token Tidak Valid',
                'pengguna' => null
            );

            $this->set_response(
                $keterangan,
                401
            );
        }
    }

    public function resetpassworduser_post()
    {
        $email = $this->input->post('email');

        $datauser = array(
            'email' => $email
        );

        $kodeunik = random_string('alnum', 32);

        foreach ($this->ModelUser->getuser($datauser) as $data) {
            $dataresetpassword = array(
                'email' => $email,
                'kodeunik' => $kodeunik,
                'id_user' => $data->id
            );
        }

        if ($this->ModelResetpassword->tambahresetpassword($dataresetpassword)) {

            $emailtujuan = $email;

            $this->email->from('sistem@monitoring.com', 'Sistem');
            $this->email->to($emailtujuan);

            $this->email->subject('Reset Password');
            $this->email->message('Klik Link Berikut Untuk Mereset Password Akun <a href="' . base_url() . "api/aksiresetpassworduser/" . $kodeunik . '">RESET</a>');

            $this->email->set_mailtype('html');

            $this->email->send();

            $keterangan = array(
                'berhasil' => true,
                'pesan' => 'Berhasil Mengirim Permintaan Reset Password'
            );

            $this->set_response(
                $keterangan,
                200
            );
        } else {
            $keterangan = array(
                'berhasil' => false,
                'pesan' => 'Gagal Mengirim Permintaan Reset Password'
            );

            $this->set_response(
                $keterangan,
                401
            );
        }
    }

    public function aksiresetpassworduser_get()
    {
        $kodeunik = $this->uri->segment(3);

        $whereresetpassword = array(
            'kodeunik' => $kodeunik,
        );

        $dataresetpassword = $this->ModelResetpassword->cekresetpassword($whereresetpassword);

        foreach ($dataresetpassword as $data) {
            $whereuser = array(
                'id' => $data->id_user,
                'email' => $data->email
            );

            $datauser = array('password' => md5('12345678'));

            if ($this->ModelUser->gantipassworduser($whereuser, $datauser)) {
                $this->ModelResetpassword->hapusresetpassword($whereresetpassword);

                $this->load->view('resetpassword/berhasil');
            } else {
                $this->load->view('resetpassword/gagal');
            }
        }
    }

    public function aktivasiuser_get()
    {
        $kodeunik = $this->uri->segment(3);

        $whereaktivasi = array(
            'kodeunik' => $kodeunik,
        );

        $dataaktivasi = $this->ModelKonfirmasipendaftaran->cekkonfirmasi($whereaktivasi);

        foreach ($dataaktivasi as $data) {
            $whereuser = array(
                'id' => $data->id_user,
                'email' => $data->email
            );

            $datauser = array('statusaktivasi' => 'AKTIF');

            if ($this->ModelUser->aktivasiuser($whereuser, $datauser)) {
                $this->ModelKonfirmasipendaftaran->hapuskonfirmasi($whereaktivasi);

                $this->load->view('aktivasipengguna/berhasil');
            } else {
                $this->load->view('aktivasipengguna/gagal');
            }
        }
    }

    public function gantipassworduser_post()
    {
        $validasitoken = $this->authorizationtoken->validateToken();

        if (!empty($validasitoken) && $validasitoken['status'] === TRUE) {
            $id = $this->input->post("id");

            $datauser = array('id' => $id);

            foreach ($this->ModelUser->getpasswordlamauser($datauser) as $password) {
                $password_lama = md5($this->input->post("passwordlama"));
                $password_baru = md5($this->input->post("passwordbaru"));
                if ($password_lama == $password->password) {
                    $tgl_diupdate = date("Y-m-d");

                    $datapassword = array(
                        'password' => $password_baru,
                        'tgl_diupdate' => $tgl_diupdate
                    );

                    $gantipassword = $this->ModelUser->gantipassworduser($datauser, $datapassword);

                    if ($gantipassword) {
                        $keterangan = array(
                            'berhasil' => true,
                            'pesan' => 'Berhasil Mengganti Password'
                        );

                        $this->set_response(
                            $keterangan,
                            200
                        );
                    } else {
                        $keterangan = array(
                            'berhasil' => false,
                            'pesan' => 'Gagal Mengganti Password'
                        );

                        $this->set_response(
                            $keterangan,
                            401
                        );
                    }
                } else {
                    $keterangan = array(
                        'berhasil' => false,
                        'pesan' => 'Gagal Mengganti Password'
                    );

                    $this->set_response(
                        $keterangan,
                        401
                    );
                }
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
}

/* End of file ControllerPengguna.php */
