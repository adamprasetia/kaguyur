<div class="box box-default">
    <div class="box-header with-border"><?php echo isset($title)?$title:''?></div>
    <div class="box-body">
            <form id="form_data" action="<?php echo $action ?>">
            <div class="form-group">
                <input type="hidden" id="input_id" name="input_id" value="<?php echo isset($data->id)?$data->id:'' ?>">
                <label>Name *</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo isset($data->name)?htmlentities($data->name):'' ?>">
            </div>
            </form>
    </div>
    <div class="box-footer">
    <button type="button" class="btn_action btn btn-sm btn-warning" data-idle="<i class='fa fa-save'></i> Save" data-process="Saving..." data-form="#form_data" data-redirect="<?php echo base_url('module/index').get_query_string() ?>"><i class="fa fa-send"></i> Save</button>
    <button type="button" name="button" class="btn btn-default btn_close" data-redirect="<?php echo base_url('module/index').get_query_string() ?>">Close</button>
    </div>
</div>
