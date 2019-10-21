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

    function report($where, $between)
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

      $this->db->where('DATE(a.tgl_transaksi) BETWEEN "'.$between['tgl_awal'].'" AND "'.$between['tgl_akhir'].'"');

      $this->db->order_by('a.tgl_transaksi', 'desc');
      return $this->db->get();
    }

    function statistic($tahun)
    {
      $this->db->select("YEAR(tgl_transaksi) as tahun, MONTH(tgl_transaksi) as bulan, COUNT('no_transaksi') as jml_transaksi, SUM(total) as total_transaksi");

      $this->db->from("transaksi");
      $this->db->where("YEAR(tgl_transaksi)", $tahun);

      $this->db->group_by("MONTH(tgl_transaksi)");
      return $this->db->get();
    }

    function add($data, $detail)
    {
      $this->db->trans_start();
      $this->db->insert('transaksi', $data);

      if(!empty($detail)){
          $this->db->insert_batch('transaksi_detail', $detail);
          $this->db->where('id_user', $data['id_user'])->delete('keranjang');
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

    function edit($where, $data)
    {
      return $this->db->where($where)->update('transaksi', $data);
    }
}

?>
