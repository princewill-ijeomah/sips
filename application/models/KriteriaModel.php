<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class KriteriaModel extends CI_Model {

    function fetch($where)
    {
      $this->db->select('*')->from('kriteria');

      if(!empty($where)){
        foreach($where as $key => $value){
            if($value != null){
                $this->db->where($key, $value);
            }
        }
      }

      $this->db->order_by('id_kriteria', 'desc');
      return $this->db->get();
    }

    function add($data)
    {
      return $this->db->insert('kriteria', $data);
    }

    function edit($where, $data)
    {
      return $this->db->where($where)->update('kriteria', $data);
    }

    function delete($where){
        return $this->db->where($where)->delete('kriteria');
    }

   
    
}

?>
