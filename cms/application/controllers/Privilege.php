<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Privilege extends MY_Controller {

	private $limit = 15;

	function __construct()
   	{
    	parent::__construct();
    	$this->data['page'] = 'privilege';
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
		$privilege_view['data'] 	= $this->general_model->get($this->data['page'], '', $where, '', $this->limit, $offset)->result();
		$privilege_view['offset'] = $offset;
		$privilege_view['paging'] = gen_paging($total,$this->limit);
		$privilege_view['total'] 	= gen_total($total,$this->limit,$offset);
		$data['content'] 	= $this->load->view('contents/privilege_view', $privilege_view, TRUE);

		$this->load->view('template_view', $data);
	}

	private function _set_rules()
	{
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('module[]', 'Module', 'trim|required');
		$this->form_validation->set_rules('komunitas[]', 'Komunitas', 'trim|required');
	}
	private function _set_data()
	{
		$name 		= $this->input->post('name');

		$data = array(
			'name' => $name,
		);
		
		return $data;
	}
	public function add()
	{
		$this->_set_rules();
		if ($this->form_validation->run()===FALSE) {
			$privilege_view['module'] = $this->data['page'];
			$privilege_view['module_list'] = $this->general_model->get('module', '*', '', 'name')->result();
			$privilege_view['komunitas_list'] = $this->general_model->get('komunitas', '*', ['status'=>'VERIFIED'], 'name')->result();
			$privilege_view['action'] = base_url('privilege/add');
			$privilege_view['title'] = 'Tambah Privilege';
			$data['content'] = $this->load->view('contents/form_privilege_view',$privilege_view,true);

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
			$id = $this->general_model->add($this->data['page'], $data);
			if($id)
			{
				$modules = $this->input->post('module');
				foreach ($modules as $row) {
					$this->general_model->add_no_return('privilege_module', ['id_privilege'=>$id, 'id_module'=>$row]);
				}
				$komunitas = $this->input->post('komunitas');
				foreach ($komunitas as $row) {
					$this->general_model->add_no_return('privilege_komunitas', ['id_privilege'=>$id, 'id_komunitas'=>$row]);
				}
				echo json_encode(array('id'=>$id,'action'=>'insert', 'message'=>'Data Has Been Added'));
			}
		}
	}

	public function edit($id='')
	{
		$this->_set_rules();
		if ($this->form_validation->run()===FALSE) {
			$privilege_view['title'] = 'Edit Privilege';
			$privilege_view['action'] = base_url('privilege/edit/'.$id);
			$privilege_view['module'] = $this->data['page'];
			$privilege_view['data'] = $this->general_model->get($this->data['page'], null, array('id'=>$id))->row();
			$privilege_view['data_module'] = [];
			$data_module = $this->general_model->get('privilege_module', 'id_module', array('id_privilege'=>$id))->result_array();
			foreach ($data_module as $row) {
				$privilege_view['data_module'][] = $row['id_module'];
			}
			$privilege_view['data_komunitas'] = [];
			$data_komunitas = $this->general_model->get('privilege_komunitas', 'id_komunitas', array('id_privilege'=>$id))->result_array();
			foreach ($data_komunitas as $row) {
				$privilege_view['data_komunitas'][] = $row['id_komunitas'];
			}
			$privilege_view['module_list'] = $this->general_model->get('module', '*', '', 'name')->result();
			$privilege_view['komunitas_list'] = $this->general_model->get('komunitas', '*', ['status'=>'VERIFIED'], 'name')->result();
			$data['content'] = $this->load->view('contents/form_privilege_view',$privilege_view,true);

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
			if(empty($this->input->post('module'))){
				echo json_encode(array('tipe'=>'warning', 'title'=>'Something Wrong !', 'message'=>'Module is Required'));
				exit;
			}
			$edit = $this->general_model->edit($this->data['page'], $id, $data);
			if($edit)
			{
				$modules = $this->input->post('module');
				$this->general_model->delete_from_field('privilege_module', 'id_privilege', $id);
				foreach ($modules as $row) {
					$this->general_model->add_no_return('privilege_module', ['id_privilege'=>$id, 'id_module'=>$row]);
				}
				$komunitas = $this->input->post('komunitas');
				$this->general_model->delete_from_field('privilege_komunitas', 'id_privilege', $id);
				foreach ($komunitas as $row) {
					$this->general_model->add_no_return('privilege_komunitas', ['id_privilege'=>$id, 'id_komunitas'=>$row]);
				}
				echo json_encode(array('id'=>$id,'action'=>'update','message'=>'Data Has Been Chenged'));
			}
		}
	}

	public function delete($id = '')
	{
		if ($id) {
			$this->general_model->delete_from_field('privilege_module', 'id_privilege', $id);
			$this->general_model->delete_from_field('privilege_komunitas', 'id_privilege', $id);
			$delete = $this->general_model->delete($this->data['page'], $id);
			echo json_encode(array('id'=>$id,'action'=>'delete','message'=>'Data Has Been Deleted'));
		}
	}

}
