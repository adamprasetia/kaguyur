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
            $data = 'assets/photo/'.date('Y/m/d/').'ori_'.$filename;
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
    if (!is_dir($upload_path)) {
        if(!@mkdir($upload_path, 0755, true)){
            $error = error_get_last();
            echo json_encode(array('id'=>1,'action'=>'update', 'message'=>$error));
        }
    }
    $config['upload_path'] = $upload_path;
    $config['file_name'] = 'ori_'.$filename;
    $config['allowed_types'] = 'jpeg|jpg|png|pdf';
    $config['max_size'] = 2000000; // 2MB
    $config['overwrite'] = false;

    ci()->upload->initialize($config);

    if (!ci()->upload->do_upload())
    {
        return FALSE;
    }else{
        crop($filename, $upload_path);
        return TRUE;
    }
}

function crop($filename,$upload_path)
{
    ci()->load->library('image_lib');
    $ratio = [
        [300,300],
        [320,240],
        [100,100],
    ];
    foreach ($ratio as $row) {	
        // resize
        $config['image_library'] = 'gd2';
        $config['source_image'] = $upload_path.'/ori_'.$filename;
        $config['new_image'] = $upload_path.'/'.$row[0].'x'.$row[1].'_'.$filename;
        // $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = $row[0];
        $config['height']       = $row[1];
        $imageSize = ci()->image_lib->get_image_properties($config['source_image'], TRUE);
        $config['y_axis'] = ($imageSize['height'] - $config['height']) / 2;
        $config['x_axis'] = ($imageSize['width'] - $config['width']) / 2;
        ci()->image_lib->initialize($config);

        if ( ! ci()->image_lib->resize())
        {	
            echo ci()->image_lib->display_errors();
        }

        // crop
        $config['image_library'] = 'gd2';
        $config['source_image'] = $upload_path.'/'.$row[0].'x'.$row[1].'_'.$filename;
        $config['new_image'] = $upload_path.'/'.$row[0].'x'.$row[1].'_'.$filename;
        // $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = FALSE;
        $config['width']         = $row[0];
        $config['height']       = $row[1];
        $imageSize = ci()->image_lib->get_image_properties($config['source_image'], TRUE);
        $config['y_axis'] = ($imageSize['height'] - $config['height']) / 2;
        $config['x_axis'] = ($imageSize['width'] - $config['width']) / 2;
        ci()->image_lib->initialize($config);

        if ( ! ci()->image_lib->crop())
        {	
            echo ci()->image_lib->display_errors();
        }
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

function generate_json_anggota($id = '')
{
    ci()->load->model('global_model');
    if(!empty($id)){
        $member = ci()->global_model->get([
            'table'=>'member',
            'where'=>[
                'id'=>$id
            ]
        ])->row_array();
        create_json('member_'.$id.'.json', json_encode($member));
    }else{
        $member = ci()->global_model->get([
            'table'=>'member',
            'where'=>[
                'status'=>'VERIFIED'
            ]
        ])->result_array();
        create_json('member.json', json_encode($member));
    }
}

function generate_json_product($id = '')
{
    ci()->load->model('global_model');
    if(!empty($id)){
        $data = ci()->global_model->get([
            'select'=>'a.*, b.logo, b.phone, b.farm',
            'table'=>'product a',
            'where'=>[
                'a.id'=>$id
            ],
            'join'=>[['member b','a.created_by = b.id']]
        ])->row_array();
        create_json('product_'.$id.'.json', json_encode($data));
    }else{
        $data = ci()->global_model->get([
            'table'=>'product',
            'where'=>[
                'status'=>'ACTIVE'
            ],
            'order'=>[
                'created_date'=>'desc'
            ]
        ])->result_array();
        create_json('product.json', json_encode($data));
    }
}

function generate_json_product_member($id = '')
{
    ci()->load->model('global_model');
    if(!empty($id)){
        $data = ci()->global_model->get([
            'table'=>'product',
            'where'=>[
                'status'=>'ACTIVE',
                'created_by'=>$id
            ],
            'order'=>[
                'created_date'=>'desc'
            ]
        ])->result_array();
        create_json('product_member_'.$id.'.json', json_encode($data));
    }
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

function check_login_status()
{
    if(!ci()->user_login['id']){
        redirect('login');
        exit;
    }
    if(ci()->user_login['status'] != 'VERIFIED'){
        redirect('');
        exit;
    }
}