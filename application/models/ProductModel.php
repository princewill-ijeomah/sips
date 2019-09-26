<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ProductModel extends CI_Model {

    function fetch($where)
    {
      $this->db->select('*')->from('product');

      if(!empty($where)){
        foreach($where as $key => $value){
            if($value != null){
                $this->db->where($key, $value);
            }
        }
      }

      $this->db->order_by('id_product', 'desc');
      return $this->db->get();
    }

    function add($data)
    {
      return $this->db->insert('product', $data);
    }

    function edit($where, $data)
    {
      return $this->db->where($where)->update('product', $data);
    }

    function delete($where){
        return $this->db->where($where)->delete('product');
    }

   
    
}

?>
