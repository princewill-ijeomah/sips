<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cashier extends CI_Controller {

	public function index()
	{
		$this->load->view('cashier/main');
    }
    
    public function dashboard()
	{
		$this->load->view('cashier/dashboard');
	}
	
    public function kriteria()
	{
		$this->load->view('cashier/kriteria/data');
	}
	
    public function product()
	{
		$this->load->view('cashier/product/data');
	}

	public function add_product()
	{
		$this->load->view('cashier/product/add');
	}

	public function edit_product($id)
	{
		$this->load->view('cashier/product/edit', array('id_product' => $id));
	}
	
    public function customer()
	{
		$this->load->view('cashier/customer/data');
	}
	
    public function transaksi()
	{
		$this->load->view('cashier/transaksi/data');
	}

	public function detail_transaksi($id)
	{
		$this->load->view('cashier/transaksi/detail');
	}

    public function konfirmasi()
	{
		$this->load->view('cashier/konfirmasi/data');
	}
	
}
