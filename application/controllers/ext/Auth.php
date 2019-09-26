<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Auth extends CI_Controller {

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    } 

    function __construct()
    {
        parent::__construct();
        $this->__resTraitConstruct();

        $this->load->model('AuthModel');
    }

    public function login_post()
    {
        $config = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required'
            )
        );
    
        $this->form_validation->set_data($this->post());
        $this->form_validation->set_rules($config);

        if(!$this->form_validation->run()){
            $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
        }else{

            $where  = array(
                'username' => $this->post('username'),
                'level' => 'Customer'
            );
            
            $user   = $this->AuthModel->cekAuth($where);

            if($user->num_rows() == 0){
                $this->response(['status' => false, 'error' => 'Username tidak ditemukan'], 400);
            } else {
                $auth = $user->row();

                $payload = array(
                    'id_user' => $auth->id_user,
                    'level' => strtolower($auth->level),
                    'username' => $auth->username,
                    'tgl_registrasi' => $auth->tgl_registrasi
                );

                $session = array(
                    'key'   => AUTHORIZATION::generateToken($payload),
                    'level' => strtolower($auth->level)
                );
                
                if(hash_equals(sha1($this->post('password')), $auth->password)){
                    if($auth->aktif != 'Y'){
                        $this->response(['status' => false, 'error' => 'User sudah tidak aktif'], 400);
                    } else {
                        $this->response(['status' => true, 'message' => 'Berhasil login. Selamat Datang di SIPS', 'data' => $session], 200);
                    }
                } else {
                    $this->response(['status' => false, 'error' => 'Password salah'], 400);
                }
            }
        }  
    }

    

}
