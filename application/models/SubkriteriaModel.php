<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SubkriteriaModel extends CI_Model {

    function fetch($where)
    {
      $this->db->select('*')->from('subkriteria a')->join('kriteria b', 'b.id_kriteria = a.id_kriteria', 'left');

      if(!empty($where)){
        foreach($where as $key => $value){
            if($value != null){
                $this->db->where($key, $value);
            }
        }
      }

      $this->db->order_by('id_subkriteria', 'desc');
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
