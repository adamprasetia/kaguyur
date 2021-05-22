<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri extends MY_Controller
{
	public function __construct()
	{
	    parent::__construct();
	}

	public function index()
	{	
		$gallery = @json_decode(file_get_contents('./assets/json/gallery.json'));
		$data['content'] = $this->load->view('content/gallery_view', [
			'gallery'=>$gallery
		], true);

		$data['meta'] = [
			'title'=> 'Galeri | Komunitas Guppy Cianjur (KAGUYUR)',
			'description'=>'Kumpulan foto dan galeri kegiatan komunitas guppy cianjur (KAGUYUR)',
			'canonical'=>'https://www.kaguyur.com/galeri'
		];
		
		$this->load->view('template_view', $data);
	}
	public function detail($id)
	{
		$gallery = @json_decode(file_get_contents('./assets/json/gallery_'.$id.'.json'));
		$data['content'] = $this->load->view('content/gallery_detail_view', [
			'gallery'=>$gallery
		], true);

		$data['meta'] = [
			'title'=> $gallery->title.' | Komunitas Guppy Cianjur (KAGUYUR)',
			'description' =>$gallery->title,
			'canonical'=>'https://www.kaguyur.com/galeri/'.$gallery->id.'/'.url_title($gallery->title,'-',true)
		];
		
		$this->load->view('template_view', $data);
	}

}
