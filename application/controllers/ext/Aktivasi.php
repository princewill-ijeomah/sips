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

    

}
