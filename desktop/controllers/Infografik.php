<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Infografik extends MY_Controller
{
	public function __construct()
	{
	    parent::__construct();
	}

	public function index()
	{	
		$infografik = @json_decode(file_get_contents('./assets/json/infografik.json'));
		$data['content'] = $this->load->view('content/infografik_view', [
			'infografik'=>$infografik,
		], true);

		$data['meta'] = [
			'title'=> 'Infografik | Komunitas Guppy Cianjur (KAGUYUR)'
		];
		
		$this->load->view('template_view', $data);
	}
}
