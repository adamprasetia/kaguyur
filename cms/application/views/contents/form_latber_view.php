<div class="box box-default">
<div class="box-header with-border"><?php echo isset($title)?$title:''?></div>
  <div class="box-body with-border">        
    <form id="form_data" action="<?php echo $action ?>">
    <div class="form-group">
      <input type="hidden" id="input_id" name="input_id" value="<?php echo isset($data->id)?$data->id:'' ?>">
      <label>Nama Lengkap *</label>
      <input type="text" id="name" name="name" class="form-control" value="<?php echo isset($data->name)?$data->name:''; ?>">
    </div>
    <div class="form-group">
      <label>No Telepon/Wa *</label>
      <input type="text" id="phone" name="phone" class="form-control" value="<?php echo isset($data->phone)?$data->phone:''; ?>">
    </div>
    <div class="form-group">
      <label>Alamat *</label>
      <textarea name="address" id="address" cols="30" rows="10" class="form-control"><?php echo isset($data->address)?$data->address:''; ?></textarea>
    </div>
    <div class="form-group">
        <label>Kelas *</label>
        <select id="class" name="class" class="form-control">
            <option value="">- Pilih Kelas -</option>
            <?php foreach($class_list as $row): ?>
            <option value="<?php echo $row->name ?>" <?php echo (isset($data->class) && $data->class==$row->name)?'selected':'' ?>><?php echo $row->name ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group">
      <label>Status *</label>
      <select name="status" id="status" class="form-control">
        <option value="PENDING" <?php echo isset($data->status) && $data->status=='PENDING'?'selected':''?>>PENDING</option>
        <option value="VERIFIED" <?php echo isset($data->status) && $data->status=='VERIFIED'?'selected':''?>>VERIFIED</option>
        <option value="NOT VERIFIED" <?php echo isset($data->status) && $data->status=='NOT VERIFIED'?'selected':''?>>NOT VERIFIED</option>
        <option value="DELETED" <?php echo isset($data->status) && $data->status=='DELETED'?'selected':''?>>DELETED</option>
      </select>
    </div>
    </form>
  </div>
  <div class="box-footer">
    <button type="button" class="btn_action btn btn-sm btn-warning" data-idle="<i class='fa fa-save'></i> Save" data-form="#form_data" data-process="Saving..." data-redirect="<?php echo base_url('latber/index').get_query_string() ?>"><i class="fa fa-send"></i> Save</button>
    <button type="button" class="btn_close btn btn-sm btn-default" data-idle="Close" data-process="Closing..." data-redirect="<?php echo base_url('latber/index').get_query_string() ?>"><i class="fa fa-close"></i> Close</button>
  </div>
</div>