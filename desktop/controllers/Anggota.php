<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends MY_Controller
{
	public function __construct()
	{
	    parent::__construct();
	}

	public function index()
	{	
		$member = @json_decode(file_get_contents('./assets/json/member.json'));
		$data['content'] = $this->load->view('content/anggota_view', [
			'member'=>$member
		], true);
		
		$data['meta'] = [
			'title'=> 'Anggota | Komunitas Guppy Cianjur (KAGUYUR)'
		];

		$this->load->view('template_view', $data);
	}

	public function register()
	{
		$this->load->model('general_model');
		$this->load->library(['form_validation', 'upload']);
		$this->form_validation->set_rules('farm', 'Nama Farm', 'trim|required');
		$this->form_validation->set_rules('name', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('address', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('start', 'Start', 'trim');
		$this->form_validation->set_rules('phone', 'No Telepon/Wa', 'trim|required|callback_unique_tlp');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|callback_unique_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('strain','Strain Guppy','trim|required');
		$this->form_validation->set_rules('photo','Pas Foto','callback_required_photo');
		$this->form_validation->set_rules('logo','Logo','callback_required_logo');
		$this->form_validation->set_rules('ig', 'Instagram', 'trim');
		$this->form_validation->set_rules('tw', 'Twitter', 'trim');
		$this->form_validation->set_rules('fb', 'Facebook', 'trim');
		$this->form_validation->set_message('required', '{field} harus diisi.');
		$this->form_validation->set_message('valid_email', 'Format {field} salah.');

		if ($this->form_validation->run()===FALSE ){
			if(validation_errors())
			{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>strip_tags(validation_errors())]);
			}

		}else{			
			$photo   = uploadFile('photo');
			if(empty($photo['data'])){
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Upload pas foto gagal, silakan coba file foto yang lain']);
				exit;
			}
			$logo   = uploadFile('logo');
			if(empty($logo['data'])){
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Upload logo gagal, silakan coba file logo yang lain']);
				exit;
			}
			
			$data = [
				'farm'=> htmlentities($this->input->post('farm', true)),
				'name'=> htmlentities($this->input->post('name', true)),
				'address'=> htmlentities($this->input->post('address', true)),
				'start'=> htmlentities($this->input->post('start', true)),
				'phone'=> htmlentities($this->input->post('phone', true)),
				'email'=> htmlentities($this->input->post('email', true)),
				'password'=> md5($this->input->post('password', true)),
				'strain'=> htmlentities($this->input->post('strain', true)),
				'photo'=> $photo['data'],
				'logo'=> $logo['data'],
				'ig'=> htmlentities($this->input->post('ig', true)),
				'tw'=> htmlentities($this->input->post('tw', true)),
				'fb'=> htmlentities($this->input->post('fb', true)),
			];
			$data['date_created'] = date('Y-m-d H:i:s');
			$data['status'] = 'PENDING';

			$add = $this->general_model->add('member', $data);
			if($add)
			{	
				generate_json_anggota();
				generate_json_anggota($add);
				echo json_encode(['tipe'=>'success', 'title'=>'Success!','message'=>'Registrasi berhasil']);
			}else{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Registrasi Gagal']);
			}
		}		
	}

	public function unique_tlp($data){
		$this->form_validation->set_message('unique_tlp','No Telepon sudah dipakai');
		$unique = $this->general_model->get('member', 'phone', array('phone'=>$data));
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
		if(empty($_FILES['photo']['name'])){
			$this->form_validation->set_message('required_photo','Pas Foto harus diisi'); 
			$status = false;
		}elseif ($_FILES['photo']['size'] > 2048000) {
			$this->form_validation->set_message('required_photo','Pas Foto max 2 MB');
			$status = false;
		}
		return $status;
    }
	public function required_logo($foto){
		$status = true;
		if(empty($_FILES['logo']['name'])){
			$this->form_validation->set_message('required_logo','Logo harus diisi'); 
			$status = false;
		}elseif ($_FILES['logo']['size'] > 2048000) {
			$this->form_validation->set_message('required_logo','Logo max 2 MB');
			$status = false;
		}
		return $status;
    }
    
	public function detail($id)
	{
		$member = @json_decode(file_get_contents('./assets/json/member_'.$id.'.json'));
		$product = @json_decode(file_get_contents('./assets/json/product_member_'.$id.'.json'));
		$data['content'] = $this->load->view('content/anggota_detail_view', [
			'member'=>$member,
			'product'=>$product,
		], true);

		$data['meta'] = [
			'title'=> $member->farm.' | Komunitas Guppy Cianjur (KAGUYUR)'
		];

		
		$this->load->view('template_view', $data);
	}


}
