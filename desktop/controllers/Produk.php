<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends MY_Controller
{
	public function __construct()
	{
	    parent::__construct();
	}

	public function index()
	{	
		$product = @json_decode(file_get_contents('./assets/json/product.json'));
        if(!$product){
            show_404();
            exit;
        }
		$data['content'] = $this->load->view('content/product_view', [
			'product'=>$product
		], true);
		
		$this->load->view('template_view', $data);
	}
	public function detail($id)
	{
		$product = @json_decode(file_get_contents('./assets/json/product_'.$id.'.json'));
        if(!$product){
            show_404();
            exit;
        }
		$data['content'] = $this->load->view('content/product_detail_view', [
			'product'=>$product
		], true);
		
		$this->load->view('template_view', $data);
	}

}
