<?php
	function dd($data)
	{
	    echo "<pre>";var_dump($data);exit;
	}

	function cleanteks($teks)
	{
		$find = array('|[_]{1,}|','|[ ]{1,}|','|[^0-9A-Za-z\-.]|','|[-]{2,}|','|[.]{2,}|');
		$replace = array('-','-','','-','-');
		$newname = strtolower(preg_replace($find,$replace,$teks));
		return $newname;
	}

	function now_url()
	{
	    $ci =& get_instance();

	    $url = $ci->config->site_url($ci->uri->uri_string());
	    return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
	}

	function gen_script($data = array())
	{
	    $return = '';
	    foreach ($data as $row) {
	        $return .= '<script type="text/javascript" src="'.$row.'"></script>';
	    }
	    return $return;
	}
	function gen_css($data = array())
	{
	    $return = '';
	    foreach ($data as $row) {
	        $return .= '<link rel="stylesheet" href="'.$row.'">';
	    }
	    return $return;
	}
	function paging_tmp(){
		$data = array(
			'use_page_numbers' => TRUE,
	        'page_query_string' => TRUE,
	        'query_string_segment' => 'page',
			'full_tag_open' => '<div class="btn-group">',
			'full_tag_close' => '</div>'	,
			'cur_tag_open' => '<button type="button" class="btn btn-primary btn-sm">',
			'cur_tag_close' => '</button>',
		);
		return $data;
	}
	function gen_paging($total = 0,$limit = 10)
	{
	    $ci =& get_instance();
	    $base_url = current_url();
	    $base_url .= get_query_string('page');
	    $config = paging_tmp();
	    $config['base_url'] = $base_url;
	    $config['total_rows'] = $total;
	    $config['per_page'] = $limit;

	    $ci->pagination->initialize($config);
	    $data = $ci->pagination->create_links();
	    return str_replace('<a href','<a class="btn btn-default btn-sm" href',$data);
	}
	function get_query_string($remove = '')
	{
	    $query_string = $_GET;
	    if ($remove) {
	        if (is_array($remove)) {
	            foreach ($remove as $key => $value) {
	                unset($query_string[$value]);
	            }
	        }else{
	            unset($query_string[$remove]);
	        }
	    }
	    if ($query_string) {
	        return '?'.http_build_query($query_string);
	    }
	    return '';
	}
	function gen_total($total,$limit,$offset)
	{
	    $min = $offset+1;
	    $max = $offset+$limit;
	    if ($total < $limit) {
	        $max = $total;
	    }
	    if ($total) {
	        if ($min == $max) {
	            return 'Showing '.$min.' of '.$total.' entries';
	        }elseif ($max > $total) {
	            return 'Showing last of '.$total.' entries';
	        }else{
	            return 'Showing '.$min.' to '.$max.' of '.$total.' entries';
	        }
	    }
	    return 'Data is not found';
	}
	function gen_page()
	{
	    $ci =& get_instance();
	    $page = 1;
	    if ($ci->input->get('page')) {
	        $page = $ci->input->get('page');
	    }
	    return $page;
	}
	function format_dmy($date)
	{
	    if (isset($date) && $date <> '0000-00-00 00:00:00' && $date <> null) {
	        $date = date_create($date);
	        $date = date_format($date,'d-M-Y H:i:s');
	        return $date;
	    }
	}

	function get_image_content($content='')
	{
		preg_match('/< *img[^>]*src*=*["\']?([^"\']*)/i', $content, $image);
	    if($image)
	    {
	    	return str_replace(config_item('base_domain'), '', $image[1]);
	    }
	    return false;
	}

	function create_json($filename, $data)
	{
		$path = str_replace(array('/cms', '\cms'), '', FCPATH);
		$path .= 'assets/json/';
		if (!is_dir($path)) {
			if(!@mkdir($path, 0755, true)){
				return FALSE;
			}
		}

		$ci =& get_instance();
		$ci->load->helper('file');
		if (!write_file($path.$filename, $data))
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

?>
