<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends MY_Controller {

	private $limit = 15;

	function __construct()
   	{
    	parent::__construct();
    	$this->table_name = 'article';
   	}

	public function index()
	{
		$page 	= gen_page();
		$offset = ($page-1)*$this->limit;
		$search = $this->input->get('search');
		$where 	= array();
		if ($search) {
			$where['LOWER(title) like'] = '%'.strtolower($search).'%';
			$where['status !='] = 'DELETED';
		}
		$total = $this->global_model->count(['table'=>$this->table_name,'where'=>$where]);
		$news_view['data'] 	= $this->global_model->get(['table'=>$this->table_name,'where'=>$where])->result();
		$news_view['offset'] = $offset;
		$news_view['paging'] = gen_paging($total,$this->limit);
		$news_view['total'] 	= gen_total($total,$this->limit,$offset);
		$data['content'] 	= $this->load->view('contents/article_view', $news_view, TRUE);

		$this->load->view('template_view', $data);
	}

	private function _set_rules()
	{
		$this->form_validation->set_rules('title','Judul','trim|required');
		$this->form_validation->set_rules('description','Deskripsi','trim|required');
		$this->form_validation->set_rules('content', 'Content', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
	}
	private function _set_data()
	{
		$title 			= $this->input->post('title');
		$description 	= $this->input->post('description');
		$content 		= $this->input->post('content');
		$status 		= $this->input->post('status');
		
		// cari foto
		if(preg_match_all('/<img[^>]+>/i',$content, $images))
        {
            if(isset($images[0][0]) && $images[0][0]){
				preg_match( '/src="([^"]*)"/i', $images[0][0], $src );
				$srchasil =  (isset($src[1])) ? $src[1] : "";
				$photo = substr($srchasil, strpos($srchasil, 'assets/'));
            }
        }
		$data = array(
			'title' => $title,
			'description' => $description,
			'content' => $content,
			'image' => $photo,
			'status' => $status,
		);

		return $data;
	}
	public function add($status='')
	{
		$this->_set_rules();
		if ($this->form_validation->run()===FALSE) {
			$data['content'] = $this->load->view('contents/form_article_view',[
                'title'=>'Tambah Berita',
                'action'=>base_url('article/add')
            ],true);

			$data['script'] = gen_script(array(
				config_item('assets').'plugins/tinymce/js/tinymce/tinymce.min.js'
			));

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
            if($data['status']=='PUBLISH'){
                $data['published_date'] 	= date('Y-m-d H:i:s');    
                $data['published_by'] 	= $_SESSION['user_login']['id'];
            }
			$data['created_date'] 	= date('Y-m-d H:i:s');
			$data['created_by'] 	= $_SESSION['user_login']['id'];

			$id = $this->general_model->add($this->table_name, $data);
			if($id)
			{
				$this->generate_json();
				$this->generate_json($id);
				echo json_encode(array('id'=>$id,'action'=>'insert', 'message'=>'Data Has Been Added'));
			}
		}
	}

	public function edit($id='',$status = '')
	{
		$this->_set_rules();
		if ($this->form_validation->run()===FALSE) {
			$news_view['title'] = 'Edit Article';
			$news_view['action'] = base_url('article/edit/'.$id.'/'.$status);
			$news_view['data'] = $this->general_model->get($this->table_name, null, array('id'=>$id))->row();
			$data['content'] = $this->load->view('contents/form_article_view',$news_view,true);

			$data['script'] = gen_script(array(
				config_item('assets').'plugins/tinymce/js/tinymce/tinymce.min.js',
			));

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
            if($data['status']=='PUBLISH' && $status=='DRAFT'){
                $data['published_date'] 	= date('Y-m-d H:i:s');    
                $data['published_by'] 	= $_SESSION['user_login']['id'];
            }

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
				'status' => 'DELETED'
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
				'select'=>$this->table_name.'.*, member.name as author',
				'table'=>$this->table_name,
				'where'=>[
					$this->table_name.'.status'=>'PUBLISH',
					$this->table_name.'.id'=>$id
				],
				'join'=>[
					['member','article.created_by = member.id']
				]
			])->row_array();
			create_json('article_'.$id.'.json', json_encode($data));	
		}else{
			$data = $this->global_model->get([
				'select'=>'a.id,a.title,a.description,a.image,a.published_date, b.name as author',
				'table'=>$this->table_name.' a',
				'where'=>[
					'a.status'=>'PUBLISH'
				],
				'limit'=>20,
				'join'=>[
					['member b','a.created_by = b.id']
				]
			])->result_array();
			create_json('article.json', json_encode($data));
		}
	}
}
