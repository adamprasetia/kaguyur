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
		$product = @json_decode(file_get_contents('./assets/json/product.json'));
        if(!$product){
            show_404();
            exit;
        }
		$data['content'] = $this->load->view('content/product_view', [
			'product'=>$product
		], true);
		
		$this->load->view('template_view', $data);
	}
	public function detail($id)
	{
		$product = @json_decode(file_get_contents('./assets/json/product_'.$id.'.json'));
        if(!$product){
            show_404();
            exit;
        }
		$data['content'] = $this->load->view('content/product_detail_view', [
			'product'=>$product
		], true);
		
		$this->load->view('template_view', $data);
	}
	public function add()
	{
		if(!$this->user_login['id']){
			redirect('login');
		}

		$this->load->model('general_model');
		$this->load->library(['form_validation', 'upload']);
		$this->form_validation->set_rules('name', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('description', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('photo','Foto','callback_required_photo');
		$this->form_validation->set_rules('price','Harga','trim');
		$this->form_validation->set_message('required', '{field} harus diisi.');

		if ($this->form_validation->run()===FALSE ){
			if(validation_errors())
			{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>strip_tags(validation_errors())]);
			}

		}else{			
			$photo   = uploadFile('photo');
			
			$data = [
				'name'=> $this->input->post('name', true),
				'description'=> $this->input->post('description', true),
				'photo'=> json_encode([$photo['data']]),
				'price'=> $this->input->post('price', true),
			];
			$data['created_by'] = $this->user_login['id'];
			$data['created_date'] = date('Y-m-d H:i:s');
			$data['status'] = 'ACTIVE';

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
		}elseif ($_FILES['photo']['size'] > 204800) {
			$this->form_validation->set_message('required_photo','Pastikan ukuran file Foto tidak lebih dari 200KB');
			$status = false;
		}
		return $status;
    }

}
