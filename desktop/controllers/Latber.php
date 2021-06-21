<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Latber extends MY_Controller
{
	public function __construct()
	{
	    parent::__construct();
	}

	public function index()
	{

	}
    function _cek_class($class)
    {
        if(in_array($class,['SOLID','CORAK'])){
            return true;
        }
        $this->form_validation->set_message('_cek_class', 'Kelas tidak terdaftar');
        return false;
    }
    public function register()
    {
		$this->load->library(['form_validation', 'upload']);
		$this->form_validation->set_rules('class', 'Kelas', 'trim|required|callback__cek_class');
		$this->form_validation->set_rules('video', 'Video', 'trim|required');
		$this->form_validation->set_message('required', '{field} harus diisi.');

		if ($this->form_validation->run()===FALSE ){
			if(validation_errors())
			{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>strip_tags(validation_errors())]);
			}

		}else{
            $this->load->model('global_model');
            if(!check_login(true)){
                echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Silahkan login terlebih dahulu']);
                exit;
            }
            if(!check_verified(true)){
                echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Maaf, Latber khusus member yang terverifikasi']);
                exit;
            }
            $video = $this->input->post('video', true);
            $class = $this->input->post('class', true);
            $class = strtoupper($class);
            
            // cek video
            $query_string 	= array();
            parse_str(parse_url($video, PHP_URL_QUERY), $query_string);
            $video_id = @$query_string["v"];
            if(empty($video_id)){
                echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Format Url Video Youtube Salah']);
                exit;
            }

            // cek duplicate
            $duplicate = $this->global_model->get([
                'table'=>'latber',
                'where'=>[
                    'member_id'=>$this->user_login['id'],
                    'class'=>$class
                ]
            ])->num_rows();
            if(!empty($duplicate)){
                echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Anda sudah mendatar di kelas ini']);
                exit;
            }

            $data = [
                'class'=>$class,
                'video'=>$video_id,
                'member_id'=>$this->user_login['id'],
                'created_at'=>date('Y-m-d H:i:s')
            ];

            $reg = $this->global_model->insert(['table'=>'latber', 'data'=>$data]);

            if(!empty($reg))
            {
				echo json_encode(['tipe'=>'success', 'title'=>'Success!','message'=>'Registrasi latber berhasil']);
			}else{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Registrasi gagal']);
            }
        }
    }
    public function vote()
    {

    }
}