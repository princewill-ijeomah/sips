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
}

?>
