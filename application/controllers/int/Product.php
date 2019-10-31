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

        $this->token       = $this->input->get_request_header('INT-SIPS-KEY', TRUE);
        $this->auth        = AUTHORIZATION::validateToken($this->token);

        $this->load->model('ProductModel');
        $this->load->model('KriteriaModel');
        $this->load->model('TransaksiDetailModel');
        $this->load->model('ProductSubkriteriaModel');
    }

    public function index_get()
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
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

    public function statistic_get()
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            $where = array(
                'id_produk'   => $this->get('id_product') 
            );

            $product = $this->TransaksiDetailModel->statistic($where)->result();
            $data = array();

            foreach($product as $key){
                $json_p = array();

                $json_p['id_product'] = $key->id_produk;
                $json_p['nama_product'] = $key->nama_produk;
                $json_p['weight'] = $key->berat;
                $json_p['harga'] = $key->harga;
                $json_p['deskripsi'] = $key->deskripsi;
                $json_p['total_qty'] = $key->total_qty;
                $json_p['total_terjual'] = $key->total_terjual;
                $json_p['foto'] = base_url('doc/foto/').$key->foto;

                $data[] = $json_p;
            }

            $this->response(['status' => true, 'message' => 'Berhasil menampilkan statistic product', 'data' => $data], 200);
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
                    'field' => 'nama_product',
                    'label' => 'Nama Product',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'weight',
                    'label' => 'Weight',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'harga',
                    'label' => 'Harga',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'deskripsi',
                    'label' => 'Deskripsi',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'stok',
                    'label' => 'Stok',
                    'rules' => 'required|trim'
                ),
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
                $id_product = $this->KodeModel->buat_kode('produk', 'P-', 'id_produk', 3);

                $data = array(
                    'id_produk' => $id_product,
                    'nama_produk' => $this->post('nama_product'),
                    'berat' => $this->post('weight'),
                    'harga' => $this->post('harga'),
                    'deskripsi' => $this->post('deskripsi'),
                    'stok' => $this->post('stok'),
                    'foto' => $this->upload_foto('foto', $id_product)
                );

                $detail  = array();
                foreach($post['id_subkriteria'] as $key => $val){
                    $detail[] = array(
                        'id_produk' => $id_product,
                        'id_subkriteria' => $post['id_subkriteria'][$key]
                    );
                }

                $add = $this->ProductModel->add($data, $detail);

                if(!$add){
                    $error = $this->db->error();
                    $this->response(['status' => false, 'error' => 'Gagal menambahkan product', 'error_code' => $error['code']], 500);
                } else {
                    $this->response(['status' => true, 'message'   => 'Berhasil menambahkan product'], 200);
                }     
            }
        } 
    }

    public function edit_post()
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            $otorisasi  = $this->auth;

            $config = array(
                array(
                    'field' => 'id_product',
                    'label' => 'Nama Product',
                    'rules' => 'required|trim|callback_cek_product'
                ),
                array(
                    'field' => 'nama_product',
                    'label' => 'Nama Product',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'weight',
                    'label' => 'Weight',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'harga',
                    'label' => 'Harga',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'deskripsi',
                    'label' => 'Deskripsi',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'stok',
                    'label' => 'Stok',
                    'rules' => 'required|trim'
                ),
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

                $where = array(
                    'id_produk' => $this->post('id_product')
                );

                $data = array(
                    'nama_produk' => $this->post('nama_product'),
                    'berat' => $this->post('weight'),
                    'harga' => $this->post('harga'),
                    'stok' => $this->post('stok'),
                    'deskripsi' => $this->post('deskripsi'),
                );

                $foto = $this->upload_foto('foto', $this->post('id_product'));

                if($foto != null){
                    $data['foto'] = $foto;
                }

                $detail  = array();
                foreach($post['id_subkriteria'] as $key => $val){
                    $detail[] = array(
                        'id_produk' => $this->post('id_product'),
                        'id_subkriteria' => $post['id_subkriteria'][$key]
                    );
                }

                $edit = $this->ProductModel->edit($where, $data, $detail);

                if(!$edit){
                    $error = $this->db->error();
                    $this->response(['status' => false, 'error' => 'Gagal mengedit product', 'error_code' => $error['code']], 500);
                } else {
                    $this->response(['status' => true, 'message'   => 'Berhasil mengedit product'], 200);
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
                    'field' => 'id_product',
                    'label' => 'ID Product',
                    'rules' => 'required|trim|callback_cek_product'
                )
            );

            $this->form_validation->set_data($this->delete());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            } else {
                $where  = array(
                    'id_produk'   => $this->delete('id_product') 
                );

                $delete = $this->ProductModel->delete($where);

                if(!$delete){
                    $error = $this->db->error();

                    if($error['code'] == 1451){
                        $this->response(['status' => false, 'error' => 'Data terhubung dengan data lain', 'error_code' => $error['code']], 500);
                    } else {
                        $this->response(['status' => false, 'error' => 'Gagal menghapus product', 'error_code' => $error['code']], 500);
                    }
                } else {
                    $this->response(['status' => true, 'message' => 'Berhasil menghapus product'], 200);
                }
            }
        } 
    }

    public function upload_foto($name, $id){
        // $files = glob('document/'.$name.'/'.$id.'.*');
        // foreach ($files as $key) {
        //     unlink($key);
        // }

        $config['upload_path']   = './doc/'.$name.'/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
        $config['overwrite']     = TRUE;
        $config['max_size']      = '3048';
        $config['remove_space']  = TRUE;
        $config['file_name']     = $id;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if(!$this->upload->do_upload($name)){
            return null;
        } else {
            $file = $this->upload->data();
            return $file['file_name'];
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
