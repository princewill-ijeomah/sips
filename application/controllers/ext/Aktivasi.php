<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktivasi extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('AuthModel');
        $this->load->library('session');
    }

    public function user($token)
    {
        if($token == null){
            $result = array(
                'status' => 'Gagal',
                'messages' => 'Gagal mengaktivasi akun'
            );
        } else {
            if($token != $this->session->userdata('token')){
                $result = array(
                    'status' => 'Gagal',
                    'messages' => 'Gagal mengaktivasi akun'
                );
            } else {
                $where = array(
                    'id_user' => $this->session->userdata('id_user')
                );

                $data = array(
                    'aktif' => 'Y'
                );

                $verify = $this->AuthModel->updateAuth($where, $data);

                if(!$verify){
                    $result = array(
                        'status' => 'Gagal',
                        'messages' => 'Gagal mengaktivasi akun'
                    );
                } else {
                    $session = array('id_user', 'nama_lengkap', 'username', 'email', 'token');

                    $this->session->unset_userdata($session);

                    $result = array(
                        'status' => 'Berhasail',
                        'messages' => 'Berhasil mengaktivasi akun'
                    );
                }
            }
        }

        $this->load->view('email/messages', $result);
    }

    function ganti_password($token){
        if($token == null){
            $result = array(
                'status' => 'Gagal',
                'messages' => 'Halaman tidak tersedia'
            );
        } else {
            if($token != $this->session->userdata('token')){
                $result = array(
                    'status' => 'Gagal',
                    'messages' => 'Halaman tidak tersedia'
                );
            } else {
                
                $session = array('id_user', 'token', 'nama_lengkap');

                $result = array(
                    'status' => 'Berhasail',
                    'messages' => 'Silahkan mengisi form yang tersedia',
                    'id_user' => $this->session->userdata('id_user')
                );
            }
        }

        $this->load->view('email/change_password', $result);
        $this->session->unset_userdata($session);
    }

    function update_password() {
        $where = array(
            'id_user' => $this->input->post('id_user')
        );

        $data = array(
            'password' => sha1($this->input->post('new_password'))
        );

        $update  = $this->AuthModel->updateAuth($where, $data);

        if($update){
            redirect('auth');
        }
    }

    

}
