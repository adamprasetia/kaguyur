<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends MY_Controller {

	private $limit = 12;

	function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('text');
    	$this->data['page'] = 'video';
   	}

	public function index()
	{
		$page = gen_page();
		$offset = ($page-1)*$this->limit;
		$where['status'] = 1;
		$search = strtolower($this->input->get('search'));
		if ($search) {
			$where['LOWER(title) like'] = '%'.$search.'%';
		}
		$total 			= $this->general_model->count($this->data['page'],$where);
		$xdata['data'] 	= $this->general_model->get($this->data['page'], $select, $where, 'created_at desc',$this->limit, $offset)->result();

		$xdata['offset'] 	= $offset;
		$xdata['paging'] 	= gen_paging($total,$this->limit);
		$xdata['total'] 	= gen_total($total,$this->limit,$offset);
		$data['content'] 	= $this->load->view('contents/video_view', $xdata, TRUE);

		if($this->input->get('modals'))
		{
			$this->load->view('template_modal_view', $data);
		}
		else
		{
			$this->load->view('template_view', $data);
		}
	}

    public function add(){
        $this->_set_rules();
		if ($this->form_validation->run()===FALSE) {
            $xdata['title'] = 'Tambah Video';
			$xdata['action'] = base_url('video/add');
			$data['content'] = $this->load->view('contents/form_video_view',$xdata,true);

			if ($this->input->get('modals')) {
				$this->load->view('template_modal_view',$data);
			}else{

				if(!validation_errors())
				{
					$this->load->view('template_view',$data);
				}
				else
				{
					echo json_encode(array('tipe'=>'error', 'title'=>'Something Wrong !', 'message'=>strip_tags(validation_errors())));
				}
			}
		}else{
			$data = $this->_set_data();
			$data['created_at'] = date('Y-m-d H:i:s');

			$id = $this->general_model->add($this->data['page'],$data);

			echo json_encode(array('id'=>$id,'action'=>'update', 'message'=>'Data Has Been Added'));
		}
    }

	private function _set_rules()
	{
		$this->form_validation->set_rules('title','Judul','trim|required');
		$this->form_validation->set_rules('url','Url','trim|required');
	}

	private function _set_data()
	{
		$title 	= $this->input->post('title');
		$url 	= $this->input->post('url');

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

	public function edit($id)
	{
		$this->_set_rules();
		if ($this->form_validation->run()===FALSE) {
            $xdata['title'] = 'Edit Video';
			$xdata['action'] = base_url('video/edit/'.$id);
			$xdata['data'] = $this->general_model->get($this->data['page'],null,array('id'=>$id))->row();
			$data['content'] = $this->load->view('contents/form_video_view',$xdata,true);

			if ($this->input->get('modals')) {
				$this->load->view('template_modal_view',$data);
			}else{

				if(!validation_errors())
				{
					$this->load->view('template_view',$data);
				}
				else
				{
					echo json_encode(array('tipe'=>'error', 'title'=>'Something Wrong !', 'message'=>strip_tags(validation_errors())));
				}
			}
		}else{
			$data = $this->_set_data();

			$this->general_model->edit($this->data['page'],$id,$data);

			echo json_encode(array('id'=>$id,'action'=>'update', 'message'=>'Data Has Been Changed'));
		}
	}

	public function delete($id = '')
	{
		if ($id) {
			$data = array(
				'status' => 0
			);
			$this->general_model->edit($this->data['page'],$id,$data);
			echo json_encode(array('id'=>$id,'action'=>'delete'));
		}
	}
}
