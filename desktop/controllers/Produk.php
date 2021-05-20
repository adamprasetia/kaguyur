<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends MY_Controller
{
	public function __construct()
	{
	    parent::__construct();
	}

	public function index()
	{	
		$this->load->model('global_model');
		$query = [
			'table'=>'product',
			'order'=>[
				'created_date'=>'desc'
			]
		];
		$search = $this->input->get('search', true);
		if(!empty($search)){
			$query['search'] = [
				'name'=>$search,
				'description'=>$search
			];
		}
		$total = $this->global_model->count($query);
		$query['limit'] = 20;
		if($this->input->get('offset',true)){
			$query['offset'] = $this->input->get('offset',true);
		}

		$product = $this->global_model->get($query)->result();

		$this->load->library('pagination');

		$config['base_url'] = base_url('produk').get_query_string('offset');
		$config['total_rows'] = $total;
		$config['per_page'] = $query['limit'];
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'offset';
		$config['display_pages'] = FALSE;
		$config['prev_link'] = '<span class="btn btn__black">&lt;</span>';
		$config['next_link'] = '<span class="btn btn__black">&gt;</span>';
		$config['last_link'] = FALSE;
		$config['first_link'] = FALSE;

		$this->pagination->initialize($config);

		$data['content'] = $this->load->view('content/product_view', [
			'product'=>$product,
			'paging'=>$this->pagination->create_links()
		], true);

		$data['meta'] = [
			'title'=> 'Produk | Komunitas Guppy Cianjur (KAGUYUR)'
		];

		
		$this->load->view('template_view', $data);
	}
	public function detail($id)
	{
		$product = @json_decode(file_get_contents('./assets/json/product_'.$id.'.json'));
		$member = @json_decode(file_get_contents('./assets/json/member_'.$product->created_by.'.json'));
		$product_member = @json_decode(file_get_contents('./assets/json/product_member_'.$product->created_by.'.json'));
        if(!$product){
            show_404();
            exit;
        }
		$data['content'] = $this->load->view('content/product_detail_view', [
			'product'=>$product,
			'member'=>$member,
			'product_member'=>$product_member
		], true);
		$photo = json_decode($product->photo);
		$data['meta'] = [
			'title'=> $product->name.' | Kaguyur.com', 
			'image'=>base_url($photo[0]), 
			'description'=>$product->description, 
		];

		
		$this->load->view('template_view', $data);
	}
	public function add()
	{
		if(!$this->user_login['id']){
			redirect('login');
			exit;
		}
		if($this->user_login['status'] != 'VERIFIED'){
			redirect('');
			exit;
		}

		$this->load->model('general_model');
		$this->load->library(['form_validation', 'upload']);
		$this->form_validation->set_rules('name', 'Nama Produk', 'trim|required');
		$this->form_validation->set_rules('description', 'Deskripsi', 'trim|required');
		$this->form_validation->set_rules('photo','Foto','callback_required_photo');
		$this->form_validation->set_rules('video','Video','trim');
		$this->form_validation->set_rules('price','Harga','trim');
		$this->form_validation->set_rules('category','Kategori','trim|required');
		$this->form_validation->set_rules('status','Status','trim');
		$this->form_validation->set_message('required', '{field} harus diisi.');

		if ($this->form_validation->run()===FALSE ){
			if(validation_errors())
			{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>strip_tags(validation_errors())]);
			}

		}else{			
			$photo   = uploadFile('photo');
			if(empty($photo['data'])){
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Upload photo produk gagal, silakan coba file foto yang lain']);
				exit;
			}
			$video = $this->input->post('video', true);	
			$data = [
				'name'=> $this->input->post('name', true),
				'description'=> $this->input->post('description', true),
				'photo'=> json_encode([$photo['data']]),
				'video'=> $video,
				'price'=> $this->input->post('price', true),
				'category'=> $this->input->post('category', true),
				'status'=> 'ACTIVE',
			];
			if(!empty($video)){
				$query_string 	= array();
				parse_str(parse_url($video, PHP_URL_QUERY), $query_string);
				$data['video_id'] = @$query_string["v"];
			}

			$data['created_by'] = $this->user_login['id'];
			$data['created_date'] = date('Y-m-d H:i:s');

			$add = $this->general_model->add('product', $data);
			if($add)
			{	
				generate_json_product();
				generate_json_product($add);
				generate_json_product_member($this->user_login['id']);
				echo json_encode(['tipe'=>'success', 'title'=>'Success!','message'=>'Tambah produk berhasil']);
			}else{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Tambah produk gagal']);
			}
		}		

	}
	public function required_photo($foto){
		$status = true;
		if(empty($_FILES['photo']['name'])){
			$this->form_validation->set_message('required_photo','Pas Foto harus diisi'); 
			$status = false;
		}elseif ($_FILES['photo']['size'] > 1024000) {
			$this->form_validation->set_message('required_photo','Pastikan ukuran file Foto tidak lebih dari 1 MB');
			$status = false;
		}
		return $status;
    }
	public function optional_photo($foto){
		$status = true;
		if(!empty($_FILES['photo']['name'])){
			if ($_FILES['photo']['size'] > 1024000) {
				$this->form_validation->set_message('required_photo','Pastikan ukuran file Foto tidak lebih dari 1 MB');
				$status = false;
			}
		}
		return $status;
    }

	public function edit($id)
	{
		$product = @json_decode(file_get_contents('./assets/json/product_'.$id.'.json'));
		if(!$product && $product->created_by == $this->user_login['id']){
            show_404();
            exit;
        }
		$data['content'] = $this->load->view('content/product_edit_view', [
			'product'=>$product
		], true);
		
		$this->load->view('template_view', $data);

	}

	public function update($id)
	{
		if(!$this->user_login['id']){
			redirect('login');
		}

		$product = @json_decode(file_get_contents('./assets/json/product_'.$id.'.json'));
        if(!$product || $product->created_by != $this->user_login['id']){
            show_404();
            exit;
        }

		$this->load->model('general_model');
		$this->load->library(['form_validation', 'upload']);
		$this->form_validation->set_rules('name', 'Nama Produk', 'trim|required');
		$this->form_validation->set_rules('description', 'Deskripsi', 'trim|required');
		$this->form_validation->set_rules('photo','Foto','callback_optional_photo');
		$this->form_validation->set_rules('video','Video','trim');
		$this->form_validation->set_rules('price','Harga','trim');
		$this->form_validation->set_rules('category','Kategori','trim|required');
		$this->form_validation->set_rules('status','Status','trim|required');
		$this->form_validation->set_message('required', '{field} harus diisi.');

		if ($this->form_validation->run()===FALSE ){
			if(validation_errors())
			{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>strip_tags(validation_errors())]);
			}

		}else{		
			$video = $this->input->post('video', true);
				
			$data = [
				'name'=> $this->input->post('name', true),
				'description'=> $this->input->post('description', true),
				'video'=> $video,
				'price'=> $this->input->post('price', true),
				'category'=> $this->input->post('category', true),
				'status'=> $this->input->post('status', true),
			];
			if(!empty($video)){
				if(strpos($video, 'youtu.be')!== false){
					$path = parse_url($video);
					$data['video_id'] = ltrim($path['path'], '/');
				}else{
					$query_string 	= array();
					parse_str(parse_url($video, PHP_URL_QUERY), $query_string);
					$data['video_id'] 		= @$query_string["v"];
				}
			}

			if(!empty($_FILES['photo']['name'])){
				$photo   = uploadFile('photo');	
				if(!empty($photo['data'])){
					$data['photo'] = json_encode([$photo['data']]);
				}
			}
			$data['updated_by'] = $this->user_login['id'];
			$data['updated_date'] = date('Y-m-d H:i:s');

			$add = $this->general_model->edit('product', $id, $data);
			if($add)
			{	
				generate_json_product();
				generate_json_product($id);
				generate_json_product_member($this->user_login['id']);
				echo json_encode(['tipe'=>'success', 'title'=>'Success!','message'=>'Edit produk berhasil']);
			}else{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Edit produk gagal']);
			}
		}		

	}

}
