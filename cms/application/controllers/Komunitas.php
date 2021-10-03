<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Komunitas extends MY_Controller {

	private $limit = 15;

	function __construct()
   	{
    	parent::__construct();
    	$this->data['page'] = 'komunitas';
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
		$komunitas_view['data'] 	= $this->general_model->get($this->data['page'], '', $where, '', $this->limit, $offset)->result();
		$komunitas_view['offset'] = $offset;
		$komunitas_view['paging'] = gen_paging($total,$this->limit);
		$komunitas_view['total'] 	= gen_total($total,$this->limit,$offset);
		$data['content'] 	= $this->load->view('contents/komunitas_view', $komunitas_view, TRUE);

		$this->load->view('template_view', $data);
	}

	private function _set_rules()
	{
		$this->form_validation->set_rules('name', 'Nama Komunitas', 'trim|required');
		$this->form_validation->set_rules('logo', 'Logo', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
	}
	private function _set_data()
	{
		$name 		= $this->input->post('name');
		$logo 		= $this->input->post('logo');
		$status 		= $this->input->post('status');

		$data = array(
			'name' => $name,
            'logo' => $logo,
            'status' => $status,
		);
		
		return $data;
	}
	public function add()
	{
		$this->_set_rules();
		if ($this->form_validation->run()===FALSE) {
			$komunitas_view['komunitas'] = $this->data['page'];
			$komunitas_view['action'] = base_url('komunitas/add');
			$komunitas_view['title'] = 'Tambah Komunitas';
			$data['content'] = $this->load->view('contents/form_komunitas_view',$komunitas_view,true);

			if(!validation_errors())
			{
				$this->load->view('template_view',$data);
			}
			else
			{
				echo json_encode(array('tipe'=>'warning', 'title'=>'Something Wrong !', 'message'=>strip_tags(validation_errors())));
			}

		}else{
			$data = $this->_set_data();
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
			$komunitas_view['title'] = 'Edit Komunitas';
			$komunitas_view['action'] = base_url('komunitas/edit/'.$id);
			$komunitas_view['komunitas'] = $this->data['page'];
			$komunitas_view['data'] = $this->general_model->get($this->data['page'], null, array('id'=>$id))->row();
			$data['content'] = $this->load->view('contents/form_komunitas_view',$komunitas_view,true);

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
