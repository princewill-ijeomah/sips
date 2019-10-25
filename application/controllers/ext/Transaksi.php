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

        $this->token    = $this->input->get_request_header('EXT-SIPS-KEY', TRUE);
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
                'a.no_transaksi' => $this->get('no_transaksi'),
                'a.id_user' => $this->auth->id_user
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
                $json['total'] = $key->total;
                $json['pembayaran'] = array();

                $where2 = array('a.no_transaksi' => $key->no_transaksi);
                $detail = $this->TransaksiDetailModel->fetch($where2)->result();

                foreach($detail as $key2){
                    $json_d = array();

                    $json_d['product'] = array(
                        'id_product' => $key2->id_produk,
                        'nama_product' => $key2->nama_produk,
                        'foto' => base_url('doc/foto/').$key2->foto,
                        'weight' => $key2->berat
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

    public function add_post()
    {
        if(!$this->auth){
            $this->response(['status' => false, 'error' => 'Invalid Token'], 400);
        } else {
            $otorisasi  = $this->auth;

            $config = array(
                array(
                    'field' => 'alamat_kirim',
                    'label' => 'Alamat Kirim',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'telepon',
                    'label' => 'Telepon',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'total',
                    'label' => 'Total',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'id_product[]',
                    'label' => 'Product',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'harga_satuan[]',
                    'label' => 'Harga Satuan',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'qty[]',
                    'label' => 'Qty',
                    'rules' => 'required|trim'
                ),
                array(
                    'field' => 'total_harga[]',
                    'label' => 'Total Harga',
                    'rules' => 'required|trim'
                ),
            );

            $this->form_validation->set_data($this->post());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            } else {
                $post = $this->post();
                $no_transaksi = $this->KodeModel->buat_kode('transaksi', 'TRX-', 'no_transaksi', 7);

                $data = array(
                    'no_transaksi' => $no_transaksi,
                    'id_user' => $this->auth->id_user,
                    'alamat_kirim' => $this->post('alamat_kirim'),
                    'total' => $this->post('total'),
                    'status' => 'Belum Dibayar'
                );

                $detail  = array();
                foreach($post['id_product'] as $key => $val){
                    $detail[] = array(
                        'no_transaksi' => $no_transaksi,
                        'id_produk' => $post['id_product'][$key],
                        'harga_satuan' => $post['harga_satuan'][$key],
                        'qty' => $post['qty'][$key],
                        'total_harga' => $post['total_harga'][$key]
                    );
                }

                $add = $this->TransaksiModel->add($data, $detail);

                if(!$add){
                    $error = $this->db->error();
                    $this->response(['status' => false, 'error' => 'Gagal melakukan transaksi', 'error_code' => $error['code']], 500);
                } else {
                    $this->response(['status' => true, 'message'   => 'Berhasil melakukan transaksi', 'id' => $no_transaksi], 200);
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
                    'field' => 'no_transaksi',
                    'label' => 'No Transaksi',
                    'rules' => 'required|trim|callback_cek_transaksi'
                )
            );

            $this->form_validation->set_data($this->put());
            $this->form_validation->set_rules($config);

            if(!$this->form_validation->run()){
                $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 400);
            } else {
                $where  = array(
                    'no_transaksi'   => $this->put('no_transaksi') 
                );

                $data = array(
                    'status' => 'Batal'
                );

                $validasi = $this->TransaksiModel->edit($where, $data);

                if(!$validasi){
                    $this->response(['status' => false, 'message' => 'Gagal membatalkan transaksi'], 500);
                } else {
                    $this->response(['status' => true, 'message' => 'Berhasil membatalkan transaksi'], 200);
                }
            }
        } 
    }

    function cek_transaksi($id){
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
