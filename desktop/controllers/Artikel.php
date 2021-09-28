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
		$query = [
			'table'=>'article',
			'where'=>[
				'status'=>'PUBLISH'
			],
			'order'=>[
				'published_date'=>'desc'
			],
		];
		$search = $this->input->get('search', true);
		if(!empty($search)){
			$query['search'] = [
				'title'=>$search,
				'description'=>$search,
				'content'=>$search,
				'tag'=>$search,
			];
		}
		$this->load->model('global_model');
		$total = $this->global_model->count($query);
		$query['limit'] = 20;
		if($this->input->get('offset',true)){
			$query['offset'] = $this->input->get('offset',true);
		}

		$article = $this->global_model->get($query)->result();	

		$this->load->library('pagination');

		$config['base_url'] = base_url('artikel').get_query_string('offset');
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

		$data['content'] = $this->load->view('content/artikel_view', [
			'article'=>$article,
			'paging'=>$this->pagination->create_links(),
		], true);

		$data['meta'] = [
			'title'=> 'Artikel | Fancy Guppy Cianjur'
		];
		
		$this->load->view('template_view', $data);
	}
    public function detail($id)
    {
		$article_lain = @json_decode(file_get_contents('./assets/json/article.json'));
		$article = @json_decode(file_get_contents('./assets/json/article_'.$id.'.json'));
        if(empty($article)){
            show_404();
            exit;
        }
		
		$data['content'] = $this->load->view('content/artikel_detail_view', [
			'article'=>$article,
			'article_lain'=>$article_lain
		], true);

		$data['meta'] = [
			'title'=> $article->title.' | Kaguyur.com',
			'description'=> $article->description,
			'keywords'=> $article->tag,
			'image'=> gen_thumb($article->image,'320x240'),
			'canonical'=>'https://www.kaguyur.com/artikel/'.$article->id.'/'.url_title($article->title,'-',true)
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

	private function _set_rules()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Judul', 'trim|required');
		$this->form_validation->set_rules('description', 'Deskripsi', 'trim|required');
		$this->form_validation->set_rules('content', 'Konten', 'trim|required');
		$this->form_validation->set_rules('tag', 'Tag', 'trim|required');
		
		$this->form_validation->set_message('required', '{field} harus diisi.');
	}
	private function _set_data()
	{
		$content = $this->input->post('content', true);
			
		$data = [
			'title'=> $this->input->post('title', true),
			'description'=> $this->input->post('description', true),
			'image'=> $this->input->post('image', true),
			'content'=> $content,
			'tag'=> $this->input->post('tag', true),
			'status'=> 'DRAFT',
		];		
		return $data;
	}
	public function do_add()
	{
		check_verified();
		
		$this->load->model('general_model');
		$this->_set_rules();
		if ($this->form_validation->run()===FALSE ){
			if(validation_errors())
			{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>strip_tags(validation_errors())]);
			}

		}else{		
			$data = $this->_set_data();
			$data['created_date'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->user_login['id'];

			$add = $this->general_model->add('article', $data);
			if($add)
			{	
				generate_json_article($add);
				generate_json_article();
				echo json_encode(['tipe'=>'success', 'title'=>'Success!','message'=>'Artikel berhasil ditambah']);
			}else{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Artikel Gagal ditambah']);
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
		$this->_set_rules();

		if ($this->form_validation->run()===FALSE ){
			if(validation_errors())
			{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>strip_tags(validation_errors())]);
			}

		}else{		
			$data = $this->_set_data();
			$data['updated_by'] = $this->user_login['id'];
			$data['updated_date'] = date('Y-m-d H:i:s');

			$add = $this->general_model->edit('article', $id, $data);
			if($add)
			{	
				generate_json_article($id);
				generate_json_article();
				echo json_encode(['tipe'=>'success', 'title'=>'Success!','message'=>'Artikel berhasil diupdate']);
			}else{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Artikel gagal diupdate']);
			}
		}		
	}

	public function page_404()
	{
		show_404();
	}
}
