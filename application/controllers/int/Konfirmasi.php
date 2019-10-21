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

        $this->token    = $this->input->get_request_header('INT-SIPS-KEY', TRUE);
        $this->auth     = AUTHORIZATION::validateToken($this->token);

        $this->load->model('KonfirmasiModel');
    }

    private $no_transaksi;

    public function index_get()
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            
            $where = array(
                'a.no_konfirmasi' => $this->get('no_konfirmasi')
            );

            $konfirmasi   = $this->KonfirmasiModel->fetch($where)->result();
            $data   = array();

            foreach($konfirmasi as $key){
                $json = array();

                $json['no_konfirmasi'] = $key->no_konfirmasi;
                $json['transaksi'] = array(
                    'no_transaksi' => $key->no_transaksi,
                    'alamat_kirim' => $key->alamat_kirim,
                    'status' => $key->status,
                    'tgl_transaksi' => $key->tgl_transaksi
                );
                $json['bank'] = $key->bank;
                $json['bank_pengirim'] = $key->bank_pengirim;
                $json['rekening_pengirim'] = $key->rekening_pengirim;
                $json['nama_pengirim'] = $key->nama_pengirim;
                $json['tgl_transfer'] = $key->tgl_transfer;
                $json['jml_transfer'] = $key->jml_transfer;
                $json['foto'] = base_url('doc/konfirmasi/').$key->foto;
                $json['tgl_input'] = $key->tgl_input;
                $json['valid'] = $key->valid;

                $data[] = $json;
            }

            $this->response(['status' => true, 'message' => 'Berhasil menampilkan konfirmasi', 'data' => $data], 200);
        }
    }

    public function validasi_put()
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            $otorisasi  = $this->auth;

            $config = array(
                array(
                    'field' => 'no_konfirmasi',
                    'label' => 'No konfirmasi',
                    'rules' => 'required|trim|callback_cek_konfirmasi'
                )
            );

            $this->form_validation->set_data($this->put());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            } else {
                $no_konfirmasi  = array(
                    'no_konfirmasi'   => $this->put('no_konfirmasi') 
                );

                $no_transaksi = array(
                    'no_transaksi' => $this->no_transaksi
                );

                $validasi = $this->KonfirmasiModel->validasi($no_konfirmasi, $no_transaksi);

                if(!$validasi){
                    $this->response(['status' => false, 'message' => 'Gagal validasi pembayaran'], 500);
                } else {
                    $this->response(['status' => true, 'message' => 'Berhasil validasi pembayaran'], 200);
                }
            }
        } 
    }

    public function batal_put()
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            $otorisasi  = $this->auth;

            $config = array(
                array(
                    'field' => 'no_konfirmasi',
                    'label' => 'No konfirmasi',
                    'rules' => 'required|trim|callback_cek_konfirmasi'
                )
            );

            $this->form_validation->set_data($this->put());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            } else {
                $no_konfirmasi  = array(
                    'no_konfirmasi'   => $this->put('no_konfirmasi') 
                );

                $no_transaksi = array(
                    'no_transaksi' => $this->no_transaksi
                );

                $batal = $this->KonfirmasiModel->batal($no_konfirmasi, $no_transaksi);

                if(!$batal){
                    $this->response(['status' => false, 'message' => 'Gagal batalkan pembayaran'], 500);
                } else {
                    $this->response(['status' => true, 'message' => 'Berhasil batalkan pembayaran'], 200);
                }
            }
        } 
    }

    function cek_konfirmasi($id){
         $where = array(
            'a.no_konfirmasi' => $id,
            'a.valid' => 'T'
        );

        $data = $this->KonfirmasiModel->fetch($where);
        $cek = $data->num_rows();

        if ($cek == 0){
            $this->form_validation->set_message('cek_konfirmasi', 'No Konfirmasi tidak ditemukan');
            return FALSE;
        } else {
            $this->no_transaksi = $data->row()->no_transaksi;
            return TRUE;
        }
    }

}
