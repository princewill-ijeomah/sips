<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Kriteria extends CI_Controller {

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
                'id_kriteria'   => $this->get('id_kriteria') 
            );

            $kriteria = $this->KriteriaModel->fetch($where)->result();
            $data = array();

            foreach($kriteria as $key){
                $json_k                       = array();

                $json_k['id_kriteria'] = $key->id_kriteria;
                $json_k['nama_kriteria'] = $key->nama_kriteria;
                $json_k['subkriteria'] = array();

                $where2  = array(
                    'a.id_kriteria' => $key->id_kriteria
                );

                $subkriteria  = $this->SubkriteriaModel->fetch($where2);

                foreach($subkriteria->result() as $key2){
                    $json_s = array();

                    $json_s['id_subkriteria'] = $key2->id_subkriteria;
                    $json_s['nama_subkriteria'] = $key2->nama_subkriteria;

                    $json_k['subkriteria'][] = $json_s;
                }

                $data[] = $json_k;
            }

            $this->response(['status' => true, 'message' => 'Berhasil menampilkan kriteria', 'data' => $data], 200);
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
                    'field' => 'nama_kriteria',
                    'label' => 'Kriteria',
                    'rules' => 'required|trim'
                )
            );

            $this->form_validation->set_data($this->post());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            } else {

                $data = array(
                    'nama_kriteria'    => $this->post('nama_kriteria')
                );

                $add = $this->KriteriaModel->add($data);

                if(!$add){
                    $error = $this->db->error();
                    $this->response(['status' => false, 'error' => 'Gagal menghapus kriteria', 'error_code' => $error['code']], 500);
                } else {
                    $this->response(['status' => true, 'message'   => 'Berhasil menambahkan kriteria'], 200);
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
                    'field' => 'id_kriteria',
                    'label' => 'ID Kriteria',
                    'rules' => 'required|trim|callback_cek_kriteria'
                )
            );

            $this->form_validation->set_data($this->delete());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            } else {
                $where  = array(
                    'id_kriteria'   => $this->delete('id_kriteria') 
                );

                $delete = $this->KriteriaModel->delete($where);

                if(!$delete){
                    $error = $this->db->error();

                    if($error['code'] == 1451){
                        $this->response(['status' => false, 'error' => 'Data terhubung dengan data lain', 'error_code' => $error['code']], 500);
                    } else {
                        $this->response(['status' => false, 'error' => 'Gagal menghapus kriteria', 'error_code' => $error['code']], 500);
                    }
                } else {
                    $this->response(['status' => true, 'message' => 'Berhasil menghapus kriteria'], 200);
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

}
