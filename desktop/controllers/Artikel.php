<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel extends MY_Controller
{
	public function __construct()
	{
	    parent::__construct();
	}

	public function index()
	{	
		$article = @json_decode(file_get_contents('./assets/json/article.json'));
		$data['content'] = $this->load->view('content/artikel_view', [
			'article'=>$article,
		], true);

		$data['meta'] = [
			'title'=> 'Artikel | Komunitas Guppy Cianjur (KAGUYUR)'
		];
		
		$this->load->view('template_view', $data);
	}
    public function detail($id)
    {
		$article = @json_decode(file_get_contents('./assets/json/article_'.$id.'.json'));
		dd($article);
        if(empty($article)){
            show_404();
            exit;
        }
		$data['content'] = $this->load->view('content/artikel_detail_view', $article, true);

		$data['meta'] = [
			'title'=> $article->title.' | Komunitas Guppy Cianjur (KAGUYUR)',
			'image'=> base_url($article->image),
		];

		
		$this->load->view('template_view', $data);
    }
	public function list()
	{
		check_verified();
		$this->load->model('global_model');
		$data['content'] = $this->load->view('content/artikel_list_view', [
			'data'=>$this->global_model->get([
				'table'=>'article',
				'where'=>[
					'created_by'=>$this->user_login['id'],
					'status !='=>'DELETED'
				]
			])->result()
		], true);
		
		$this->load->view('template_view', $data);
	}
	public function add()
	{
		check_verified();

		$data['content'] = $this->load->view('content/artikel_edit_view', [
			'title'=>'Tulis Artikel',
			'action'=>base_url('artikel/do_add'),
		], true);
		
		$data['script'] = $this->load->view('script/article','',true);
		$this->load->view('template_view', $data);
	}
	public function edit($id, $status)
	{
		check_verified();

		$this->load->model('global_model');
		$article = $this->global_model->get([
			'table'=>'article',
			'where'=>[
				'id'=>$id
			]
		])->row();

		check_owner($article->created_by);

		$data['content'] = $this->load->view('content/artikel_edit_view', [
			'title'=>'Edit Artikel',
			'data'=>$article,
			'action'=>base_url('artikel/do_edit/'.$id.'/'.$status),
		], true);
		
		$data['script'] = $this->load->view('script/article','',true);
		$this->load->view('template_view', $data);
	}

	public function do_add()
	{
		check_verified();
		
		$this->load->model('general_model');
		$this->load->library(['form_validation', 'upload']);
		$this->form_validation->set_rules('title', 'Judul', 'trim|required');
		$this->form_validation->set_rules('description', 'Deskripsi', 'trim|required');
		$this->form_validation->set_rules('content', 'Konten', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_message('required', '{field} harus diisi.');

		if ($this->form_validation->run()===FALSE ){
			if(validation_errors())
			{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>strip_tags(validation_errors())]);
			}

		}else{		
			$content = $this->input->post('content', true);
			// cari foto
			if(preg_match_all('/<img[^>]+>/i',$content, $images))
			{
				if(isset($images[0][0]) && $images[0][0]){
					preg_match( '/src="([^"]*)"/i', $images[0][0], $src );
					$srchasil =  (isset($src[1])) ? $src[1] : "";
					$image = substr($srchasil, strpos($srchasil, 'assets/'));
				}
			}
				
			$data = [
				'title'=> $this->input->post('title', true),
				'description'=> $this->input->post('description', true),
				'content'=> $content,
				'image'=> $image,
				'status'=> $this->input->post('status', true),
			];
			$data['created_date'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->user_login['id'];

			$add = $this->general_model->add('article', $data);
			if($add)
			{	
				echo json_encode(['tipe'=>'success', 'title'=>'Success!','message'=>'Tambah artikel berhasil']);
			}else{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Tambah artikel Gagal']);
			}
		}		
	}

	public function do_edit($id, $status)
	{
		check_verified();
		
		$this->load->model('global_model');
		$article = $this->global_model->get([
			'table'=>'article',
			'where'=>[
				'id'=>$id
			]
		])->row();
		
		check_owner($article->created_by);

		$this->load->model('general_model');
		$this->load->library(['form_validation', 'upload']);
		$this->form_validation->set_rules('title', 'Judul', 'trim|required');
		$this->form_validation->set_rules('description', 'Deskripsi', 'trim|required');
		$this->form_validation->set_rules('content', 'Konten', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_message('required', '{field} harus diisi.');

		if ($this->form_validation->run()===FALSE ){
			if(validation_errors())
			{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>strip_tags(validation_errors())]);
			}

		}else{						
			$content = $this->input->post('content', true);
			// cari foto
			if(preg_match_all('/<img[^>]+>/i',$content, $images))
			{
				if(isset($images[0][0]) && $images[0][0]){
					preg_match( '/src="([^"]*)"/i', $images[0][0], $src );
					$srchasil =  (isset($src[1])) ? $src[1] : "";
					$image = substr($srchasil, strpos($srchasil, 'assets/'));
				}
			}

			$data = [
				'title'=> $this->input->post('title', true),
				'description'=> $this->input->post('description', true),
				'content'=> $content,
				'image'=> $image,
				'status'=> $this->input->post('status', true),
			];
			$data['updated_by'] = $this->user_login['id'];
			$data['updated_date'] = date('Y-m-d H:i:s');

			if($data['status']=='PUBLISH' && $status=='DRAFT'){
                $data['published_date'] 	= date('Y-m-d H:i:s');    
                $data['published_by'] 	= $this->user_login['id'];
            }

			$add = $this->general_model->edit('article', $id, $data);
			if($add)
			{	
				echo json_encode(['tipe'=>'success', 'title'=>'Success!','message'=>'Edit artikel berhasil']);
			}else{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Edit artikel Gagal']);
			}
		}		
	}

	public function page_404()
	{
		show_404();
	}
}
