<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Transaksi extends CI_Controller {

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    } 

    function __construct()
    {
        parent::__construct();
        $this->__resTraitConstruct();

        $this->token    = $this->input->get_request_header('INT-SIPS-KEY', TRUE);
        $this->auth     = AUTHORIZATION::validateToken($this->token);

        $this->load->model('TransaksiModel');
        $this->load->model('TransaksiDetailModel');
        $this->load->model('KonfirmasiModel');
    }

    public function index_get()
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            
            $where = array(
                'a.no_transaksi' => $this->get('no_transaksi')
            );

            $transaksi   = $this->TransaksiModel->fetch($where)->result();
            $data   = array();

            foreach($transaksi as $key){
                $json = array();

                $json['no_transaksi'] = $key->no_transaksi;
                $json['alamat_kirim'] = $key->alamat_kirim;
                $json['customer'] = array(
                    'id_user' => $key->id_user,
                    'nama_lengkap' => $key->nama_lengkap,
                    'telepon' => $key->telepon,
                    'email' => $key->email

                );
                $json['status'] = $key->status;
                $json['tgl_transaksi'] = $key->tgl_transaksi;
                $json['detail'] = array();
                $json['pembayaran'] = array();

                $where2 = array('a.no_transaksi' => $key->no_transaksi);
                $detail = $this->TransaksiDetailModel->fetch($where2)->result();

                foreach($detail as $key2){
                    $json_d = array();

                    $json_d['product'] = array(
                        'id_product' => $key2->id_product,
                        'nama_product' => $key2->nama_product,
                        'weight' => $key2->weight
                    );
                    $json_d['harga_satuan'] = $key2->harga_satuan;
                    $json_d['qty'] = $key2->qty;
                    $json_d['total_harga'] = $key2->total_harga;

                    $json['detail'][] = $json_d;
                }

                $where3 = array('a.no_transaksi' => $key->no_transaksi, 'a.valid' => 'Y');
                $pembayaran = $this->KonfirmasiModel->fetch($where2)->result();

                foreach($pembayaran as $key3){
                    $json_p = array();

                    $json_p['no_konfirmasi'] = $key3->no_konfirmasi;
                    $json_p['bank'] = $key3->bank;
                    $json_p['bank_pengirim'] = $key3->bank_pengirim;
                    $json_p['rekening_pengirim'] = $key3->rekening_pengirim;
                    $json_p['nama_pengirim'] = $key3->nama_pengirim;
                    $json_p['tgl_transfer'] = $key3->tgl_transfer;
                    $json_p['jml_transfer'] = $key3->jml_transfer;
                    $json_p['tgl_input'] = $key3->tgl_input;
                    $json_p['valid'] = $key3->valid;

                    $json['pembayaran'][] = $json_p;
                }

                $data[] = $json;
            }

            $this->response(['status' => true, 'message' => 'Berhasil menampilkan transaksi', 'data' => $data], 200);
        }
    }

}
