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
		$this->form_validation->set_rules('photo','Pas Foto','trim');
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
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
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
				$this->generate_json($id);
				echo json_encode(array('id'=>$id,'action'=>'insert', 'message'=>'Tambah data berhasil'));
			}
		}
	}

	public function edit($id='')
	{
		$this->_set_rules();
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|callback_unique_email['.$id.']');
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
				$this->generate_json($id);
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
				$this->generate_json($id);
				echo json_encode(['id'=>$id,'action'=>'delete','message'=>'Hapus data berhasil']);
			}		
		}	
	}

	public function unique_email($data,$id){
		$user = $this->general_model->get('member', 'email', array('id'=>$id))->row();
		$this->form_validation->set_message('unique_email','Email sudah dipakai');
		$unique = $this->general_model->get('member', 'email', array('email'=>$data,'email !='=>$user->email));
		if($unique && $unique->num_rows() > 0){
			return false;
		}
		return true;
	}

	public function export()
	{	
        $search = $this->input->get('search');
		if($search){
			$where['LOWER(name) like'] = '%'.strtolower($search).'%';
		}

		$where['status != '] = 'DELETED';
		$result = $this->general_model->get($this->table_name,'',$where,'date_created asc')->result();

        $this->load->library('table');
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=list-member-export-".date('Ymd').".xls");

		$this->table->set_heading('no', 'farm', 'name', 'alamat', 'phone', 'strain', 'photo', 'logo', 'barcode','ig', 'tw', 'fb', 'status', 'date_created');

		$i=1;
		foreach ($result as $key => $row) {
			$this->table->add_row(
				$i++,
				$row->farm,
				$row->name,
				$row->address,
				"'".$row->phone,
				$row->strain,
				!empty($row->photo)?base_url($row->photo):'',
				!empty($row->logo)?base_url($row->logo):'',
				!empty($row->barcode)?base_url($row->barcode):'',
				$row->ig,
				$row->tw,
				$row->fb,
				$row->date_created,
				$row->status
			);
		}
		echo $this->table->generate();
	}

	private function generate_json($id = '')
	{
		if(!empty($id)){
			$member = $this->global_model->get([
				'table'=>$this->table_name,
				'where'=>[
					'id'=>$id
				]
			])->row_array();
			create_json('member_'.$id.'.json', json_encode($member));
		}else{
			$member = $this->global_model->get([
				'table'=>$this->table_name,
				'where'=>[
					'status'=>'VERIFIED'
				]
			])->result_array();
			create_json('member.json', json_encode($member));
		}
	}

	public function generate_barcode($id)
	{
		$member = $this->global_model->get([
			'table'=>$this->table_name,
			'where'=>[
				'id'=>$id,
				'status'=>'VERIFIED'
			]
		])->row();
		if(!empty($member)){
			$barcode = file_get_contents('https://api.qrserver.com/v1/create-qr-code/?size=150x150&data='.base_url('anggota/'.$member->id.'/'.url_title($member->farm, '-', true)));
			if(!empty($barcode)){

				$upload_path = FCPATH.'assets/photo/barcode/';
				$upload_path = str_replace(array('cms/','\cms'), '', $upload_path);
				if (!is_dir($upload_path)) {
					if(!@mkdir($upload_path, 0755, true)){
						$error = error_get_last();
						echo json_encode(array('id'=>1,'action'=>'update', 'message'=>$error));
					}
				}
		
				$result = file_put_contents($upload_path.$id.'.png',$barcode);
				if($result){
					$this->global_model->update([
						'table'=>$this->table_name,
						'data'=>[
							'barcode'=>'assets/photo/barcode/'.$id.'.png'
						],
						'id'=>$id
					]);
					echo json_encode(['id'=>$id,'action'=>'update','message'=>'Generate barcode berhasil']);
				}
			}
		}
	}
	public function generate_barcode_all()
	{
		$this->load->model('global_model');
		$member = $this->global_model->get([
			'table'=>$this->table_name,
			'where'=>[
				'status'=>'VERIFIED',
				'barcode IS NULL'=>null
			]
		])->result();
		$i = 0;
		foreach ($member as $row) {
			$this->generate_barcode($row->id);
			$i++;
		}
	}
}