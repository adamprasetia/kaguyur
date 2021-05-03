<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {

	private $limit = 15;

	function __construct()
   	{
    	parent::__construct();
    	$this->data['page'] = 'users';
   	}

	public function index()
	{
		$page 	= gen_page();
		$offset = ($page-1)*$this->limit;
		$search = $this->input->get('search');
		$where 	= array();
		if ($search) {
			$where['LOWER(name) like'] = '%'.strtolower($search).'%';
		}
		$total = $this->general_model->count($this->data['page'],$where);
		$users_view['data'] 	= $this->general_model->get($this->data['page'], '', $where, 'date_created desc',$this->limit, $offset)->result();
		$users_view['offset'] = $offset;
		$users_view['paging'] = gen_paging($total,$this->limit);
		$users_view['total'] 	= gen_total($total,$this->limit,$offset);
		$data['content'] 	= $this->load->view('contents/users_view', $users_view, TRUE);

		$this->load->view('template_view', $data);
	}

	private function _set_rules()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('id_privilege','Privilege','trim|required');
	}
	private function _set_data()
	{
		$username 		= $this->input->post('username');
		$password 		= $this->input->post('password');
		$id_privilege 	= $this->input->post('id_privilege');

		$data = array(
			'username' => $username,
			'id_privilege' => $id_privilege
		);
		if(!empty($password)){
			$data['password'] = md5($password);
		}
		
		return $data;
	}
	public function add()
	{
		$this->_set_rules();
		$this->form_validation->set_rules('password','Password','trim|required');
		if ($this->form_validation->run()===FALSE) {
			$users_view['module'] = $this->data['page'];
			$users_view['privilege_list'] = $this->general_model->get('privilege', '*', '', 'name')->result();
			$users_view['action'] = base_url('users/add');
			$users_view['title'] = 'Tambah User';
			$data['content'] = $this->load->view('contents/form_users_view',$users_view,true);

			if(!validation_errors())
			{
				$this->load->view('template_view',$data);
			}
			else
			{
				echo json_encode(array('tipe'=>'warning', 'title'=>'Something Wrong !', 'message'=>strip_tags(validation_errors())));
			}

		}else{
			$data 					= $this->_set_data();
			$data['date_created'] 	= date('Y-m-d H:i:s');
			$id = $this->general_model->add($this->data['page'], $data);
			if($id)
			{
				echo json_encode(array('id'=>$id,'action'=>'insert', 'message'=>'Data Has Been Added'));
			}
		}
	}

	public function edit($id='')
	{
		$this->_set_rules();
		if ($this->form_validation->run()===FALSE) {
			$users_view['title'] = 'Update User';
			$users_view['action'] = base_url('users/edit/'.$id);
			$users_view['module'] = $this->data['page'];
			$users_view['data'] = $this->general_model->get($this->data['page'], null, array('id'=>$id))->row();
			$users_view['privilege_list'] = $this->general_model->get('privilege', '*', '', 'name')->result();
			$data['content'] = $this->load->view('contents/form_users_view',$users_view,true);

			if(!validation_errors())
			{
				$this->load->view('template_view',$data);
			}
			else
			{
				echo json_encode(array('tipe'=>'error', 'title'=>'Something Wrong !', 'message'=>strip_tags(validation_errors())));
			}

		}else{
			$data = $this->_set_data();
			$edit = $this->general_model->edit($this->data['page'], $id, $data);
			if($edit)
			{
				echo json_encode(array('id'=>$id,'action'=>'update','message'=>'Data Has Been Chenged'));
			}
		}
	}

	public function delete($id = '')
	{
		if ($id) {
			$delete = $this->general_model->delete($this->data['page'], $id);
			echo json_encode(array('id'=>$id,'action'=>'delete','message'=>'Data Has Been Deleted'));
		}
	}

}
