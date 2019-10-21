<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function index()
	{
		$this->load->view('customer/main');
    }
    
    public function home()
	{
		$this->load->view('customer/home');
	}
	
	public function tentang()
	{
		$this->load->view('customer/tentang');
	}

	public function product()
	{
		$this->load->view('customer/product');
	}

	public function transaksi()
	{
		$this->load->view('customer/transaksi');
	}

	public function detail_transaksi($id)
	{
		$this->load->view('customer/detail_transaksi');
	}

	public function cart()
	{
		$this->load->view('customer/cart');
	}

	public function checkout($id)
	{
		$this->load->view('customer/checkout');
	}

	public function setting()
	{
		$this->load->view('customer/setting');
	}
    
    
	
	
}
