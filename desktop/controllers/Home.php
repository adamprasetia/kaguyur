<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('general_model');
	}

	public function index()
	{	
		$member = @json_decode(file_get_contents('./assets/json/member.json'));
		$data['content'] = $this->load->view('content/home_view', [
			'member'=>$member
		], true);
		
		$this->load->view('template_view', $data);
	}

	public function page_404()
	{
		show_404();
	}
}
