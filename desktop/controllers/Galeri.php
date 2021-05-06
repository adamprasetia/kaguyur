<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri extends MY_Controller
{
	public function __construct()
	{
	    parent::__construct();
	}

	public function index()
	{	
		$gallery = @json_decode(file_get_contents('./assets/json/gallery.json'));
		$data['content'] = $this->load->view('content/gallery_view', [
			'gallery'=>$gallery
		], true);
		
		$this->load->view('template_view', $data);
	}
	public function detail($id)
	{
		$gallery = @json_decode(file_get_contents('./assets/json/gallery_'.$id.'.json'));
		$data['content'] = $this->load->view('content/gallery_detail_view', [
			'gallery'=>$gallery
		], true);
		
		$this->load->view('template_view', $data);
	}

}
