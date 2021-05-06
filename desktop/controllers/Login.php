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

		$data['content'] = $this->load->view('content/login_view', [
		], true);
		
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
                'select'=>'id, farm, name, logo, phone, status',
                'table'=>'member',
                'where'=>[
                    'email'=>$this->input->post('email',true),
                    'password'=>md5($this->input->post('password',true)),
                ]
            ]);
			if($member->num_rows())
			{	
                $this->load->library('session');
                $this->session->set_userdata('user_login', $member->row_array());
				echo json_encode(['tipe'=>'success', 'title'=>'Success!','message'=>'Login berhasil']);
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
}
