<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends MY_Controller
{
	public function __construct()
	{
	    parent::__construct();
		check_verified();
	}

	public function index()
	{	
        $this->load->model('global_model');
		$query = [
            'table'=>'video',
            'where'=>[
                'status'=>1
            ],
            'order'=>[
                'created_date'=>'desc'
			]
        ];
        $total = $this->global_model->count($query);
		$query['limit'] = 12;
		if($this->input->get('offset',true)){
			$query['offset'] = $this->input->get('offset',true);
		}
        $video = $this->global_model->get($query)->result();

		$this->load->library('pagination');

		$config['base_url'] = base_url('video');
		$config['total_rows'] = $total;
		$config['per_page'] = 12;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'offset';
		$config['display_pages'] = FALSE;
		$config['prev_link'] = '<span class="btn btn__black">&lt;</span>';
		$config['next_link'] = '<span class="btn btn__black">&gt;</span>';

		$this->pagination->initialize($config);

        if(empty($video)){
            show_404();
            exit;
        }
		$data['content'] = $this->load->view('content/video_view', [
			'video'=>$video,
			'paging'=>$this->pagination->create_links()
		], true);

		$data['meta'] = [
			'title'=> 'Video | Komunitas Guppy Cianjur (KAGUYUR)'
		];

		$this->load->view('template_modal_view', $data);
	}
    private function _set_rules()
	{
        $this->load->library('form_validation');
		$this->form_validation->set_rules('title','Judul','trim|required');
		$this->form_validation->set_rules('url','Url','trim|required');
        $this->form_validation->set_message('required', '{field} harus diisi.');
	}
    private function _set_data()
	{
		$title 	= htmlentities($this->input->post('title',true));
		$url 	= htmlentities($this->input->post('url',true));

		$query_string 	= array();
		parse_str(parse_url($url, PHP_URL_QUERY), $query_string);
		$id_url 		= @$query_string["v"];

		$data = array(
			'title'	=> $title,
			'url'	=> $url,
			'id_youtube' => $id_url,
		);
		return $data;
	}
	public function add()
	{
		$data['content'] = $this->load->view('content/video_edit_view', [
			'title'=>'Tambah Video',
			'action'=>base_url('video/do_add'),
		], true);
		
		$this->load->view('template_modal_view', $data);
	}
	public function do_add()
	{
		$this->load->model('general_model');
        $this->_set_rules();

		if ($this->form_validation->run()===FALSE ){
			if(validation_errors())
			{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>strip_tags(validation_errors())]);
			}

		}else{
            $data = $this->_set_data();
			$data['created_by'] = $this->user_login['id'];
			$data['created_date'] = date('Y-m-d H:i:s');

			$add = $this->general_model->add('video', $data);
			if($add)
			{	
				echo json_encode(['tipe'=>'success', 'title'=>'Success!','message'=>'Tambah video berhasil']);
			}else{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Tambah video gagal']);
			}
		}		

	}
}
