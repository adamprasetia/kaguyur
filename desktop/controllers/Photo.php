<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Photo extends MY_Controller
{
	public function __construct()
	{
	    parent::__construct();
	}

	public function index()
	{	
        $this->load->model('global_model');
        $photo = $this->global_model->get([
            'table'=>'photo',
            'where'=>[
                'status'=>1
            ],
            'order'=>[
                'created_date'=>'desc'
            ]
        ])->result();

        if(empty($photo)){
            show_404();
            exit;
        }
		$data['content'] = $this->load->view('content/photo_view', [
			'photo'=>$photo
		], true);

		$data['meta'] = [
			'title'=> 'Photo | Komunitas Guppy Cianjur (KAGUYUR)'
		];

		$data['script'] = $this->load->view('script/photo','',true);
		$this->load->view('template_view', $data);
	}
	public function add()
	{
        check_verified();

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
		}elseif ($_FILES['photo']['size'] > 204800) {
			$this->form_validation->set_message('required_photo','Pastikan ukuran file Foto tidak lebih dari 200KB');
			$status = false;
		}
		return $status;
    }
	public function optional_photo($foto){
		$status = true;
		if(!empty($_FILES['photo']['name'])){
			if ($_FILES['photo']['size'] > 204800) {
				$this->form_validation->set_message('required_photo','Pastikan ukuran file Foto tidak lebih dari 200KB');
				$status = false;
			}
		}
		return $status;
    }

	public function edit($id)
	{
        check_verified();

        $this->load->model('global_model');
        $photo = $this->global_model->get([
            'table'=>'photo',
            'where'=>[
                'id'=>$id
            ]
        ])->row();

        check_owner($photo->created_by);

		$data['content'] = $this->load->view('content/photo_edit_view', [
			'photo'=>$photo
		], true);
		
		$this->load->view('template_view', $data);

	}

	public function update($id)
	{
        check_verified();

		$this->load->model('global_model');

        $photo = $this->global_model->get([
            'table'=>'photo',
            'where'=>[
                'id'=>$id
            ]
        ])->row();

        check_owner($photo->created_by);

		$this->load->library(['form_validation', 'upload']);
		$this->form_validation->set_rules('caption', 'Caption', 'trim');
		$this->form_validation->set_rules('photo','Foto','callback_optional_photo');
		$this->form_validation->set_message('required', '{field} harus diisi.');

		if ($this->form_validation->run()===FALSE ){
			if(validation_errors())
			{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>strip_tags(validation_errors())]);
			}

		}else{						
			$data = [
				'title'=> htmlentities($this->input->post('caption', true)),
			];
			if(!empty($_FILES['photo']['name'])){
				$photo   = uploadFile('photo');	
				if(!empty($photo['data'])){
					$data['url'] = $photo['data'];
				}
			}
			$data['updated_by'] = $this->user_login['id'];
			$data['updated_date'] = date('Y-m-d H:i:s');

			$edit = $this->global_model->edit('photo', $id, $data);
			if($edit)
			{	
				echo json_encode(['tipe'=>'success', 'title'=>'Success!','message'=>'Edit foto berhasil']);
			}else{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Edit foto gagal']);
			}
		}		
	}
}
