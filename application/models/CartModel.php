<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CartModel extends CI_Model {

    function fetch($where)
    {
      $this->db->select('*')->from('keranjang a')->join('produk b', 'b.id_produk = a.id_produk')->join('user c', 'c.id_user = a.id_user');

      if(!empty($where)){
        foreach($where as $key => $value){
            if($value != null){
                $this->db->where($key, $value);
            }
        }
      }

      $this->db->order_by('a.tgl_cart', 'desc');
      return $this->db->get();
    }

    function add($data)
    {
      return $this->db->insert('keranjang', $data);
    }

    function delete($where)
    {
      return $this->db->where($where)->delete('keranjang');
    }
    
}

?>
