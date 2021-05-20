<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller {

	private $limit = 15;

	function __construct()
   	{
    	parent::__construct();
    	$this->table_name = 'product';
   	}

	public function index()
	{
		$page 	= gen_page();
		$offset = ($page-1)*$this->limit;
		$search = $this->input->get('search');
		$where 	= array('status !='=>'DELETED');
		if ($search) {
			$where['LOWER(name) like'] = '%'.strtolower($search).'%';
		}
		
		$total = $this->general_model->count($this->table_name,$where);
		$module_view['data'] 	= $this->general_model->get($this->table_name, '', $where, 'created_date desc', $this->limit, $offset)->result();
		$module_view['offset'] = $offset;
		$module_view['paging'] = gen_paging($total,$this->limit);
		$module_view['total'] 	= gen_total($total,$this->limit,$offset);
		$data['content'] 	= $this->load->view('contents/product_view', $module_view, TRUE);

		$this->load->view('template_view', $data);
	}

	private function _set_rules()
	{
		$this->form_validation->set_rules('name', 'Nama Produk', 'trim|required');
		$this->form_validation->set_rules('description', 'Deskripsi', 'trim|required');
		$this->form_validation->set_rules('price', 'Harga', 'trim');
		$this->form_validation->set_rules('category', 'Kategori', 'trim|required');
		$this->form_validation->set_rules('stock', 'Stock', 'trim');
		$this->form_validation->set_rules('photo[]', 'Photo', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
	}
	private function _set_data()
	{
		$name 		= $this->input->post('name');
		$description 		= $this->input->post('description');
		$price 		= $this->input->post('price');
		$category 		= $this->input->post('category');
		$stock 		= $this->input->post('stock');
		$photo 		= $this->input->post('photo');
		$status 		= $this->input->post('status');

		$data = array(
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'category' => $category,
			'stock' => $stock,
			'status' => $status,
			'photo' => json_encode($photo),
		);
		
		return $data;
	}
	public function add()
	{
		$this->_set_rules();
		if ($this->form_validation->run()===FALSE) {
			$module_view['module'] = $this->table_name;
			$module_view['action'] = base_url('product/add');
			$module_view['title'] = 'Tambah Produk';
			$data['content'] = $this->load->view('contents/form_product_view',$module_view,true);

			if(!validation_errors())
			{
				$this->load->view('template_view',$data);
			}
			else
			{
				echo json_encode(array('tipe'=>'error', 'title'=>'Something Wrong !', 'message'=>strip_tags(validation_errors())));
			}

		}else{
			$data 					= $this->_set_data();
            $data['created_by'] 	= $_SESSION['user_login']['id'];
			$data['created_date'] 	= date('Y-m-d H:i:s');    

			$id = $this->general_model->add($this->table_name, $data);
			if($id)
			{
                $this->generate_json();
				$this->generate_json($id);
				echo json_encode(array('id'=>$id,'action'=>'insert', 'message'=>'Data Has Been Added'));
			}
		}
	}

	public function edit($id='')
	{
		$this->_set_rules();
		if ($this->form_validation->run()===FALSE) {
			$module_view['title'] = 'Edit Produk';
			$module_view['action'] = base_url('product/edit/'.$id);
			$module_view['data'] = $this->general_model->get($this->table_name, null, array('id'=>$id))->row();
			$data['content'] = $this->load->view('contents/form_product_view',$module_view,true);

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
            $data['updated_by'] 	= $_SESSION['user_login']['id'];
			$data['updated_date'] 	= date('Y-m-d H:i:s');    
			$edit = $this->general_model->edit($this->table_name, $id, $data);
			if($edit)
			{
                $this->generate_json();
				$this->generate_json($id);
				echo json_encode(array('id'=>$id,'action'=>'update','message'=>'Data Has Been Chenged'));
			}
		}
	}

	public function delete($id = '')
	{
		if ($id) {
            $data = array(
				'status' => 0
			);
			$delete = $this->general_model->edit($this->table_name, $id, $data);
            if($delete)
			{
                $this->generate_json();
                $this->generate_json($id);
                echo json_encode(array('id'=>$id,'action'=>'delete','message'=>'Data Has Been Deleted'));
            }
		}
	}

    public function generate_json($id=0)
	{
		if(!empty($id)){
			$data = $this->global_model->get([
				'select'=>'a.*, b.logo, b.phone, b.farm',
				'table'=>$this->table_name.' a',
				'where'=>[
					'a.id'=>$id
				],
				'join'=>[['member b','a.created_by = b.id']]
			])->row_array();
			create_json('product_'.$id.'.json', json_encode($data));	
		}else{
			$data = $this->global_model->get([
				'select'=>'id,name,photo,price',
				'table'=>$this->table_name,
				'where'=>[
					'status'=>'ACTIVE'
				],
				'order'=>[
					'created_date'=>'desc'
				]
			])->result_array();
			create_json('product.json', json_encode($data));
		}
	}

}
