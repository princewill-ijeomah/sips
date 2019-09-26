<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class User extends CI_Controller {

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    } 

    function __construct()
    {
        parent::__construct();
        $this->__resTraitConstruct();

        $this->token    = $this->input->get_request_header('INT-SIPS-KEY', TRUE);
        $this->auth     = AUTHORIZATION::validateToken($this->token);

        $this->load->model('UserModel');
    }

    public function index_get()
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            
            $where = array(
                'id_user' => $this->get('id_user'),
                'level' => 'Cashier'
            );

            $user   = $this->UserModel->fetch($where)->result();
            $data   = array();

            foreach($user as $key){
                $json = array();

                $json['id_user'] = $key->id_user;
                $json['nama_lengkap'] = $key->nama_lengkap;
                $json['jenis_kelamin'] = $key->jenis_kelamin;
                $json['tgl_lahir'] = $key->tgl_lahir;
                $json['alamat'] = $key->alamat;
                $json['telepon'] = $key->telepon;
                $json['email'] = $key->email;
                $json['username'] = $key->username;
                $json['password'] = $key->password;
                $json['aktif'] = $key->aktif;
                $json['level'] = $key->level;
                $json['tgl_registrasi'] = $key->tgl_registrasi;

                $data[] = $json;
            }

            $this->response(['status' => true, 'message' => 'Berhasil menampilkan user', 'data' => $data], 200);
        }
    }

    public function add_post()
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            $otorisasi  = $this->auth;

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
            );

            $this->form_validation->set_data($this->post());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            } else {
                $data = array(
                    'id_user' => $this->KodeModel->buat_kode('user', 'USR-', 'id_user', 7),
                    'nama_lengkap' => $this->post('nama_lengkap'),
                    'jenis_kelamin' => $this->post('jenis_kelamin'),
                    'tgl_lahir' => $this->post('tgl_lahir'),
                    'alamat' => $this->post('alamat'),
                    'telepon' => $this->post('telepon'),
                    'email' => $this->post('email'),
                    'username' => $this->post('username'),
                    'password' => sha1($this->post('username')),
                    'aktif' => 'Y',
                    'level' => 'Cashier'
                );

                $add = $this->UserModel->add($data);

                if(!$add){
                    $this->response(['status' => false, 'message' => 'Gagal menambahkan user'], 500);
                } else {
                    $this->response(['status' => true, 'message' => 'Berhasil menambahkan user'], 200);
                }
            }
        } 
    }

    public function edit_put()
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            $otorisasi  = $this->auth;

            $config = array(
                array(
                    'field' => 'id_user',
                    'label' => 'ID User',
                    'rules' => 'required|trim|callback_cek_user'
                ),
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
                    'rules' => 'required|trim|valid_email'
                ),
                array(
                    'field' => 'aktif',
                    'label' => 'Status',
                    'rules' => 'required|trim'
                ),
            );

            $this->form_validation->set_data($this->put());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            } else {
                $where  = array(
                    'id_user'   => $this->put('id_user') 
                );

                $data = array(
                    'nama_lengkap' => $this->put('nama_lengkap'),
                    'jenis_kelamin' => $this->put('jenis_kelamin'),
                    'tgl_lahir' => $this->put('tgl_lahir'),
                    'alamat' => $this->put('alamat'),
                    'telepon' => $this->put('telepon'),
                    'email' => $this->put('email'),
                    'aktif' => $this->put('aktif')
                );

                $edit = $this->UserModel->edit($where, $data);

                if(!$edit){
                    $this->response(['status' => false, 'message' => 'Gagal mengedit user'], 500);
                } else {
                    $this->response(['status' => true, 'message' => 'Berhasil mengedit user'], 200);
                }
            }
        } 
    }

    public function delete_delete()
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            $otorisasi  = $this->auth;

            $config = array(
                array(
                    'field' => 'id_user',
                    'label' => 'ID User',
                    'rules' => 'required|trim|callback_cek_user'
                )
            );

            $this->form_validation->set_data($this->delete());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            } else {
                $where  = array(
                    'id_user'   => $this->delete('id_user') 
                );

                $delete = $this->UserModel->delete($where);

                if(!$delete){
                    $this->response(['status' => false, 'message' => 'Gagal menghapus user'], 500);
                } else {
                    $this->response(['status' => true, 'message' => 'Berhasil menghapus user'], 200);
                }
            }
        } 
    }

    function cek_user($id){
         $where = array(
            'id_user' => $id
        );

        $cek   = $this->UserModel->fetch($where)->num_rows();

        if ($cek == 0){
            $this->form_validation->set_message('cek_user', 'ID User tidak ditemukan');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
