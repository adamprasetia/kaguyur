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
      <label>Cover</label>
      <br/>
      <input type="button" name="choose" id="choose" class="btn btn-default btn-sm btn-dialog" value="Choose Photo" data-title="Pilih untuk Cover" data-url="<?php echo base_url('photo').'?modals=true'; ?>">
    </div>
    <div class="form-group">
      <div class="media">
        <div class="media-left">
          <img id="cover_img" src="<?php echo isset($data->cover)?config_item('base_domain').$data->cover:''; ?>" class="media-object" style="width: 300px;height: auto;border-radius: 10px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
          <input type="hidden" id="cover" name="cover" value="<?php echo isset($data->cover)?$data->cover:''; ?>">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label>Photo</label>
      <br/>
      <a href="javascript:void(0)" class="btn btn-default btn-sm btn-dialog" data-title="Pilih untuk Photo" data-url="<?php echo base_url('photo').'?modals=true'; ?>"><i class="fa fa-plus"></i> Tambah Photo</a>
    </div>

    <div class="form-group">
        <div class="row photo-wrap">
            <?php 
            if(!empty($data->photo)){
            $photo = json_decode($data->photo);
            foreach ($photo as $row) { ?>                
            <div class="col-md-3 col-sm-4 col-xs-12" style="margin-bottom:10px">
                <img src="<?php echo config_item('base_domain').$row ?>" alt="" style="background-color:#ffdab3" class="img-responsive img-thumbnail item" title="">
                <div style="position:absolute;bottom:10px;margin-left:10px">
                    <input type="hidden" name="photo[]" value="<?php echo $row ?>">
                    <button class="btn btn-danger btn-xs btn_delete_photo" type="button" name="button" onclick="delete_photo(this)"><i class="fa fa-trash"></i> Hapus</button>
                </div>
            </div>
            <?php }} ?>
        </div>
    </div>
    </form>
  </div>
  <div class="box-footer">
    <button type="button" class="btn_action btn btn-sm btn-warning" data-idle="<i class='fa fa-save'></i> Save" data-form="#form_data" data-process="Saving..." data-redirect="<?php echo base_url('gallery/index').get_query_string() ?>"><i class="fa fa-send"></i> Save</button>
    <button type="button" class="btn_close btn btn-sm btn-default" data-idle="Close" data-process="Closing..." data-redirect="<?php echo base_url('gallery/index').get_query_string() ?>"><i class="fa fa-close"></i> Close</button>
  </div>
</div>
<?php $this->load->view('script/gallery') ?>