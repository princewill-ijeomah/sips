<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    function fetch($where)
    {
      $this->db->select('*')->from('user');

      if(!empty($where)){
        foreach($where as $key => $value){
            if($value != null){
                $this->db->where($key, $value);
            }
        }
      }

      $this->db->order_by('tgl_registrasi', 'desc');
      return $this->db->get();
    }

    function add($data)
    {
      return $this->db->insert('user', $data);
    }

    function edit($where, $data)
    {
      return $this->db->where($where)->update('user', $data);
    }

    function delete($where)
    {
      return $this->db->where($where)->delete('user');
    }
    
}

?>
