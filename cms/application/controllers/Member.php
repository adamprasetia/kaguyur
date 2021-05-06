<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MY_Controller {

	private $limit = 1;

	function __construct()
   	{
    	parent::__construct();
    	$this->limit = 15;
    	$this->table_name = 'member';
   	}

	public function index()
	{	
		$search = $this->input->get('search');
		if($search){
			$where['LOWER(name) like'] = '%'.strtolower($search).'%';
		}

		$where['status != '] = 'DELETED';
		if($this->input->get('status',true)){
			$where['status'] = $this->input->get('status',true);
		}
		$page = gen_page();
		$offset = ($page-1)*$this->limit;

		$total = $this->general_model->count($this->table_name, $where);

		$master['detail'] = $this->general_model->get($this->table_name, '', $where, 'date_created desc', $this->limit, $offset)->result();
		$master['offset'] = $offset;
		$master['paging'] = gen_paging($total, $this->limit);
		$master['total']  = gen_total($total, $this->limit, $offset);

		$data['content'] = $this->load->view('contents/member_view', $master, TRUE);

		$this->load->view('template_view', $data);
	}

	private function _set_rules()
	{
		$this->form_validation->set_rules('farm', 'Nama Farm', 'trim|required');
		$this->form_validation->set_rules('name', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('address', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('start', 'Mulai Budidaya Sejak', 'trim');
		$this->form_validation->set_rules('phone', 'No Telepon/Wa', 'trim|required');
		$this->form_validation->set_rules('strain','Strain Guppy','trim|required');
		$this->form_validation->set_rules('photo','Pas Foto','trim|required');
		$this->form_validation->set_rules('logo','Logo','trim|required');
		$this->form_validation->set_rules('ig', 'Instagram', 'trim');
		$this->form_validation->set_rules('tw', 'Twitter', 'trim');
		$this->form_validation->set_rules('fb', 'Facebook', 'trim');
        $this->form_validation->set_message('required', '{field} harus diisi.');
	}

	private function _set_data()
	{
		return [
			'farm' => $this->input->post('farm'),
			'name' => $this->input->post('name'),
			'address' => $this->input->post('address'),
			'start' => $this->input->post('start'),
			'phone' => $this->input->post('phone'),
			'email' => $this->input->post('email'),
			'strain' => $this->input->post('strain'),
			'photo' => $this->input->post('photo'),
			'logo' => $this->input->post('logo'),
			'ig' => $this->input->post('ig'),
			'tw' => $this->input->post('tw'),
			'fb' => $this->input->post('fb'),
			'id_privilege' => $this->input->post('id_privilege'),
			'status' => $this->input->post('status')
		];
	}

    public function add()
	{
		$this->_set_rules();
		if ($this->form_validation->run()===FALSE) {
			
			$data['content'] = $this->load->view('contents/form_member_view',[
				'action'=>base_url('member/add'),
				'title'=>'Tambah Anggota',
				'privilege_list' => $this->general_model->get('privilege', '*', '', 'name')->result()
			],true);

			if(!validation_errors())
			{
				$this->load->view('template_view',$data);
			}
			else
			{
				echo json_encode(['tipe'=>'error', 'title'=>'Something Wrong !', 'message'=>strip_tags(validation_errors())]);
			}

		}else{
			$data = $this->_set_data();
			
            $id = $this->general_model->add($this->table_name, $data);
			if($id)
			{
				$this->generate_json();
				echo json_encode(array('id'=>$id,'action'=>'insert', 'message'=>'Tambah data berhasil'));
			}
		}
	}

	public function edit($id='')
	{
		$this->_set_rules();
		if ($this->form_validation->run()===FALSE) {
			
			$master['data'] = $this->general_model->get($this->table_name, null, ['id'=>$id])->row();
			$master['action'] = base_url('member/edit/'.$id);
			$master['title'] = 'Edit Anggota';
			$master['privilege_list'] = $this->general_model->get('privilege', '*', '', 'name')->result();

			$data['content'] = $this->load->view('contents/form_member_view',$master,true);

			if(!validation_errors())
			{
				$this->load->view('template_view',$data);
			}
			else
			{
				echo json_encode(['tipe'=>'error', 'title'=>'Terjadi Kesalahan!', 'message'=>strip_tags(validation_errors())]);
			}

		}else{
			$data = $this->_set_data();
			
			$edit = $this->general_model->edit($this->table_name, $id, $data);
			if($edit)
			{	
				$this->generate_json();
				echo json_encode(['id'=>$id,'action'=>'update','message'=>'Update data berhasil']);
			}
		}
	}

	public function delete($id = '')
	{
		if($id){
			$delete = $this->general_model->edit($this->table_name, $id, ['status'=>'DELETED']);
			if($delete){
				$this->generate_json();
				echo json_encode(['id'=>$id,'action'=>'delete','message'=>'Hapus data berhasil']);
			}		
		}	
	}

	public function export()
	{	
        $search = $this->input->get('search');
		if($search){
			$where['LOWER(name) like'] = '%'.strtolower($search).'%';
		}

		$where['status != '] = 'DELETED';
		$result = $this->general_model->get($this->table_name,'',$where,'date_created desc')->result();

        $this->load->library('table');
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=list-member-export-".date('Ymd').".xls");

		$this->table->set_heading('no', 'farm', 'name', 'alamat', 'phone', 'strain', 'photo', 'logo', 'ig', 'tw', 'fb', 'status', 'date_created');

		$i=1;
		foreach ($result as $key => $row) {
			$this->table->add_row(
				$i++,
				$row->farm,
				$row->name,
				$row->address,
				"'".$row->phone,
				$row->strain,
				$row->photo,
				$row->logo,
				$row->ig,
				$row->tw,
				$row->fb,
				$row->date_created,
				$row->status
			);
		}
		echo $this->table->generate();
	}

	private function generate_json()
	{
		$member = $this->global_model->get([
			'table'=>$this->table_name,
			'where'=>[
				'status'=>'VERIFIED'
			]
		])->result_array();
		create_json('member.json', json_encode($member));
	}
}