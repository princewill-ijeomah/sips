<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Customer extends CI_Controller {

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
                'level' => 'Customer'
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

            $this->response(['status' => true, 'message' => 'Berhasil menampilkan customer', 'data' => $data], 200);
        }
    }

}
