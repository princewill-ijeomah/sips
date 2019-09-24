<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function index()
	{
		$this->load->view('customer/main');
    }
    
    public function dashboard()
	{
		$this->load->view('customer/home');
    }
    
    
	
	
}
