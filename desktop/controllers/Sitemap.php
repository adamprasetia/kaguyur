<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap extends CI_Controller {

	function __construct()
   	{
        parent::__construct();
        $this->load->library('xml_writer');
        $this->load->model('global_model');
   	}
    public function index()
    {
        # Initiate class
		$xml = new Xml_writer();
		$xml->setRootName('sitemapindex',array('xmlns'=>'http://www.sitemaps.org/schemas/sitemap/0.9'));
        $xml->initiate();
        $module = ['artikel','produk','anggota','forum'];
        foreach ($module as $row) {            
            $xml->startBranch('sitemap');
            $xml->addNode('loc', 'https://www.kaguyur.com/'.$row.'/sitemap.xml');
            $xml->addNode('lastmod',date('c',time()));
            $xml->endBranch('sitemap');
        }
		$xml->getXml(TRUE);
    }
   	public function artikel()
   	{
		$data	= $this->global_model->get([
            'select'=>'id, title',
            'table'=>'article',
            'limit'=>200,
            'order'=>[
                'published_date'=>'desc'
            ],
            'where'=>[
                'status'=>'PUBLISH'
            ]
        ])->result();

		# Initiate class
		$xml = new Xml_writer();
		$xml->setRootName('urlset', array('xmlns'=>'http://www.sitemaps.org/schemas/sitemap/0.9'));
		$xml->initiate();

		foreach ($data as $row) 
		{
			$xml->startBranch('url');	
				$xml->addNode('loc', 'https://www.kaguyur.com/artikel/'.$row->id.'/'.url_title($row->title,'-',true));
			$xml->endBranch('url');	
		}

		$xml->getXml(TRUE);
	}
   	public function produk()
   	{
		$data	= $this->global_model->get([
            'select'=>'id, name',
            'table'=>'product',
            'limit'=>200,
            'order'=>[
                'created_date'=>'desc'
            ],
            'where'=>[
                'status'=>'ACTIVE'
            ]
        ])->result();

		# Initiate class
		$xml = new Xml_writer();
		$xml->setRootName('urlset', array('xmlns'=>'http://www.sitemaps.org/schemas/sitemap/0.9'));
		$xml->initiate();

		foreach ($data as $row) 
		{
			$xml->startBranch('url');	
				$xml->addNode('loc', 'https://www.kaguyur.com/produk/'.$row->id.'/'.url_title($row->name,'-',true));
			$xml->endBranch('url');	
		}

		$xml->getXml(TRUE);
	}
   	public function forum()
   	{
		$data	= $this->global_model->get([
            'select'=>'id, title',
            'table'=>'forum',
            'limit'=>200,
            'order'=>[
                'created_date'=>'desc'
            ],
            'where'=>[
                'status'=>1
            ]
        ])->result();

		# Initiate class
		$xml = new Xml_writer();
		$xml->setRootName('urlset', array('xmlns'=>'http://www.sitemaps.org/schemas/sitemap/0.9'));
		$xml->initiate();

		foreach ($data as $row) 
		{
			$xml->startBranch('url');	
				$xml->addNode('loc', 'https://www.kaguyur.com/forum/'.$row->id.'/'.url_title($row->title,'-',true));
			$xml->endBranch('url');	
		}

		$xml->getXml(TRUE);
	}
   	public function anggota()
   	{
		$data	= $this->global_model->get([
            'select'=>'id, farm',
            'table'=>'member',
            'limit'=>200,
            'order'=>[
                'date_created'=>'desc'
            ],
            'where'=>[
                'status'=>'VERIFIED'
            ]
        ])->result();

		# Initiate class
		$xml = new Xml_writer();
		$xml->setRootName('urlset', array('xmlns'=>'http://www.sitemaps.org/schemas/sitemap/0.9'));
		$xml->initiate();

		foreach ($data as $row) 
		{
			$xml->startBranch('url');	
				$xml->addNode('loc', 'https://www.kaguyur.com/profile/'.$row->id.'/'.url_title($row->farm,'-',true));
			$xml->endBranch('url');	
		}

		$xml->getXml(TRUE);
	}
}
