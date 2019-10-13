<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TransaksiModel extends CI_Model {

    function fetch($where)
    {
      $this->db->select('*')
               ->from('transaksi a')
               ->join('user b', 'b.id_user = a.id_user');

      if(!empty($where)){
        foreach($where as $key => $value){
            if($value != null){
                $this->db->where($key, $value);
            }
        }
      }

      $this->db->order_by('a.tgl_transaksi', 'desc');
      return $this->db->get();
    }
}

?>
