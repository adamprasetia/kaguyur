<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
	    parent::__construct();
	}

	public function index()
	{	
        $this->load->library('session');
		$this->user_login = $this->session->userdata('user_login');
		if($this->user_login['id']){
			redirect('');
		}
		$callback = base_url();
		if($this->input->get('callback',true)){
			$callback = $this->input->get('callback', true);
		}

		$data['content'] = $this->load->view('content/login_view', [
			'action'=>base_url('login/do_login'),
			'callback'=>$callback
		], true);

		$data['meta'] = [
			'title'=> 'Login | Komunitas Guppy Cianjur (KAGUYUR)'
		];

		
		$this->load->view('template_view', $data);
	}

	public function do_login()
	{
		$this->load->model('global_model');
		$this->load->library(['form_validation']);
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_message('required', '{field} harus diisi.');

		if ($this->form_validation->run()===FALSE ){
			if(validation_errors())
			{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>strip_tags(validation_errors())]);
			}

		}else{
            $member = $this->global_model->get([
                'select'=>'id, farm, name, logo, phone, status, password',
                'table'=>'member',
                'where'=>[
                    'email'=>$this->input->post('email',true)
                ]
            ]);
			$member = $member->row_array();
			if($member && $member['password'] == md5($this->input->post('password',true)) && in_array($member['status'],['PENDING','VERIFIED']))
			{	
                $this->load->library('session');
                $this->session->set_userdata('user_login', $member);
				echo json_encode(['tipe'=>'success', 'title'=>'Success!','message'=>'Login berhasil','redirect'=>$this->input->get('callback')]);
			}else{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Email dan Password Tidak Terdaftar!']);
			}
		}		
	}
    public function logout()
    {
        $this->load->library('session');
        $this->session->unset_userdata('user_login');
        redirect('');
    }
	public function reset_password($id, $hash){
		if($hash!=md5($id.'hs^35shKjsdh()')){
			redirect('');
			exit;
		}
		$member = @json_decode(file_get_contents('./assets/json/member_'.$id.'.json'));
		if(empty($member)){
			$this->load->model('global_model');
			$member = $this->global_model->get([
				'table'=>'member',
				'id'=>$id
			])->row();
		}
		$data['content'] = $this->load->view('content/reset_password_view', [
			'id'=>$id,
			'hash'=>$hash,
			'member'=>$member
		], true);

		$data['meta'] = [
			'title'=> 'Reset Password | Komunitas Guppy Cianjur (KAGUYUR)'
		];		
		
		$this->load->view('template_view', $data);
	}
	public function do_reset_password($id, $hash)
	{
		if($hash!=md5($id.'hs^35shKjsdh()')){
			echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Url tidak valid!']);
			exit;
		}
		$this->load->model('global_model');
		$this->load->library(['form_validation']);
		$this->form_validation->set_rules('password', 'Password Baru', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('passconf', 'Konfirmasi Password Baru', 'trim|required|matches[password]');
		$this->form_validation->set_message('required', '{field} harus diisi.');

		if ($this->form_validation->run()===FALSE ){
			if(validation_errors())
			{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>strip_tags(validation_errors())]);
			}

		}else{
            $member = $this->global_model->update([
                'table'=>'member',
                'id'=>$id,
                'data'=>[
					'password'=>md5($this->input->post('password',true))
				],
            ]);
			if($member)
			{	
				echo json_encode(['tipe'=>'success', 'title'=>'Success!','message'=>'Reset password berhasil']);
			}else{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Reset password gagal!']);
			}
		}		
	}

	public function forgote()
	{
		$this->load->model('global_model');
		$this->load->library(['form_validation']);
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_message('required', '{field} harus diisi.');

		if ($this->form_validation->run()===FALSE ){
			if(validation_errors())
			{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>strip_tags(validation_errors())]);
			}
		}else{
			$member = $this->global_model->get([
				'table'=>'member',
				'where'=>[
					'email'=>$this->input->post('email', true)
				]
			]);
			if($member->num_rows() > 0)
			{	
				// the message
				$msg = '
				<p>Hi '.$member->row()->name.'</p>
				<p>Klik <a href="'.base_url('login/reset_password/'.$member->row()->id.'/'.md5($member->row()->id.'hs^35shKjsdh()')).'">disini</a> untuk mereset password</p>
				<p>Terima Kasih<br>admin@kaguyur.com</p>
				';
				$headers = "MIME-Version: 1.0" . "\r\n"; 
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
				$headers .= "From: Admin Kaguyur <admin@kaguyur.com>"; 
				// send email
				mail($this->input->post('email', true), "Reset Password", $msg, $headers);
				echo json_encode(['tipe'=>'success', 'title'=>'Success!','message'=>'Silakan cek kotak masuk email anda']);
			}else{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Email Tidak Terdaftar!']);
			}
		}		
	}
}
