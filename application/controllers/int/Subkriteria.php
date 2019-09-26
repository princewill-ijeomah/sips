<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Subkriteria extends CI_Controller {

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    } 

    function __construct()
    {
        parent::__construct();
        $this->__resTraitConstruct();

        $this->token       = $this->input->get_request_header('INT-SIPS-KEY', TRUE);
        $this->auth        = AUTHORIZATION::validateToken($this->token);

        $this->load->model('KriteriaModel');
        $this->load->model('SubkriteriaModel');
    }

    public function index_get()
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            
            $where = array(
                'id_subkriteria' => $this->get('id_subkriteria') 
            );

            $subkriteria = $this->SubkriteriaModel->fetch($where)->result();
            $data = array();

            foreach($subkriteria as $key){
                $json_s = array();

                $json_s['id_subkriteria'] = $key->id_subkriteria;
                $json_s['nama_subkriteria'] = $key->nama_subkriteria;
                $json_s['kriteria'] = array(
                    'id_kriteria' => $key->id_kriteria,
                    'nama_kriteria' => $key->nama_kriteria
                );
                
                $data[] = $json_s;
            }

            $this->response(['status' => true, 'message' => 'Berhasil menampilkan subkriteria', 'data' => $data], 200);
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
                    'field' => 'id_kriteria',
                    'label' => 'ID Kriteria',
                    'rules' => 'required|trim|callback_cek_kriteria'
                ),
                array(
                    'field' => 'nama_subkriteria[]',
                    'label' => 'Nama Subkriteria',
                    'rules' => 'required|trim'
                )
            );

            $this->form_validation->set_data($this->post());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            } else {

                $post   = $this->post();

                $where  = array(
                    'id_kriteria' => $post['id_kriteria']
                );

                $data   = array();
                foreach($post['nama_subkriteria'] as $key => $val){
                    $data[] = array(
                        'id_kriteria' => $post['id_kriteria'],
                        'nama_subkriteria' => $post['nama_subkriteria'][$key]
                    );
                }

                $add = $this->SubkriteriaModel->add($where, $data);

                if(!$add){
                    $error = $this->db->error();
                    $this->response(['status' => false, 'error' => 'Gagal menghapus subkriteria', 'error_code' => $error['code']], 500);
                } else {
                    $this->response(['status' => true, 'message'   => 'Berhasil menambahkan subkriteria'], 200);
                }     
            }
        } 
    }

    public function cek_kriteria($id){
        $where = array(
            'id_kriteria' => $id
        );

        $cek   = $this->KriteriaModel->fetch($where)->num_rows();

        if ($cek == 0){
            $this->form_validation->set_message('cek_kriteria', 'ID Kriteria tidak ditemukan');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function cek_subkriteria($id){
        $where = array(
            'id_subkriteria' => $id
        );

        $cek   = $this->SubkriteriaModel->fetch($where)->num_rows();

        if ($cek == 0){
            $this->form_validation->set_message('cek_subkriteria', 'ID Subkriteria tidak ditemukan');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
