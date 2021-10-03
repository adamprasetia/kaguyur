<div class="box box-default">
    <div class="box-header with-border"><?php echo isset($title)?$title:''?></div>
    <div class="box-body">
        <form id="form_data" action="<?php echo $action ?>">
        <div class="form-group">
            <input type="hidden" id="input_id" name="input_id" value="<?php echo isset($data->id)?$data->id:'' ?>">
            <label>Nama Komunitas *</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo isset($data->name)?htmlentities($data->name):'' ?>">
        </div>
        <div class="form-group">
            <label>Logo *</label>
            <br/>
            <input type="button" name="choose" id="choose" class="btn btn-default btn-sm btn-dialog" value="Choose Photo" data-title="Pilih untuk logo" data-url="<?php echo base_url('photo').'?modals=true'; ?>">
        </div>
        <div class="form-group">
        <div class="media">
            <div class="media-left">
            <img id="logo_img" src="<?php echo isset($data->logo)?gen_thumb($data->logo,'300x300'):''; ?>" class="media-object" style="width: 300px;height: auto;border-radius: 10px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
            <input type="hidden" id="logo" name="logo" value="<?php echo isset($data->logo)?$data->logo:''; ?>">
            </div>
        </div>
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
        <button type="button" class="btn_action btn btn-sm btn-warning" data-idle="<i class='fa fa-save'></i> Save" data-process="Saving..." data-form="#form_data" data-redirect="<?php echo base_url('komunitas/index').get_query_string() ?>"><i class="fa fa-send"></i> Save</button>
        <button type="button" name="button" class="btn btn-default btn_close" data-redirect="<?php echo base_url('komunitas/index').get_query_string() ?>">Close</button>
    </div>
</div>
<?php $this->load->view('script/komunitas') ?>