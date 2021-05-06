<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller
{
	public function __construct()
	{
	    parent::__construct();
		if(!$this->user_login['id']){
			redirect('login');
		}
	}

	public function index()
	{
		$this->load->model('global_model');		
		$profile = $this->global_model->get([
			'table'=>'member',
			'where'=>[
				'id'=>$this->user_login['id']
			]
		])->row();
		$data['content'] = $this->load->view('content/profile_view', [
			'profile'=>$profile,
		], true);
		
		$this->load->view('template_view', $data);
	}
	public function edit()
	{	
		$this->load->model('global_model');		
		$profile = $this->global_model->get([
			'table'=>'member',
			'where'=>[
				'id'=>$this->user_login['id']
			]
		])->row();
		$data['content'] = $this->load->view('content/profile_edit_view', [
			'profile'=>$profile,
		], true);
		
		$this->load->view('template_view', $data);
	}

	public function update()
	{
		$this->load->model('general_model');
		$this->load->library(['form_validation', 'upload']);
		$this->form_validation->set_rules('farm', 'Nama Farm', 'trim|required');
		$this->form_validation->set_rules('name', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('address', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('start', 'Start', 'trim');
		$this->form_validation->set_rules('phone', 'No Telepon/Wa', 'trim|required|callback_unique_tlp');
		$this->form_validation->set_rules('strain','Strain Guppy','trim|required');
		$this->form_validation->set_rules('photo','Pas Foto','callback_required_photo');
		$this->form_validation->set_rules('logo','Logo','callback_required_logo');
		$this->form_validation->set_rules('ig', 'Instagram', 'trim');
		$this->form_validation->set_rules('tw', 'Twitter', 'trim');
		$this->form_validation->set_rules('fb', 'Facebook', 'trim');
		$this->form_validation->set_message('required', '{field} harus diisi.');

		if ($this->form_validation->run()===FALSE ){
			if(validation_errors())
			{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>strip_tags(validation_errors())]);
			}

		}else{			
			
			$data = [
				'farm'=> $this->input->post('farm', true),
				'name'=> $this->input->post('name', true),
				'address'=> $this->input->post('address', true),
				'start'=> $this->input->post('start', true),
				'phone'=> $this->input->post('phone', true),
				'strain'=> $this->input->post('strain', true),
				'ig'=> $this->input->post('ig', true),
				'tw'=> $this->input->post('tw', true),
				'fb'=> $this->input->post('fb', true),
			];
			if(!empty($_FILES['photo']['name'])){
				$photo   = uploadFile('photo');	
				if(!empty($photo['data'])){
					$data['photo'] = $photo['data'];
				}
			}
			if(!empty($_FILES['logo']['name'])){
				$logo   = uploadFile('logo');	
				if(!empty($logo['data'])){
					$data['logo'] = $logo['data'];
				}
			}
			$data['date_updated'] = date('Y-m-d H:i:s');

			$id = $this->user_login['id'];
			$edit = $this->general_model->edit('member', $id, $data);
			if($edit)
			{	
				echo json_encode(['tipe'=>'success', 'title'=>'Success!','message'=>'Update profil berhasil']);
			}else{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Update profil Gagal']);
			}
		}		
	}

	public function unique_tlp($data){
		$this->form_validation->set_message('unique_tlp','No Telepon sudah dipakai');
		$unique = $this->general_model->get('member', 'phone', array('phone'=>$data,'phone != '=>$this->user_login['phone']));
		if($unique && $unique->num_rows() > 0){
			return false;
		}
		return true;
	}

	public function unique_email($data){
		$this->form_validation->set_message('unique_email','Email sudah dipakai');
		$unique = $this->general_model->get('member', 'email', array('email'=>$data));
		if($unique && $unique->num_rows() > 0){
			return false;
		}
		return true;
	}

	public function required_photo($foto){
		$status = true;
		if (!empty($_FILES['photo']) && $_FILES['photo']['size'] > 204800) {
			$this->form_validation->set_message('required_photo','Pas Foto max 200KB');
			$status = false;
		}
		return $status;
    }
	public function required_logo($foto){
		$status = true;
		if (!empty($_FILES['logo']) && $_FILES['logo']['size'] > 204800) {
			$this->form_validation->set_message('required_logo','Logo max 200KB');
			$status = false;
		}
		return $status;
    }
    

	public function page_404()
	{
		show_404();
	}
}
