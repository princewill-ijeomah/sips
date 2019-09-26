<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ProductSubkriteriaModel extends CI_Model {

    function fetch($where)
    {
      $this->db->select('*')
               ->from('product_subkriteria a')
               ->join('subkriteria b', 'b.id_subkriteria = a.id_subkriteria', 'left')
               ->join('kriteria c', 'c.id_kriteria = b.id_kriteria', 'left');

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

    function add($where, $data)
    {
      $this->db->trans_start();
      $this->db->where($where)->delete('subkriteria');
      $this->db->insert_batch('subkriteria', $data);
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
