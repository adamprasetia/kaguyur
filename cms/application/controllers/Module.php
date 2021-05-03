<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module extends MY_Controller {

	private $limit = 15;

	function __construct()
   	{
    	parent::__construct();
    	$this->data['page'] = 'module';
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
		$module_view['data'] 	= $this->general_model->get($this->data['page'], '', $where, '', $this->limit, $offset)->result();
		$module_view['offset'] = $offset;
		$module_view['paging'] = gen_paging($total,$this->limit);
		$module_view['total'] 	= gen_total($total,$this->limit,$offset);
		$data['content'] 	= $this->load->view('contents/module_view', $module_view, TRUE);

		$this->load->view('template_view', $data);
	}

	private function _set_rules()
	{
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
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
			$module_view['module'] = $this->data['page'];
			$module_view['action'] = base_url('module/add');
			$module_view['title'] = 'Tambah Module';
			$data['content'] = $this->load->view('contents/form_module_view',$module_view,true);

			$data['script'] = gen_script(array(
				config_item('assets_editor').'script/module.js?v=1'
			));

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
			$module_view['title'] = 'Edit Module';
			$module_view['action'] = base_url('module/edit/'.$id);
			$module_view['module'] = $this->data['page'];
			$module_view['data'] = $this->general_model->get($this->data['page'], null, array('id'=>$id))->row();
			$data['content'] = $this->load->view('contents/form_module_view',$module_view,true);

			$data['script'] = gen_script(array(
				config_item('assets_editor').'script/module.js?v=1'
			));

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
