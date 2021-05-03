<div class="box box-default">
    <div class="box-header with-border">
        <?php echo isset($title)?$title:''?>
    </div>
    <div class="box-body">
        <form id="form_data" action="<?php echo $action ?>" method="post">
            <div class="form-group">
                <input type="hidden" id="input_id" name="input_id" value="<?php echo isset($data->id)?$data->id:'' ?>">
                <label>Username *</label>
                <input type="text" id="username" name="username" class="form-control" value="<?php echo isset($data->username)?htmlentities($data->username):'' ?>">
            </div>
            <div class="form-group">
                <label>Password *</label>
                <input autocomplete="off" type="text" id="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label>Privilege *</label>
                <select id="privilege" name="id_privilege" class="form-control">
                    <?php foreach($privilege_list as $row): ?>
                    <option value="<?php echo $row->id ?>" <?php echo (isset($data->id_privilege) && $data->id_privilege==$row->id)?'selected':'' ?>><?php echo $row->name ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </form>                    
    </div>
    <div class="box-footer">
        <button type="button" class="btn_action btn btn-sm btn-warning" data-idle="<i class='fa fa-save'></i> Save" data-form="#form_data" data-process="Saving..." data-redirect="<?php echo base_url('users/index').get_query_string() ?>"><i class="fa fa-send"></i> Save</button>
        <button type="button" name="button" class="btn btn-default btn_close" data-redirect="<?php echo base_url('users/index').get_query_string() ?>">Close</button>
    </div>
</div>