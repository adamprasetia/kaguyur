<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('general_model');
	}

	public function index()
	{	
		$article = @json_decode(file_get_contents('./assets/json/article.json'));
		$forum = @json_decode(file_get_contents('./assets/json/forum.json'));
		$product = @json_decode(file_get_contents('./assets/json/product.json'));
		$member = @json_decode(file_get_contents('./assets/json/member.json'));
		$member = gen_random($member, 5);
		$data['content'] = $this->load->view('content/home_view', [
			'article'=>$article,
			'forum'=>$forum,
			'product'=>$product,
			'member'=>$member,
		], true);
		
		$data['script'] = $this->load->view('script/home','',true);
		$this->load->view('template_view', $data);
	}

	public function page_404()
	{
		show_404();
	}

	public function test()
	{
		dd($_SERVER);
	}
}
