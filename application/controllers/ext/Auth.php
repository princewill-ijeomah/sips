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
        $this->load->model('UserModel');

        $this->load->library('session');
        
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

    public function register_post()
    {
        $config = array(
            array(
                'field' => 'nama_lengkap',
                'label' => 'Nama Lengkap',
                'rules' => 'required|trim'
            ),
            array(
                'field' => 'telepon',
                'label' => 'Telepon',
                'rules' => 'required|trim'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|trim|is_unique[user.email]|valid_email'
            ),
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|trim|is_unique[user.username]'
            ),
            array(
                'field' => 'password',
                'label' => 'Passwword',
                'rules' => 'required|trim'
            ),
        );

        $this->form_validation->set_data($this->post());
        $this->form_validation->set_rules($config);

        if(!$this->form_validation->run()){
            $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
        } else {
            
            $id_user = $this->KodeModel->buat_kode('user', 'USR-', 'id_user', 7);

            $mail_data = array(
                'id_user' => $id_user,
                'nama_lengkap' => $this->post('nama_lengkap'),
                'username' => $this->post('username'),
                'email' => $this->post('email'),
                'token' => substr(str_shuffle("01234567890abcdefghijklmnopqestuvwxyz"), 0, 15)
            );

            $data = array(
                'id_user' => $id_user,
                'nama_lengkap' => $this->post('nama_lengkap'),
                'jenis_kelamin' => $this->post('jenis_kelamin'),
                'tgl_lahir' => $this->post('tgl_lahir'),
                'alamat' => $this->post('alamat'),
                'telepon' => $this->post('telepon'),
                'email' => $this->post('email'),
                'username' => $this->post('username'),
                'password' => sha1($this->post('password')),
                'aktif' => 'T',
                'level' => 'Customer'
            );

            $this->load->library('email');

            $config = array(
                'protocol'  => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'sk.stmik2019@gmail.com',
                'smtp_pass' => 'stmik2019',
                'mailtype'  => 'html',
                'charset'   => 'utf-8'
            );
            $this->email->initialize($config);
            $this->email->set_mailtype("html");
            $this->email->set_newline("\r\n");

            $template = $this->load->view('email/konfirmasi', $mail_data, TRUE);

            $this->email->to($this->post('email'));
            $this->email->from('sk.stmik2019@gmail.com','Admin Duta Gym');
            $this->email->subject('Aktivasi Akun Duta Gym');
            $this->email->message($template);

            $send = $this->email->send();

            if (!$send) {
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Tidak dapat mengirim email'));
            } else {
                // $add = $this->UserModel->add($data);

                // if(!$add){
                    // $this->response(['status' => false, 'message' => 'Gagal registrasi user'], 500);
                // } else {
                //     $this->session->set_userdata($mail_data);
                    $this->response(['status' => true, 'message' => 'Berhasil registrasi user'], 200);
                // }
            }
        }
    }

    public function forgot_password_post()
    {
        $config = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|trim|valid_email'
            ),
        );
    
        $this->form_validation->set_data($this->post());
        $this->form_validation->set_rules($config);

        if(!$this->form_validation->run()){
            $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
        }else{

            $where  = array(
                'email' => $this->post('email')
            );
            
            $user   = $this->AuthModel->cekAuth($where);

            if($user->num_rows() == 0){
                $this->response(['status' => false, 'error' => 'Email tidak ditemukan'], 400);
            } else {

                $auth = $user->row();

                $mail_data = array(
                    'id_user' => $auth->id_user,
                    'nama_lengkap' => $auth->nama_lengkap,
                    'token' => substr(str_shuffle("01234567890abcdefghijklmnopqestuvwxyz"), 0, 15)
                );

                $this->load->library('email');

                $config = array(
                    'protocol'  => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'adm.titan001@gmail.com',
                    'smtp_pass' => 'cintaku1',
                    'mailtype'  => 'html',
                    'charset'   => 'utf-8'
                );
                $this->email->initialize($config);
                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");

                $template = $this->load->view('email/forgot_password', $mail_data, TRUE);

                $this->email->to($this->post('email'));
                $this->email->from('adm.titan001@gmail.com','Admin Duta Gym');
                $this->email->subject('Lupa Password Akun Duta Gym');
                $this->email->message($template);

                $send = $this->email->send();

                if (!$send) {
                    json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Tidak dapat mengirim email'));
                } else {
                    $this->session->set_userdata($mail_data);
                    $this->response(['status' => true, 'message' => 'Berhasil mengirim password'], 200);
                }
            }
        }  
    }

    

}
