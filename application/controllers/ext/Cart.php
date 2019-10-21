<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Cart extends CI_Controller {

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    } 

    function __construct()
    {
        parent::__construct();
        $this->__resTraitConstruct();

        $this->token    = $this->input->get_request_header('EXT-SIPS-KEY', TRUE);
        $this->auth     = AUTHORIZATION::validateToken($this->token);

        $this->load->model('CartModel');
    }

    public function index_get()
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            
            $where = array(
                'a.id_user' => $this->auth->id_user,
                'a.id' => $this->get('id'),
            );

            $cart   = $this->CartModel->fetch($where)->result();
            $data   = array();

            foreach($cart as $key){
                $json = array();

                $json['id'] = $key->id;
                $json['product'] = array(
                    'id_product' => $key->id_product,
                    'nama_product' => $key->nama_product,
                    'weight' => $key->weight,
                    'harga' => $key->harga,
                    'deskripsi' => $key->deskripsi,
                    'foto' => base_url('doc/foto/').$key->foto
                );
                $json['customer'] = array(
                    'id_user' => $key->id_user,
                    'nama_lengkap' => $key->nama_lengkap,
                    'telepon' => $key->telepon,
                    'alamat' => $key->alamat,
                    'email' => $key->email

                );
                $json['qty'] = $key->qty;
                $json['tgl_cart'] = $key->tgl_cart;

                $data[] = $json;
            }

            $this->response(['status' => true, 'message' => 'Berhasil menampilkan cart', 'data' => $data], 200);
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
                    'field' => 'id_product',
                    'label' => 'Product',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'qty',
                    'label' => 'Qty',
                    'rules' => 'required|trim'
                )
            );

            $this->form_validation->set_data($this->post());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            } else {
                $data = array(
                    'id_user' => $this->auth->id_user,
                    'id_product' => $this->post('id_product'),
                    'qty' => $this->post('qty')
                );

                $add = $this->CartModel->add($data);

                if(!$add){
                    $this->response(['status' => false, 'message' => 'Gagal menambahkan cart'], 500);
                } else {
                    $this->response(['status' => true, 'message' => 'Berhasil menambahkan cart'], 200);
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
                    'field' => 'id',
                    'label' => 'Cart',
                    'rules' => 'required|trim|callback_cek_cart'
                )
            );

            $this->form_validation->set_data($this->delete());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            } else {
                $where  = array(
                    'id'   => $this->delete('id') 
                );

                $delete = $this->CartModel->delete($where);

                if(!$delete){
                    $this->response(['status' => false, 'message' => 'Gagal menghapus product'], 500);
                } else {
                    $this->response(['status' => true, 'message' => 'Berhasil menghapus product'], 200);
                }
            }
        } 
    }

    function cek_cart($id){
         $where = array(
            'id' => $id
        );

        $cek   = $this->CartModel->fetch($where)->num_rows();

        if ($cek == 0){
            $this->form_validation->set_message('cek_keranjang', 'Chart tidak ditemukan');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
