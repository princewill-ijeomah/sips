<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class KonfirmasiModel extends CI_Model {

    function fetch($where)
    {
      $this->db->select('*')
               ->from('konfirmasi a')
               ->join('transaksi b', 'b.no_transaksi = a.no_transaksi')
               ->join('user c', 'c.id_user = b.id_user');

      if(!empty($where)){
        foreach($where as $key => $value){
            if($value != null){
                $this->db->where($key, $value);
            }
        }
      }

      $this->db->order_by('a.tgl_input', 'desc');
      return $this->db->get();
    }

    function edit($where, $data)
    {
      return $this->db->where($where)->update('konfirmasi', $data);
    }

    function validasi($no_konfirmasi, $no_transaksi)
    {
      $this->db->trans_start();
      $this->db->where($no_konfirmasi)->update('konfirmasi', array('valid' => 'Y'));
      $this->db->where($no_transaksi)->update('transaksi', array('status' => 'Dibayar'));
      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return false;
      } else {
        $this->db->trans_commit();
        return true;
      }
    }
}

?>
