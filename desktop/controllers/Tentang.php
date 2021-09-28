<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tentang extends MY_Controller
{
	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('general_model');
	}

	public function index()
	{	
		$data['content'] = $this->load->view('content/tentang_view', [

		], true);
		
		$data['meta'] = [
			'title'=> 'Tentang Fancy Guppy Cianjur | Kaguyur.com',
			'description'=>'',
			'canonical'=>'https://www.kaguyur.com/tentang'
		];
		
		$this->load->view('template_view', $data);
	}

	public function page_404()
	{
		show_404();
	}
}
