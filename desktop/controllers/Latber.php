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
        $this->load->model('global_model');
        $latber = $this->global_model->get([
            'table'=>'latber',
        ])->result();
        $this->load->view('template_view',[
            'content'=>$this->load->view('content/latber_view', [
                'latber'=>$latber
            ], true)
        ]);

	}
    function _cek_class($class)
    {
        if(in_array($class,['SOLID','PATTERN'])){
            return true;
        }
        $this->form_validation->set_message('_cek_class', 'Kelas tidak terdaftar');
        return false;
    }
    public function register()
    {
		$this->load->library('form_validation');
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
        $this->load->library('form_validation');
		$this->form_validation->set_rules('latber_id', 'Kontestan', 'trim|required');
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

            $latber_id = $this->input->post('latber_id',true);

            $latber = $this->global_model->get([
                'table'=>'latber',
                'where'=>[
                    'id'=>$latber_id
                ]
            ])->row();
            if(empty($latber)){
                echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Kontestan tidak terdaftar']);
                exit;
            }
            if($latber->member_id == $this->user_login['id']){
                echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Kamu tidak bisa vote diri sendiri']);
                exit;
            }

            $latber_by_member = $this->global_model->get([
                'table'=>'latber',
                'where'=>[
                    'member_id'=>$this->user_login['id']
                ]
            ])->num_rows();
            if(empty($latber_by_member)){
                echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Maaf, Kamu bukan salah satu kontestan']);
                exit;
            }

            $latber_vote = $this->global_model->get([
                'table'=>'latber_vote',
                'where'=>[
                    'member_id'=>$this->user_login['id']
                ]
            ])->num_rows();
            if(!empty($latber_vote)){
                echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Maaf, Kamu sudah vote sebelumnya']);
                exit;
            }
            $data = [
                'latber_id'=>$latber_id,
                'member_id'=>$this->user_login['id'],
                'created_at'=>date('Y-m-d H:i:s')
            ];

            $vote = $this->global_model->insert(['table'=>'latber_vote', 'data'=>$data]);
            echo json_encode(['tipe'=>'success', 'title'=>'Success!','message'=>'Vote latber berhasil']);
        }
    }
}