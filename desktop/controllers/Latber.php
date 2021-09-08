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

        $data['content'] = $this->load->view('content/latber_view', [
			'latber'=>$latber
		], true);
		
		$data['meta'] = [
			'title'=> 'Edukasi Guppy Kontes & Peresmian FGI Cianjur 2021',
			'description'=>'Edukasi Guppy Kontes & Peresmian FGI Cianjur 2021',
			'canonical'=>'https://www.kaguyur.com/latber'
		];

		$this->load->view('template_view', $data);
	}
    public function register()
    {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('phone', 'Telepon', 'trim|required');
		$this->form_validation->set_rules('address', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('class', 'Kelas', 'trim|required');
		$this->form_validation->set_message('required', '{field} harus diisi.');

		if ($this->form_validation->run()===FALSE ){
			if(validation_errors())
			{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>strip_tags(validation_errors())]);
			}

		}else{
            $this->load->model('global_model');

            $data = [
                'name'=>$this->input->post('fullname', true),
                'phone'=>$this->input->post('phone', true),
                'address'=>$this->input->post('address', true),
                'class'=>$this->input->post('class', true),
                'created_at'=>date('Y-m-d H:i:s')
            ];

            $reg = $this->global_model->insert(['table'=>'latber', 'data'=>$data]);

            if(!empty($reg))
            {
				echo json_encode(['tipe'=>'success', 'title'=>'Success!','message'=>'Registrasi berhasil']);
			}else{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Registrasi gagal']);
            }
        }
    }
}