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
	
    public function customer()
	{
		$this->load->view('cashier/customer/data');
	}
	
    public function transaksi()
	{
		$this->load->view('cashier/transaksi/data');
	}
	
    public function konfirmasi()
	{
		$this->load->view('cashier/konfirmasi/data');
	}
	
}
