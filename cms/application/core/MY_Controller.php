<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
		
	function __construct()
	{		
		parent::__construct();
		if (!$this->session->userdata('user_login')) {
			redirect('login');
		}
		// $komunitas = $_SESSION['user_login']['komunitas'];
		// $this->komunitas_access = [];
		// foreach ($komunitas as $row) {
		// 	$this->komunitas_access[] = $row['id'];
		// }

	}
}