<form id="form_data" action="<?php echo base_url('login/change_password/'.(isset($data->id)?$data->id:'')) ?>" method="post">
    <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title">Change Password</h3>
        </div>
        <div class="box-body">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Username</label>
                    <input placeholder="Username" autocomplete="off" type="text" id="username" name="username" class="form-control" value="<?php echo isset($username)?$username:'' ?>" readonly>
                </div>
                <div class="form-group">
                    <label>New Password *</label>
                    <input placeholder="New Password" autocomplete="off" type="password" id="password" name="password" class="form-control">
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button type="button" name="button" class="btn btn-warning btn_action" data-idle="Update" data-form="#form_data" data-formid="#input_id" data-process="Updating..." data-redirect="<?php echo base_url() ?>">Update</button>
            <button type="button" name="button" class="btn btn-default btn_close" data-redirect="<?php echo base_url() ?>">Close</button>
        </div>
    </div>
</form>
