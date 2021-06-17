<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi extends MY_Controller
{
	public function __construct()
	{
	    parent::__construct();
	}

	public function email($id, $hash)
    {
        $message = 'Verifikasi Email Gagal';
		if($hash==md5($id.'hs^35shKjsdh()')){
            $this->load->model('global_model');
            $member = $this->global_model->update([
                'table'=>'member',
                'id'=>$id,
                'data'=>[
                    'email_ver'=>1
                ],
            ]);
            if($member)
            {	
                $message = 'Verifikasi Email Berhasil';
            }
        }
        $data['content'] = $this->load->view('content/email_ver_view', [
            'message'=>$message
        ], true);

        $data['meta'] = [
            'title'=> 'Verifikasi Email | Komunitas Guppy Cianjur (KAGUYUR)'
        ];		
        
        $this->load->view('template_view', $data);
	}
    public function send_email()
    {
        $id = $this->user_login['id'];
        $result = send_email_ver($id);
        if(!empty($result)){
            echo json_encode(['tipe'=>'success', 'title'=>'Success!','message'=>'Silakan cek kotak masuk email anda','redirect'=>$this->input->get('callback')]);
        }else{
            echo json_encode(['tipe'=>"error", 'title'=>'Terjadi kesalahan!', 'message'=>'Pengiriman email verifikasi gagal, silakan coba beberapa saat lagi']);
        
        }
    }
}
