<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Product extends CI_Controller {

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    } 

    function __construct()
    {
        parent::__construct();
        $this->__resTraitConstruct();

        $this->token       = $this->input->get_request_header('EXT-SIPS-KEY', TRUE);
        $this->auth        = AUTHORIZATION::validateToken($this->token);

        $this->load->model('ProductModel');
        $this->load->model('KriteriaModel');
        $this->load->model('TransaksiDetailModel');
        $this->load->model('ProductSubkriteriaModel');
    }

    public function index_get()
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 401);
        } else {
            
            $where = array(
                'id_produk'   => $this->get('id_product') 
            );

            $product = $this->ProductModel->fetch($where)->result();
            $data = array();

            foreach($product as $key){
                $json_p = array();

                $json_p['id_product'] = $key->id_produk;
                $json_p['nama_product'] = $key->nama_produk;
                $json_p['weight'] = $key->berat;
                $json_p['harga'] = $key->harga;
                $json_p['stok'] = $key->stok;
                $json_p['deskripsi'] = $key->deskripsi;
                $json_p['foto'] = base_url('doc/foto/').$key->foto;
                $json_p['kriteria'] = array();

                $kriteria = $this->KriteriaModel->fetch(array())->result();

                foreach($kriteria as $key2){
                    $json_k = array();

                    $json_k['id_kriteria'] = $key2->id_kriteria;
                    $json_k['nama_kriteria'] = $key2->nama_kriteria;
                    $json_k['subkriteria'] = null;

                    $where2 = array(
                        'a.id_produk' => $key->id_produk,
                        'c.id_kriteria' => $key2->id_kriteria
                    );
                    $subkriteria = $this->ProductSubkriteriaModel->fetch($where2)->result();
                    
                    foreach($subkriteria as $key3){
                        $json_s = array();

                        $json_s['id_subkriteria'] = $key3->id_subkriteria;
                        $json_s['nama_subkriteria'] = $key3->nama_subkriteria;

                        $json_k['subkriteria'] = $json_s;
                    }

                    $json_p['kriteria'][] = $json_k;
                }

                $data[] = $json_p;
            }

            $this->response(['status' => true, 'message' => 'Berhasil menampilkan product', 'data' => $data], 200);
        }
    }

    public function search_post()
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            $otorisasi  = $this->auth;

            $config = array(
                array(
                    'field' => 'id_subkriteria[]',
                    'label' => 'Subkriteria',
                    'rules' => 'required|trim'
                )
            );

            $this->form_validation->set_data($this->post());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            } else {
                $post = $this->post();

                $where  = array();
                foreach($post['id_subkriteria'] as $key => $val){
                    $where[] = $post['id_subkriteria'][$key];
                }

                $product = $this->ProductModel->search($where)->result();
                $data = array();

                foreach($product as $key){
                    $json_p = array();

                    $json_p['id_product'] = $key->id_produk;
                    $json_p['nama_product'] = $key->nama_produk;
                    $json_p['weight'] = $key->berat;
                    $json_p['harga'] = $key->harga;
                    $json_p['stok'] = $key->stok;
                    $json_p['deskripsi'] = $key->deskripsi;
                    $json_p['foto'] = base_url('doc/foto/').$key->foto;
                    $json_p['kriteria'] = array();

                    $kriteria = $this->KriteriaModel->fetch(array())->result();

                    foreach($kriteria as $key2){
                        $json_k = array();

                        $json_k['id_kriteria'] = $key2->id_kriteria;
                        $json_k['nama_kriteria'] = $key2->nama_kriteria;
                        $json_k['subkriteria'] = null;

                        $where2 = array(
                            'a.id_produk' => $key->id_produk,
                            'c.id_kriteria' => $key2->id_kriteria
                        );
                        $subkriteria = $this->ProductSubkriteriaModel->fetch($where2)->result();
                        
                        foreach($subkriteria as $key3){
                            $json_s = array();

                            $json_s['id_subkriteria'] = $key3->id_subkriteria;
                            $json_s['nama_subkriteria'] = $key3->nama_subkriteria;

                            $json_k['subkriteria'] = $json_s;
                        }

                        $json_p['kriteria'][] = $json_k;
                    }

                    $data[] = $json_p;
                }    

                $this->response(['status' => true, 'message' => 'Berhasil menampilkan product', 'data' => $data], 200);
            }
        } 
    }

    public function cek_product($id){
        $where = array(
            'id_produk' => $id
        );

        $cek   = $this->ProductModel->fetch($where)->num_rows();

        if ($cek == 0){
            $this->form_validation->set_message('cek_product', 'ID Product tidak ditemukan');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
