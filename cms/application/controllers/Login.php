<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
   	{
    	parent::__construct();
		$this->load->model('global_model');
   	}

   	private function _set_rules()
	{
		$this->form_validation->set_rules('email','Email','trim|required|callback_check_auth');
		$this->form_validation->set_rules('password','Password','trim|required');
	}


	public function index()
	{
		if($this->session->userdata('user_login')){
    		redirect('dashboard');
    	}

		$this->_set_rules();
		if($this->form_validation->run()===FALSE){
			if(!validation_errors())
			{
				$this->load->view('contents/login_view');
			}
			else
			{
				echo json_encode(array('tipe'=>'warning', 'title'=>'Something Wrong !', 'message'=>strip_tags(validation_errors())));
			}


		}else{
			echo json_encode(array('action'=>'login','message'=>'Authentication has been successful'));
		}
	}

	public function check_auth()
	{
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));
		if($email == '' || $password == ''){
			$this->form_validation->set_message('check_auth','Email and Password is required');
			return false;
		}
		$userdata = $this->global_model->get([
			'table'=>'member',
			'where'=>['email'=>$email]
		])->row_array();
		if($userdata && $userdata['password'] == $password && $userdata['status']=='VERIFIED')
		{
			$module = $this->general_model->get_module($userdata['id']);
			if($module){
				foreach ($module as $row) {
					$userdata['module'][] = $row['name'];
				}
				$this->session->set_userdata('user_login', $userdata);
				return true;
			}else{
				$this->form_validation->set_message('check_auth','Wrong Username dan Password');
				return false;
			}
		}
		else
		{
			$this->form_validation->set_message('check_auth','Wrong Username dan Password');
			return false;
		}
	}

	public function change_password(){

		$this->form_validation->set_rules('password','Password','trim|required');

		if ($this->form_validation->run()===FALSE) {
			$view_data['email'] = $this->session->userdata('user_login')['email'];
			$data['content'] = $this->load->view('contents/change_password_view', $view_data, true);

			if(!validation_errors())
			{
				$this->load->view('template_view',$data);
			}
			else
			{
				echo json_encode(array('tipe'=>'warning', 'title'=>'Something Wrong !', 'message'=>strip_tags(validation_errors())));
			}

		}else{

			$edit = $this->general_model->change_password($this->input->post('email'), md5($this->input->post('password')));
			if($edit)
			{
				echo json_encode(array('action'=>'edit', 'message'=>'Password has been changed!'));
			}
		}

	}

	public function logout(){

		$this->session->unset_userdata('user_login');
		redirect(base_url('login'));

	}

}
