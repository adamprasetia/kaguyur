<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        
		if (empty($this->session->userdata('kompas_id'))) {
			include_once("../data/general/SsoClient.php");
			redirect(SsoClient::getLoginUrl(base_url($this->uri->segment(2))));
			exit();
		}
    }
}
?>