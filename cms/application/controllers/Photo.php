<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo extends MY_Controller {

	private $limit = 12;

	function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('text');
    	$this->data['page'] = 'photo';
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
		$total = $this->general_model->count($this->data['page'],$where);
		$select = array('id','title', 'author', 'credit', 'status', 'url');
		$photo_view['data'] 	= $this->general_model->get($this->data['page'], $select, $where, 'id desc',$this->limit, $offset)->result();
		$photo_view['offset'] 	= $offset;
		$photo_view['paging'] 	= gen_paging($total,$this->limit);
		$photo_view['total'] 	= gen_total($total,$this->limit,$offset);
		$data['content'] 		= $this->load->view('contents/photo_view', $photo_view, TRUE);

		if($this->input->get('modals'))
		{
			$this->load->view('template_modal_view', $data);
		}
		else
		{
			$this->load->view('template_view', $data);
		}
	}

	public function upload()
	{
		$total_upload 	= 0;
		$total_fail 	= 0;
		$message 		= '';

		$this->load->library('upload');
		for($i=0;$i<count($_FILES['input_file']['name']);$i++) {
			if ($_FILES['input_file']['name'][$i]) {
				$_FILES['userfile']['name']     = $_FILES['input_file']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['input_file']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['input_file']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['input_file']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['input_file']['size'][$i];
				$ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
				// $filename = sprintf("%u", CRC32(md5($_FILES['userfile']['name']))).'.'.$ext;
				$filename = uniqid().'.'.$ext;
				$result_upload = $this->upload_photo($filename);
				if ($result_upload) {
					$data = array(
						'url' => 'assets/photo/'.date('Y/m/d/').'ori_'.$filename
					);
					$id = $this->general_model->add($this->data['page'],$data);
					$total_upload++;
				}else{
					$total_fail++;
				}
			}
		}

		echo json_encode(array('status'=>TRUE,'upload'=>$total_upload,'fail'=>$total_fail,'message'=>'<br/>Photo Has Been Added'));
	}

	private function upload_photo($filename = '')
	{
		$upload_path = FCPATH.'assets/photo/'.date('Y/m/d');
		$upload_path = str_replace(array('cms/','\cms'), '', $upload_path);
		if (!is_dir($upload_path)) {
			if(!@mkdir($upload_path, 0755, true)){
				$error = error_get_last();
				echo json_encode(array('id'=>1,'action'=>'update', 'message'=>$error));
			}
		}
		$config['upload_path'] = $upload_path;
		$config['file_name'] = 'ori_'.$filename;
        $config['allowed_types'] = 'jpeg|jpg|png|webp';
        $config['max_size'] = 6014;
        $config['overwrite'] = false;

		$this->upload->initialize($config);

        if (!$this->upload->do_upload())
        {
			echo $this->upload->display_errors();exit;
        	return FALSE;
        }else{
			$this->crop($filename, $upload_path);
			return TRUE;
        }
	}

	public function crop($filename,$upload_path)
	{
		$this->load->library('image_lib');
		$ratio = [
			[300,300],
			[320,240],
			[100,100],
		];
		foreach ($ratio as $row) {			
			$config['image_library'] = 'gd2';
			$config['source_image'] = $upload_path.'/ori_'.$filename;
			$config['new_image'] = $upload_path.'/'.$row[0].'x'.$row[1].'_'.$filename;
			// $config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = FALSE;
			$config['width']         = $row[0];
			$config['height']       = $row[1];
			$imageSize = $this->image_lib->get_image_properties($config['source_image'], TRUE);
			$config['y_axis'] = ($imageSize['height'] - $config['height']) / 2;
			$config['x_axis'] = ($imageSize['width'] - $config['width']) / 2;
			$this->image_lib->initialize($config);
	
			if ( ! $this->image_lib->crop())
			{	
				echo $this->image_lib->display_errors();
			}
		}
	}

	private function _set_rules()
	{
		$this->form_validation->set_rules('title','Title','trim');
		$this->form_validation->set_rules('author','Author','trim');
		$this->form_validation->set_rules('credit','Credit','trim');
	}
	private function _set_data()
	{
		$title 	= $this->input->post('title');
		$author = $this->input->post('author');
		$credit = $this->input->post('credit');

		$data = array(
			'title'	 	=> $title,
			'author'	=> $author,
			'credit'	=> $credit,
		);

		return $data;
	}

	public function edit($id)
	{
		$this->_set_rules();
		if ($this->form_validation->run()===FALSE) {
			$photo_view['action'] = base_url('photo/edit/'.$id);
			$photo_view['data'] = $this->general_model->get($this->data['page'],null,array('id'=>$id))->row();
			$data['content'] = $this->load->view('contents/form_photo_view',$photo_view,true);

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

			echo json_encode(array('id'=>$id,'action'=>'update', 'message'=>'Data Has Been Chenged'));
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
