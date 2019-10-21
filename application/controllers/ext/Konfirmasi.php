<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Konfirmasi extends CI_Controller {

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    } 

    function __construct()
    {
        parent::__construct();
        $this->__resTraitConstruct();

        $this->token       = $this->input->get_request_header('EXT-SIPS-KEY', TRUE);
        $this->auth        = AUTHORIZATION::validateToken($this->token);

        $this->load->model('KonfirmasiModel');
        $this->load->model('TransaksiModel');
    }

    public function add_post()
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            $otorisasi  = $this->auth;

            $config = array(
                array(
                    'field' => 'no_transaksi',
                    'label' => 'No Transaksi',
                    'rules' => 'required|trim|callback_cek_transaksi'
                ),
                array(
                    'field' => 'bank',
                    'label' => 'Bank',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'bank_pengirim',
                    'label' => 'Bank pengirim',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'no_rekening',
                    'label' => 'No Rekening',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'nama_pengirim',
                    'label' => 'Nama Pengirim',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'tgl_transfer',
                    'label' => 'Tgl Transfer',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'jml_transfer',
                    'label' => 'Jml Transfer',
                    'rules' => 'required|trim'
                )
            );

            $this->form_validation->set_data($this->post());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            } else {
                $no_konfirmasi = $this->KodeModel->buat_kode('konfirmasi', 'KNF-', 'no_konfirmasi', 7);

                $data = array(
                    'no_konfirmasi' => $no_konfirmasi,
                    'no_transaksi' => $this->post('no_transaksi'),
                    'bank' => $this->post('bank'),
                    'bank_pengirim' => $this->post('bank_pengirim'),
                    'rekening_pengirim' => $this->post('no_rekening'),
                    'nama_pengirim' => $this->post('nama_pengirim'),
                    'tgl_transfer' => $this->post('tgl_transfer'),
                    'jml_transfer' => $this->post('jml_transfer'),
                    'foto' => $this->upload_foto('foto', $no_konfirmasi),
                    'valid' => 'T'
                );

                $add = $this->KonfirmasiModel->add($data);

                if(!$add){
                    $error = $this->db->error();
                    $this->response(['status' => false, 'error' => 'Gagal mengkonfirmasi pembayaran', 'error_code' => $error['code']], 500);
                } else {
                    $this->response(['status' => true, 'message'   => 'Berhasil mengkonfirmasi pembayaran'], 200);
                }     
            }
        } 
    }

    public function upload_foto($name, $id){
        $config['upload_path']   = './doc/konfirmasi/';
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

    public function cek_transaksi($id){
        $where = array(
            'a.no_transaksi' => $id
        );

        $cek   = $this->TransaksiModel->fetch($where)->num_rows();

        if ($cek == 0){
            $this->form_validation->set_message('cek_transaksi', 'No Transaksi tidak ditemukan');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
