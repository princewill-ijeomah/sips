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

    function add($data, $detail)
    {
      $this->db->trans_start();
      $this->db->insert('product', $data);

      if(!empty($detail)){
          $this->db->insert_batch('product_subkriteria', $detail);
      }
      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return false;
      } else {
        $this->db->trans_commit();
        return true;
      }
    }

    function edit($where, $data, $detail)
    {
      $this->db->trans_start();
      $this->db->where($where)->update('product', $data);

      if(!empty($detail)){
          $this->db->where($where)->delete('product_subkriteria');
          $this->db->insert_batch('product_subkriteria', $detail);
      }

      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return false;
      } else {
        $this->db->trans_commit();
        return true;
      }
    }

    function delete($where){
        return $this->db->where($where)->delete('product');
    }

   
    
}

?>
