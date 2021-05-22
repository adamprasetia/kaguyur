<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum extends MY_Controller
{
	public function __construct()
	{
	    parent::__construct();
	}

	public function index()
	{	
        $forum = @json_decode(file_get_contents('./assets/json/forum.json'));
        if(empty($forum)){
            $this->load->model('global_model');
            $forum = $this->global_model->get([
                'table'=>'forum',
                'where'=>[
                    'status'=>1
                ],
                'order'=>[
                    'created_date'=>'desc'
                    ]
            ])->result();
        }

        if(empty($forum)){
            show_404();
            exit;
        }

		$data['content'] = $this->load->view('content/forum_view', [
            'data'=>$forum
		], true);

		$data['meta'] = [
			'title'=> 'Forum | Komunitas Guppy Cianjur (KAGUYUR)',
			'description' => 'Forum diskusi tanya jawab seputar dunia ikan guppy',
			'canonical'=>'https://www.kaguyur.com/forum'
		];
		
		$this->load->view('template_view', $data);
	}
    public function detail($id)
    {
		$forum = @json_decode(file_get_contents('./assets/json/forum_'.$id.'.json'));
		$forum_response = @json_decode(file_get_contents('./assets/json/forum_response_'.$id.'.json'));
        if(empty($forum)){
            $this->load->model('global_model');
            $forum = $this->global_model->get([
                'table'=>'forum',
                'where'=>[
                    'id'=>$id
                ]
            ])->row();
        }

        if(empty($forum)){
            show_404();
            exit;
        }
		$data['content'] = $this->load->view('content/forum_detail_view', [
            'forum'=>$forum,
            'response'=>$forum_response
        ], true);

		$data['meta'] = [
			'title'=> $forum->title.' | Komunitas Guppy Cianjur (KAGUYUR)',
			'canonical'=>'https://www.kaguyur.com/forum/'.$forum->id.'/'.url_title($forum->title,'-',true)
		];

		
		$this->load->view('template_view', $data);
    }
	public function list()
	{
		check_login();

		$this->load->model('global_model');
		$data['content'] = $this->load->view('content/forum_list_view', [
			'data'=>$this->global_model->get([
				'table'=>'forum',
				'where'=>[
					'created_by'=>$this->user_login['id'],
					'status'=>1
                ],
                'order'=>[
                    'created_date'=>'desc'
                ]

			])->result()
		], true);
		
		$this->load->view('template_view', $data);
	}
	public function add()
	{
		check_login();

		$data['content'] = $this->load->view('content/forum_edit_view', [
			'title'=>'Kirim Pertanyaan',
			'action'=>base_url('forum/do_add'),
		], true);
		
		$this->load->view('template_view', $data);
	}
	public function edit($id)
	{
		check_verified();

		$this->load->model('global_model');
		$forum = @json_decode(file_get_contents('./assets/json/forum_'.$id.'.json'));
        if(empty($forum)){
            $this->load->model('global_model');
            $forum = $this->global_model->get([
                'table'=>'forum',
                'where'=>[
                    'id'=>$id
                ]
            ])->row();
        }

		check_owner($forum->created_by);

		$data['content'] = $this->load->view('content/forum_edit_view', [
			'title'=>'Edit Pertanyaan',
			'data'=>$forum,
			'action'=>base_url('forum/do_edit/'.$id),
		], true);
		
		$this->load->view('template_view', $data);
	}

	public function do_add()
	{
		check_login();
		
		$this->load->model('general_model');
		$this->load->library(['form_validation', 'upload']);
		$this->form_validation->set_rules('title', 'Pertanyaan', 'trim|required');
		$this->form_validation->set_rules('description', 'Deskripsi', 'trim');
		$this->form_validation->set_message('required', '{field} harus diisi.');

		if ($this->form_validation->run()===FALSE ){
			if(validation_errors())
			{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>strip_tags(validation_errors())]);
			}

		}else{						
			$data = [
				'title'=> $this->input->post('title', true),
				'description'=> $this->input->post('description', true),
			];
			$data['created_date'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->user_login['id'];

			$add = $this->general_model->add('forum', $data);
			if($add)
			{	
                generate_json_forum();
                generate_json_forum($add);
				echo json_encode(['tipe'=>'success', 'title'=>'Success!','message'=>'Pertanyaan berhasil dikirim']);
			}else{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Pertanyaan gagal dikirim']);
			}
		}		
	}

    public function respon($id)
	{
		check_login();
		
		$this->load->model('general_model');
		$this->load->library(['form_validation', 'upload']);
		$this->form_validation->set_rules('description', 'Deskripsi', 'trim|required');
		$this->form_validation->set_message('required', '{field} harus diisi.');

		if ($this->form_validation->run()===FALSE ){
			if(validation_errors())
			{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>strip_tags(validation_errors())]);
			}

		}else{						
			$data = [
                'id_forum'=>$id,
				'description'=> $this->input->post('description', true),
			];
			$data['created_date'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->user_login['id'];

			$add = $this->general_model->add('forum_response', $data);
			if($add)
			{	
                generate_json_forum_response($id);
				// notif
				$forum = @json_decode(file_get_contents('./assets/json/forum_'.$id.'.json'));
				if(!empty($forum)){
					$this->load->helper('text');
					gen_notif($forum->created_by, $this->user_login['name'].' mengomentari postingan '.word_limiter($forum->title,4),base_url('forum/'.$id.'/'.url_title($forum->title,'-',true)));
				}
	
				echo json_encode(['tipe'=>'success', 'title'=>'Success!','message'=>'Jawaban anda berhasil terkirim']);
			}else{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Jawaban anda gagal terkirim']);
			}
		}		
	}

	public function do_edit($id)
	{
		check_login();
		
		$forum = @json_decode(file_get_contents('./assets/json/forum_'.$id.'.json'));
        if(empty($forum)){
            $this->load->model('global_model');
            $forum = $this->global_model->get([
                'table'=>'forum',
                'where'=>[
                    'id'=>$id
                ]
            ])->row();
        }

		check_owner($forum->created_by);

		$this->load->model('general_model');
		$this->load->library(['form_validation', 'upload']);
		$this->form_validation->set_rules('title', 'Judul', 'trim|required');
		$this->form_validation->set_rules('description', 'Deskripsi', 'trim');
		$this->form_validation->set_message('required', '{field} harus diisi.');

		if ($this->form_validation->run()===FALSE ){
			if(validation_errors())
			{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>strip_tags(validation_errors())]);
			}

		}else{						
			$data = [
				'title'=> $this->input->post('title', true),
				'description'=> $this->input->post('description', true),
			];
			$data['updated_by'] = $this->user_login['id'];
			$data['updated_date'] = date('Y-m-d H:i:s');

			$add = $this->general_model->edit('forum', $id, $data);
			if($add)
			{	
                generate_json_forum();
                generate_json_forum($id);
				echo json_encode(['tipe'=>'success', 'title'=>'Success!','message'=>'Edit pertanyaan berhasil']);
			}else{
				echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Edit pertanyaan Gagal']);
			}
		}		
	}

    public function delete($id)
	{
		check_login();
		
        $forum = @json_decode(file_get_contents('./assets/json/forum_'.$id.'.json'));
        if(empty($forum)){
            $forum = $this->global_model->get([
                'table'=>'forum',
                'where'=>[
                    'id'=>$id
                ]
            ])->row();
        }

		check_owner($forum->created_by);

		$this->load->model('global_model');
		$forum = $this->global_model->delete([
			'table'=>'forum',
			'id'=>$id
		]);

        if($forum)
        {	
            generate_json_forum();
            generate_json_forum($id);
            echo json_encode(['tipe'=>'success', 'title'=>'Success!','message'=>'Delete pertanyaan berhasil']);
        }else{
            echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Delete pertanyaan Gagal']);
        }			
	}
}
