<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vaksin extends CI_Controller
{
	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('general_model');
		$this->id_category = 1;
	}

	public function index()
	{	
		$title = 'Vaksin - Kita Bangkit';
		$url   = base_url();
		$category = $this->general_model->get('category', '', ['id'=>$this->id_category])->row();
		$vaksin['share'] = get_share($title, $url);
		$vaksin['event'] = get_event($this->id_category);
		$vaksin['video'] = widget_video($this->id_category);
		$vaksin['artikel'] = widget_artikel($this->id_category);
		$vaksin['infografik'] = widget_infografik($this->id_category);
		$data['content'] = $this->load->view('content/vaksin_view', $vaksin, true);
		$data['script'] = $this->load->view('content/vaksin_script_view', $vaksin, true);

		$data['meta'] = array(
			'title'=> $title,
			'url' => $url,
			'description' => $category->description,
			'image' => base_url().$category->image
		);
		
		$this->load->view('template_view', $data);
	}

	public function periksa()
	{
		$data = [
			'pekerjaan' 		=> $this->input->post('pekerjaan'),
			'tempat_tinggal '	=> $this->input->post('tempat_tinggal'),
		];

		$data['created_at'] = date('Y-m-d H:i:s');

		$add = $this->general_model->add('peduli_lindungi', $data);

		$title = 'Kita siap vaksin';
		$image = config_item('assets').'images/popup_siapvaksin.png';

		if(in_array($data['pekerjaan'], ['kesehatan','tnipolri','hukum','pelayan'])){
			$desc = 'Anda masuk kategori 1 <br> penerima vaksin.';
		}elseif(in_array($data['pekerjaan'], ['tokoh','agama','ekonomi','kecamatan','desa','rtrw'])){
			$desc = 'Anda masuk kategori 2 <br> penerima vaksin.';
		}elseif(in_array($data['pekerjaan'], ['Guru'])){
			$desc = 'Anda masuk kategori 3 <br> penerima vaksin.';
		}elseif(in_array($data['pekerjaan'], ['kementerian','organisasi','legislatif','mgeospasial','mekonomi'])){
			$desc = 'Anda masuk kategori 4 <br> penerima vaksin.';
		}elseif(in_array($data['pekerjaan'], ['lainnya'])){
			$desc = 'Anda masuk kategori 5 <br> penerima vaksin.';
		}else{
			$desc = 'Anda belum termasuk kategori <br> utama penerima vaksin.';
		}

		if($add){	
			echo json_encode([
				'tipe'	=> "success", 
				'title'	=> $title,
				'desc'	=> $desc,
				'image'	=> $image,
			]);
		}else{
			echo json_encode([
				'tipe'		=> "error", 
				'title'		=> 'Something is Wrong!', 
				'message'	=> 'Failed to Check'
			]);
		}	
	}

	public function page_404()
	{
		show_404();
	}
}
