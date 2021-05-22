<?php if(!empty($data->id)): ?>
<div class="box box-default">
  <div class="box-header with-border">BARCODE</div>
  <div class="box-body with-border">        
    <img src="<?php echo config_item('base_domain').'assets/photo/barcode/'.$data->id.'.png'?>" alt="">
  </div>
  <div class="box-footer">        
    <form id="form_barcode" action="<?php echo base_url('member/generate_barcode/'.$data->id) ?>">
      <button type="button" class="btn_action btn btn-sm btn-primary" data-idle="Generate" data-form="#form_barcode" data-process="Tunggu Sebentar..." data-redirect="<?php echo base_url('member/edit/'.$data->id) ?>">GENERATE BARCODE</button>  
    </form>
  </div>
</div>
<?php endif ?>

<div class="box box-default">
<div class="box-header with-border"><?php echo isset($title)?$title:''?></div>
  <div class="box-body with-border">        
    <form id="form_data" action="<?php echo $action ?>">
    <div class="form-group">
      <input type="hidden" id="input_id" name="input_id" value="<?php echo isset($data->id)?$data->id:'' ?>">
      <label>Nama Farm *</label>
      <input type="text" id="farm" name="farm" class="form-control" value="<?php echo isset($data->farm)?$data->farm:''; ?>">
    </div>
    <div class="form-group">
      <input type="hidden" id="input_id" name="input_id" value="<?php echo isset($data->id)?$data->id:'' ?>">
      <label>Nama Lengkap *</label>
      <input type="text" id="name" name="name" class="form-control" value="<?php echo isset($data->name)?$data->name:''; ?>">
    </div>
    <div class="form-group">
      <label>Alamat *</label>
      <textarea name="address" id="address" cols="30" rows="10" class="form-control"><?php echo isset($data->address)?$data->address:''; ?></textarea>
    </div>
    <div class="form-group">
      <label>Mulai Budidaya Sejak</label>
      <input type="text" id="start" name="start" class="form-control" value="<?php echo isset($data->start)?$data->start:''; ?>">
    </div>
    <div class="form-group">
      <label>No Telepon/Wa *</label>
      <input type="text" id="phone" name="phone" class="form-control" value="<?php echo isset($data->phone)?$data->phone:''; ?>">
    </div>
    <div class="form-group">
      <label>Email *</label>
      <input type="text" id="email" name="email" class="form-control" value="<?php echo isset($data->email)?$data->email:''; ?>">
    </div>
    <div class="form-group">
      <label>Strain Guppy*</label>
      <textarea name="strain" id="strain" cols="30" rows="10" class="form-control"><?php echo isset($data->strain)?$data->strain:''; ?></textarea>
    </div>
    <div class="form-group">
      <label>Instagram</label>
      <input type="text" id="ig" name="ig" class="form-control" value="<?php echo isset($data->ig)?$data->ig:''; ?>">
    </div>
    <div class="form-group">
      <label>Twitter</label>
      <input type="text" id="tw" name="tw" class="form-control" value="<?php echo isset($data->tw)?$data->tw:''; ?>">
    </div>
    <div class="form-group">
      <label>Facebook</label>
      <input type="text" id="fb" name="fb" class="form-control" value="<?php echo isset($data->fb)?$data->fb:''; ?>">
    </div>
    <div class="form-group">
      <label>Pas Foto</label>
      <br/>
      <input type="button" name="choose" id="choose" class="btn btn-default btn-sm btn-dialog" value="Choose Photo" data-title="Pilih untuk pas foto" data-url="<?php echo base_url('photo').'?modals=true'; ?>">
    </div>
    <div class="form-group">
      <div class="media">
        <div class="media-left">
          <img id="photo_img" src="<?php echo isset($data->photo)?config_item('base_domain').$data->photo:''; ?>" class="media-object" style="width: 300px;height: auto;border-radius: 10px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
          <input type="hidden" id="photo" name="photo" value="<?php echo isset($data->photo)?$data->photo:''; ?>">
        </div>
      </div>
    </div>
    <div class="form-group">
      <label>Logo</label>
      <br/>
      <input type="button" name="choose" id="choose" class="btn btn-default btn-sm btn-dialog" value="Choose Photo" data-title="Pilih untuk logo" data-url="<?php echo base_url('photo').'?modals=true'; ?>">
    </div>
    <div class="form-group">
      <div class="media">
        <div class="media-left">
          <img id="logo_img" src="<?php echo isset($data->logo)?config_item('base_domain').$data->logo:''; ?>" class="media-object" style="width: 300px;height: auto;border-radius: 10px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
          <input type="hidden" id="logo" name="logo" value="<?php echo isset($data->logo)?$data->logo:''; ?>">
        </div>
      </div>
    </div>
    <div class="form-group">
        <label>Privilege *</label>
        <select id="privilege" name="id_privilege" class="form-control">
            <option value=""></option>
            <?php foreach($privilege_list as $row): ?>
            <option value="<?php echo $row->id ?>" <?php echo (isset($data->id_privilege) && $data->id_privilege==$row->id)?'selected':'' ?>><?php echo $row->name ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group">
      <label>Status *</label>
      <select name="status" id="status" class="form-control">
        <option value="PENDING" <?php echo isset($data->status) && $data->status=='PENDING'?'selected':''?>>PENDING</option>
        <option value="VERIFIED" <?php echo isset($data->status) && $data->status=='VERIFIED'?'selected':''?>>VERIFIED</option>
        <option value="NOT VERIFIED" <?php echo isset($data->status) && $data->status=='NOT VERIFIED'?'selected':''?>>NOT VERIFIED</option>
        <option value="BANNED" <?php echo isset($data->status) && $data->status=='BANNED'?'selected':''?>>BANNED</option>
        <option value="DELETED" <?php echo isset($data->status) && $data->status=='DELETED'?'selected':''?>>DELETED</option>
      </select>
    </div>
    </form>
  </div>
  <div class="box-footer">
    <button type="button" class="btn_action btn btn-sm btn-warning" data-idle="<i class='fa fa-save'></i> Save" data-form="#form_data" data-process="Saving..." data-redirect="<?php echo base_url('member/index').get_query_string() ?>"><i class="fa fa-send"></i> Save</button>
    <button type="button" class="btn_close btn btn-sm btn-default" data-idle="Close" data-process="Closing..." data-redirect="<?php echo base_url('member/index').get_query_string() ?>"><i class="fa fa-close"></i> Close</button>
  </div>
</div>
<?php $this->load->view('script/member') ?>