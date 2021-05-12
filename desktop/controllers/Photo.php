<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Photo extends MY_Controller
{
	public function __construct()
	{
	    parent::__construct();
		check_verified();
	}

	public function index()
	{	
        $this->load->model('global_model');
		$query = [
            'table'=>'photo',
            'where'=>[
                'status'=>1
            ],
            'order'=>[
                'created_date'=>'desc'
			]
        ];
        $total = $this->global_model->count($query);
		$query['limit'] = 12;
		if($this->input->get('offset',true)){
			$query['offset'] = $this->input->get('offset',true);
		}
        $photo = $this->global_model->get($query)->result();

		$this->load->library('pagination');

		$config['base_url'] = base_url('photo');
		$config['total_rows'] = $total;
		$config['per_page'] = 12;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'offset';
		$config['display_pages'] = FALSE;
		$config['prev_link'] = '<span class="btn btn__black">&lt;</span>';
		$config['next_link'] = '<span class="btn btn__black">&gt;</span>';

		$this->pagination->initialize($config);

        if(empty($photo)){
            show_404();
            exit;
        }
		$data['content'] = $this->load->view('content/photo_view', [
			'photo'=>$photo,
			'paging'=>$this->pagination->create_links()
		], true);

		$data['meta'] = [
			'title'=> 'Photo | Komunitas Guppy Cianjur (KAGUYUR)'
		];

		$data['script'] = $this->load->view('script/photo','',true);
		$this->load->view('template_modal_view', $data);
	}
	public function add()
	{
		$this->load->model('general_model');
		$this->load->library(['form_validation', 'upload']);
		$this->form_validation->set_rules('photo','Foto','callback_required_photo');
		$this->form_validation->set_rules('caption', 'Caption', 'trim');
		$this->form_validation->set_message('required', '{field} harus diisi.');

		if ($this->form_validation->run()===FALSE ){
			if(validation_errors())
			{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>strip_tags(validation_errors())]);
			}

		}else{			
			$photo   = uploadFile('photo');
			if(empty($photo['data'])){
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Tambah foto gagal']);
				exit;
			}
			$data = [
				'title'=> htmlentities($this->input->post('caption', true)),
				'url'=> $photo['data'],
			];
			$data['created_by'] = $this->user_login['id'];
			$data['created_date'] = date('Y-m-d H:i:s');

			$add = $this->general_model->add('photo', $data);
			if($add)
			{	
				echo json_encode(['tipe'=>'success', 'title'=>'Success!','message'=>'Tambah foto berhasil']);
			}else{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Tambah foto gagal']);
			}
		}		

	}
	public function required_photo($foto){
		$status = true;
		if(empty($_FILES['photo']['name'])){
			$this->form_validation->set_message('required_photo','Pas Foto harus diisi'); 
			$status = false;
		}elseif ($_FILES['photo']['size'] > 2048000) {
			$this->form_validation->set_message('required_photo','Pastikan ukuran file Foto tidak lebih dari 2 MB');
			$status = false;
		}
		return $status;
    }
	public function optional_photo($foto){
		$status = true;
		if(!empty($_FILES['photo']['name'])){
			if ($_FILES['photo']['size'] > 2048000) {
				$this->form_validation->set_message('required_photo','Pastikan ukuran file Foto tidak lebih dari 2 MB');
				$status = false;
			}
		}
		return $status;
    }

}
