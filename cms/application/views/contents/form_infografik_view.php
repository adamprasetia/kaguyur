<div class="box box-default">
  <div class="box-header with-border"><?php echo isset($title)?$title:''?></div>
  <div class="box-body with-border">        
    <form id="form_data" action="<?php echo $action ?>">
    <div class="form-group">
      <input type="hidden" id="input_id" name="input_id" value="<?php echo isset($data->id)?$data->id:'' ?>">
      <label>Judul *</label>
      <input type="text" id="title" name="title" class="form-control" value="<?php echo isset($data->title)?$data->title:''; ?>">
    </div>
    <div class="form-group">
      <label>Image *</label>
      <br/>
      <input type="button" name="choose" id="choose" class="btn btn-default btn-sm btn-dialog" value="Choose Photo" data-title="Pilih infografik" data-url="<?php echo base_url('photo').'?modals=true'; ?>">
    </div>
    <div class="form-group">
      <div class="media">
        <div class="media-left">
          <img id="image_img" src="<?php echo isset($data->image)?config_item('base_domain').$data->image:''; ?>" class="media-object" style="width: 300px;height: auto;border-radius: 10px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
          <input type="hidden" id="image" name="image" value="<?php echo isset($data->image)?$data->image:''; ?>">
        </div>
      </div>
    </div>
    </form>
  </div>
  <div class="box-footer">
    <button type="button" class="btn_action btn btn-sm btn-warning" data-idle="<i class='fa fa-save'></i> Save" data-form="#form_data" data-process="Saving..." data-redirect="<?php echo base_url('infografik/index').get_query_string() ?>"><i class="fa fa-send"></i> Save</button>
    <button type="button" class="btn_close btn btn-sm btn-default" data-idle="Close" data-process="Closing..." data-redirect="<?php echo base_url('infografik/index').get_query_string() ?>"><i class="fa fa-close"></i> Close</button>
  </div>
</div>
<?php $this->load->view('script/infografik') ?>