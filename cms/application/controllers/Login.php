<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
   	{
    	parent::__construct();
		$this->load->model('general_model');
   	}

   	private function _set_rules()
	{
		$this->form_validation->set_rules('username','Username','trim|required|callback_check_auth');
		$this->form_validation->set_rules('password','Password','trim|required');
	}


	public function index()
	{
		if($this->session->userdata('session_login')){
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
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		if($username == '' || $password == ''){
			$this->form_validation->set_message('check_auth','Username and Password is required');
			return false;
		}

		if($userdata = $this->general_model->login($username, $password))
		{
			$userdata = $this->general_model->get('users', '', ['username'=>$username])->row();
			$data = array(
				'id' => $userdata->id,
			    'username'  => $username,
				'logged_in' => TRUE,
				'module' => []
			);
			$module = $this->general_model->get_module($username);
			foreach ($module as $row) {
				$data['module'][] = $row['id_module'];
			}
			$this->session->set_userdata('session_login', $data);
			return true;
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
			$view_data['username'] = $this->session->userdata('session_login')['username'];
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

			$edit = $this->general_model->change_password($this->input->post('username'), md5($this->input->post('password')));
			if($edit)
			{
				echo json_encode(array('action'=>'edit', 'message'=>'Password has been changed!'));
			}
		}

	}

	public function logout(){

		$this->session->unset_userdata('session_login');
		redirect(base_url('login'));

	}

	public function server(){
		echo "<pre>";var_dump($_SERVER);exit;
	}

	public function cek(){
		$this->session->set_userdata('session_login', ['test'=>'asd']);
	}

	public function get(){
		dd($this->session->userdata('session_login'));
	}

	public function php(){
		echo phpinfo();
	}
	public function path()
	{
		echo FCPATH;
	}

}
