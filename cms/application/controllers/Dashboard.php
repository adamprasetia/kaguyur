<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	function __construct()
   	{
    	parent::__construct();
   	}

	public function index()
	{
		$this->load->model('global_model');
		$data['content'] = $this->load->view('contents/dashboard_view', [
			'total_product'=>$this->global_model->count(['table'=>'product']),
			'total_member_verified'=>$this->global_model->count(['table'=>'member','where'=>['status'=>'VERIFIED']]),
			'total_member_pending'=>$this->global_model->count(['table'=>'member','where'=>['status'=>'PENDING']]),
			'total_member_banned'=>$this->global_model->count(['table'=>'member','where'=>['status'=>'BANNED']]),
		], TRUE);

		$this->load->view('template_view', $data);
	}
}
