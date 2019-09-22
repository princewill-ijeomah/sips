<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Owner extends CI_Controller {

	public function index()
	{
		$this->load->view('owner/main');
    }
    
    public function dashboard()
	{
		$this->load->view('owner/dashboard');
	}
	
    public function user()
	{
		$this->load->view('owner/user/data');
	}
	
    public function laporan()
	{
		$this->load->view('owner/laporan/penjualan');
    }
    
    
	
	
}
