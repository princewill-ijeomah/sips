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

        $this->token       = $this->input->get_request_header('EXT-SIPS-KEY', TRUE);
        $this->auth        = AUTHORIZATION::validateToken($this->token);

        $this->load->model('KriteriaModel');
        $this->load->model('SubkriteriaModel');
    }

    public function index_get()
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 401);
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

}
