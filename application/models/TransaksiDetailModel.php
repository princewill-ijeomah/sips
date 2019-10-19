<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TransaksiDetailModel extends CI_Model {

    function fetch($where)
    {
      $this->db->select('*')
               ->from('transaksi_detail a')
               ->join('product b', 'b.id_product = a.id_product');

      if(!empty($where)){
        foreach($where as $key => $value){
            if($value != null){
                $this->db->where($key, $value);
            }
        }
      }

      $this->db->order_by('a.id_product', 'desc');
      return $this->db->get();
    }

    function statistic($where)
    {
      $this->db->select('*')
               ->select('SUM(a.qty) as total_qty, SUM(a.total_harga) as total_terjual')
               ->from('transaksi_detail a')
               ->join('product b', 'b.id_product = a.id_product');

      if(!empty($where)){
        foreach($where as $key => $value){
            if($value != null){
                $this->db->where($key, $value);
            }
        }
      }

      $this->db->order_by('total_qty', 'desc');
      $this->db->limit(5);
      $this->db->group_by('a.id_product');
      return $this->db->get();
    }
}

?>
