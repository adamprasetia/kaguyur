<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Infografik extends MY_Controller {

	private $limit = 1;

	function __construct()
   	{
    	parent::__construct();
    	$this->limit = 15;
    	$this->table_name = 'infografik';
   	}

	public function index()
	{	
		$search = $this->input->get('search');
		if($search){
			$where['LOWER(title) like'] = '%'.strtolower($search).'%';
		}

		$where['status'] = 1;
		if($this->input->get('status',true)){
			$where['status'] = $this->input->get('status',true);
		}
		$page = gen_page();
		$offset = ($page-1)*$this->limit;

		$total = $this->general_model->count($this->table_name, $where);

		$master['detail'] = $this->general_model->get($this->table_name, '', $where, 'created_date desc', $this->limit, $offset)->result();
		$master['offset'] = $offset;
		$master['paging'] = gen_paging($total, $this->limit);
		$master['total']  = gen_total($total, $this->limit, $offset);

		$data['content'] = $this->load->view('contents/infografik_view', $master, TRUE);

		$this->load->view('template_view', $data);
	}

	private function _set_rules()
	{
		$this->form_validation->set_rules('title', 'Judul', 'trim|required');
		$this->form_validation->set_rules('image','Image','trim|required');
        $this->form_validation->set_message('required', '{field} harus diisi.');
	}

	private function _set_data()
	{
		return [
			'title' => $this->input->post('title'),
			'image' => $this->input->post('image'),
		];
	}

    public function add()
	{
		$this->_set_rules();
		if ($this->form_validation->run()===FALSE) {
			
			$data['content'] = $this->load->view('contents/form_infografik_view',[
				'action'=>base_url('infografik/add'),
				'title'=>'Tambah Infografik',
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
            $data['created_by'] = $this->user_login['id'];
            $data['created_date'] = date('Y-m-d H:i:s');
			
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
		if ($this->form_validation->run()===FALSE) {
			
			$master['data'] = $this->general_model->get($this->table_name, null, ['id'=>$id])->row();
			$master['action'] = base_url('infografik/edit/'.$id);
			$master['title'] = 'Edit Infografik';

			$data['content'] = $this->load->view('contents/form_infografik_view',$master,true);

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
            $data['updated_by'] = $this->user_login['id'];
            $data['updated_date'] = date('Y-m-d H:i:s');            
			
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
			$delete = $this->general_model->edit($this->table_name, $id, ['status'=>0]);
			if($delete){
				$this->generate_json();
				$this->generate_json($id);
				echo json_encode(['id'=>$id,'action'=>'delete','message'=>'Hapus data berhasil']);
			}		
		}	
	}

	private function generate_json($id = '')
	{
		if(!empty($id)){
			$infografik = $this->global_model->get([
				'table'=>$this->table_name,
				'where'=>[
					'id'=>$id
				]
			])->row_array();
			create_json('infografik_'.$id.'.json', json_encode($infografik));
		}else{
			$infografik = $this->global_model->get([
				'table'=>$this->table_name,
				'where'=>[
					'status'=>1
                ],
                'order'=>[
                    'created_date'=>'desc'
                ]
			])->result_array();
			create_json('infografik.json', json_encode($infografik));
		}
	}
}