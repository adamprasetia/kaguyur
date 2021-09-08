<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Latber extends MY_Controller {

	function __construct()
   	{
    	parent::__construct();
    	$this->limit = 15;
    	$this->table_name = 'latber';
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

		$master['detail'] = $this->general_model->get($this->table_name, '', $where, 'created_at desc', $this->limit, $offset)->result();
		$master['offset'] = $offset;
		$master['paging'] = gen_paging($total, $this->limit);
		$master['total']  = gen_total($total, $this->limit, $offset);

		$data['content'] = $this->load->view('contents/latber_view', $master, TRUE);

		$this->load->view('template_view', $data);
	}

	private function _set_rules()
	{
		$this->form_validation->set_rules('name', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('phone', 'No Telepon/Wa', 'trim|required');
		$this->form_validation->set_rules('address', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('class', 'Kelas', 'trim|required');
        $this->form_validation->set_message('required', '{field} harus diisi.');
	}

	private function _set_data()
	{
		return [
			'name' => $this->input->post('name'),
			'phone' => $this->input->post('phone'),
			'address' => $this->input->post('address'),
			'class' => $this->input->post('class'),
			'status' => $this->input->post('status')
		];
	}

    public function add()
	{
		$this->_set_rules();
		if ($this->form_validation->run()===FALSE) {
			
			$data['content'] = $this->load->view('contents/form_latber_view',[
				'action'=>base_url('latber/add'),
				'title'=>'Tambah Peserta',
				'class_list' => $this->general_model->get('latber_class', '*', '', 'name')->result()
			],true);

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
			
            $id = $this->general_model->add($this->table_name, $data);
			if($id)
			{
				echo json_encode(array('id'=>$id,'action'=>'insert', 'message'=>'Tambah Peserta Berhasil'));
			}
		}
	}

	public function edit($id='')
	{
		$this->_set_rules();
		if ($this->form_validation->run()===FALSE) {
			
			$master['data'] = $this->general_model->get($this->table_name, null, ['id'=>$id])->row();
			$master['action'] = base_url('latber/edit/'.$id);
			$master['title'] = 'Edit Peserta';
			$master['class_list'] = $this->general_model->get('latber_class', '*', '', 'name')->result();

			$data['content'] = $this->load->view('contents/form_latber_view',$master,true);

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
				echo json_encode(['id'=>$id,'action'=>'update','message'=>'Update data berhasil']);
			}
		}
	}

	public function delete($id = '')
	{
		if($id){
			$delete = $this->general_model->edit($this->table_name, $id, ['status'=>'DELETED']);
			if($delete){
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
		$result = $this->general_model->get($this->table_name,'',$where,'created_at asc')->result();

        $this->load->library('table');
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=list-latber-export-".date('Ymd').".xls");

		$this->table->set_heading('No', 'Nama Lengkap', 'Telepon/Wa', 'Alamat', 'Kelas', 'Tanggal Registrasi');

		$i=1;
		foreach ($result as $key => $row) {
			$this->table->add_row(
				$i++,
				$row->name,
				"'".$row->phone,
				$row->address,
				$row->class,
				$row->created_at
			);
		}
		echo $this->table->generate();
	}
}