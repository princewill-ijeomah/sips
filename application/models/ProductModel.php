<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ProductModel extends CI_Model {

    function fetch($where)
    {
      $this->db->select('*')->from('produk');

      if(!empty($where)){
        foreach($where as $key => $value){
            if($value != null){
                $this->db->where($key, $value);
            }
        }
      }

      $this->db->order_by('id_produk', 'desc');
      return $this->db->get();
    }

    function search($where){
      $this->db->select('*');
      $this->db->from('produk_subkriteria a');
      $this->db->where_in('a.id_subkriteria', $where);
      $this->db->group_by('a.id_produk');
      $this->db->having('COUNT(*)', count($where));
      $this->db->join('produk b', 'b.id_produk = a.id_produk');
     
      return $this->db->get();
    }

    function add($data, $detail)
    {
      $this->db->trans_start();
      $this->db->insert('produk', $data);

      if(!empty($detail)){
          $this->db->insert_batch('produk_subkriteria', $detail);
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
      $this->db->where($where)->update('produk', $data);

      if(!empty($detail)){
          $this->db->where($where)->delete('produk_subkriteria');
          $this->db->insert_batch('produk_subkriteria', $detail);
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
        return $this->db->where($where)->delete('produk');
    }

   
    
}

?>
