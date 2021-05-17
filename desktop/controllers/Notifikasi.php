<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends MY_Controller
{
	public function __construct()
	{
	    parent::__construct();
	}

	public function index()
	{	
        $notif = @json_decode(file_get_contents('./assets/json/notif_'.$this->user_login['id'].'.json'));

		$data['content'] = $this->load->view('content/notif_view', [
            'data'=>$notif
		], true);

		$data['meta'] = [
			'title'=> 'Notifikasi | Komunitas Guppy Cianjur (KAGUYUR)'
		];
		
		$this->load->view('template_view', $data);
	}
	public function open($id)
	{
		$notif = @json_decode(file_get_contents('./assets/json/notif_'.$this->user_login['id'].'.json'), true);
		$notif[$id]['status'] = 1;
		create_json('notif_'.$this->user_login['id'].'.json', json_encode($notif));
		$url = $this->input->get('url');
		if($url){
			redirect($url);
		}
	}
}
