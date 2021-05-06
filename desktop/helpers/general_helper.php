<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    
function dd($str = ''){
    echo "<pre>";print_r($str);exit;
}

function ci(){
    $ci = &get_instance() ;
    return $ci;
}

function get_share($title, $url)
{
    $data['title'] = $title;
    $data['url'] = $url;

    return ci()->load->view('content/share_view', $data, true);
}

function get_webinar($position='', $title='', $description='', $category_id='')
{
    $data = '';

    ci()->load->model('general_model');
    $web = ci()->general_model->get('webinar', 'id, title, image, url, date', ['status'=>1, 'category_id'=>$category_id], '', 4)->result();
    foreach ($web as $key => $val) {
        $data .= ci()->load->view('content/webinar_item_view', $val, true);
    }
    $xdata['webinar_list'] = $data;
    $xdata['class'] = !empty($position)&&$position=='left' ? true : '';
    $xdata['title'] = !empty($title) ? $title : '';
    $xdata['description'] = !empty($description) ? $description : '';

    return ci()->load->view('content/webinar_view', $xdata, true);
}

function get_event($cid)
{
    ci()->load->model('general_model');
    $evt = ci()->general_model->get_event(['category_id' => $cid])->result();    	
    
    $list = '';
    foreach ($evt as $key => $val) {
        $list .='<div><a href="'.$val->url.'" target="_blank" rel="noopener noreferrer"><img class="imgfillImg" src="'.base_url().$val->image.'" alt="'.$val->title.'" /></a></div>';
    }
    return $list;
}

function uploadFile($fieldname)
{
    $total_upload 	= 0;
    $total_fail 	= 0;
    $message 		= '';

    if ($_FILES[$fieldname]) {
        $type = $_FILES[$fieldname]['type'];

        $_FILES['userfile']['name']     = $_FILES[$fieldname]['name'];
        $_FILES['userfile']['type']     = $type;
        $_FILES['userfile']['tmp_name'] = $_FILES[$fieldname]['tmp_name'];
        $_FILES['userfile']['error']    = $_FILES[$fieldname]['error'];
        $_FILES['userfile']['size']     = $_FILES[$fieldname]['size'];
        $ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
        // $filename = sprintf("%u", CRC32(md5($_FILES['userfile']['name']))).'.'.$ext;
        $filename = uniqid().'.'.$ext;
        $result_upload = do_uploadFile($filename, $type);
        $data = '';
        if ($result_upload) {
            $data = 'assets/photo/'.date('Y/m/d/').$filename;
            if($type == 'application/pdf'){
                $data = 'assets/docs/itinerary/'.date('Y/m/d/').$filename;
            }
            $total_upload++;
        }else{
            $total_fail++;
        }
    }
    else{
        return FALSE;
    }

    return array('status'=>TRUE,'upload'=>$total_upload,'fail'=>$total_fail,'data'=>$data);
}

function do_uploadFile($filename = '', $type)
{
    $upload_path = FCPATH.'assets/photo/'.date('Y/m/d');
    if($type == 'application/pdf'){
        $upload_path = FCPATH.'assets/docs/itinerary/'.date('Y/m/d');
    }
    // $upload_path = str_replace(['kgeditor/','\kgeditor'], '', $upload_path);
    if (!is_dir($upload_path)) {
        if(!@mkdir($upload_path, 0755, true)){
            $error = error_get_last();
            echo json_encode(array('id'=>1,'action'=>'update', 'message'=>$error));
        }
    }
    $config['upload_path'] = $upload_path;
    $config['file_name'] = $filename;
    $config['allowed_types'] = 'jpeg|jpg|png|pdf';
    $config['max_size'] = 2000000; // 2MB
    $config['overwrite'] = false;

    ci()->upload->initialize($config);

    if (!ci()->upload->do_upload())
    {
        return FALSE;
    }else{
        //ci()->resizeImage($filename, $upload_path);
        return TRUE;
    }
}

function img_thumb($url, $width = 1000, $height = 500)
{
    $url = str_replace('assets/', 'thumb/', $url);
    return config_item('thumb').$url.'?width='.$width.'&height='.$height;
}

function img_original($url){
    return base_url().$url;
}

function widget_video($category)
{
    $ci = ci();
    $ci->load->model('General_model');
    $video = $ci->General_model->get('video', '', ['status'=>1, 'id_category'=>$category], 'created_at desc', 5)->result();
    if(empty($video)){
        return '';
    }
    $data['first'] = array_shift($video);
    
    $modals = '';
    foreach ($video as $key => $val) {
        $modals .= ci()->load->view('content/modals_video_view', $val, true);
    }
    $data['modals_video']  = $modals;
    $data['video'] = $video;

    return ci()->load->view('widget/video_view', $data, true);
}

function widget_artikel($category, $type='widget', $field='id_category')
{
    $ci = ci();
    $ci->load->model('General_model');
    $artikel = $ci->General_model->get('artikel', '', ['status'=>1, $field=>$category], 'published_date desc', 5)->result();
    if(empty($artikel)){
        return '';
    }

    $list_artikel = '';
    foreach ($artikel as $key => $val) {
        $list_artikel .= ci()->load->view('widget/artikel_item_view', $val, true);
    }
    $data['artikel'] = $list_artikel;
    $data['category'] = $category;

    if($type != 'widget'){
        return $data['artikel']; //return list artikel
    }else{
        return ci()->load->view('widget/artikel_view', $data, true);
    }
    
}

function widget_infografik($category)
{
    $ci = ci();
    $ci->load->model('General_model');
    $infografik = $ci->General_model->get('infografik', '', ['status'=>1, 'id_category'=>$category, 'published_date <'=>date('Y-m-d H:i:s')], 'published_date desc', 5)->result();
    
    if(empty($infografik)){
        return '';
    }
    
    $modals = '';
    foreach ($infografik as $key => $val) {
        $modals .= ci()->load->view('content/modals_infografik_view', $val, true);
    }
    $data['modals_infografik']  = $modals;
    $data['infografik'] = $infografik;
    $data['category'] = $category;

    if($category == 16){
        return ci()->load->view('widget/infografik_item_view', $data, true);
    }else{
        return ci()->load->view('widget/infografik_view', $data, true);
    }
}
function format_dmy($date)
{
    if (isset($date) && $date <> '0000-00-00 00:00:00' && $date <> null) {
        $date = date_create($date);
        $date = date_format($date,'d M Y H:i');
        return $date;
    }
}
function gen_thumb($src, $size='300x300')
{
    return base_url(str_replace('/ori_', '/'.$size.'_',$src));
}