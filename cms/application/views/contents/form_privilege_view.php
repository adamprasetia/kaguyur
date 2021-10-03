<div class="box box-default">
    <div class="box-header with-border">
    <?php echo isset($title)?$title:''?>
    </div>
    <div class="box-body">
        <form id="form_data" action="<?php echo $action ?>">
            <div class="form-group">
                <input type="hidden" id="input_id" name="input_id" value="<?php echo isset($data->id)?$data->id:'' ?>">
                <label>Name *</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo isset($data->name)?htmlentities($data->name):'' ?>">
            </div>

            <div class="form-group">
                <label>Module *</label>
                <?php foreach($module_list as $row): ?>
                <div class="form-check">
                    <input name="module[]" class="form-check-input" type="checkbox" <?php echo (isset($data_module) && in_array($row->id, $data_module))?'checked':'' ?> value="<?php echo $row->id ?>">
                    <label class="form-check-label">
                    <?php echo $row->name ?>
                    </label>
                </div>
                <?php endforeach ?>
            </div>

            <div class="form-group">
                <label>Komunitas *</label>
                <?php foreach($komunitas_list as $row): ?>
                <div class="form-check">
                    <input name="komunitas[]" class="form-check-input" type="checkbox" <?php echo (isset($data_komunitas) && in_array($row->id, $data_komunitas))?'checked':'' ?> value="<?php echo $row->id ?>">
                    <label class="form-check-label">
                    <?php echo $row->name ?>
                    </label>
                </div>
                <?php endforeach ?>
            </div>

        </form>                    
    </div>
    <div class="box-footer">
        <button type="button" class="btn_action btn btn-sm btn-warning" data-idle="<i class='fa fa-save'></i> Save" data-form="#form_data" data-process="Saving..." data-redirect="<?php echo base_url('privilege/index').get_query_string() ?>"><i class="fa fa-send"></i> Save</button>
        <button type="button" name="button" class="btn btn-default btn_close" data-redirect="<?php echo base_url('privilege/index').get_query_string() ?>">Close</button>
    </div>
</div>
