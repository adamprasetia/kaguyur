<div class="box box-default">
    <div class="box-header with-border">
        <form id="form_data" action="<?php echo $action ?>" method="post">
        <div class="form-group">
            <input type="hidden" id="input_id" name="input_id" value="<?php echo isset($data->id)?$data->id:'' ?>">
            <label>Judul *</label>
            <input type="text" id="title" name="title" class="form-control" value="<?php echo isset($data->title)?htmlentities($data->title):'' ?>">
            <?php if (isset($data->status) && $data->status=='PUBLISH'): ?>
                <label class="label label-default">Publish at <?php echo format_dmy($data->published_date) ?></label>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label>Description *</label>
            <textarea id="description" name="description" class="form-control"><?php echo isset($data->description)?htmlentities($data->description):'' ?></textarea>
        </div>
        <div class="form-group">
            <label>Image *</label>
            <br/>
            <input type="button" name="choose" id="choose" class="btn btn-default btn-sm btn-dialog" value="Choose Photo" data-title="Pilih Cover" data-url="<?php echo base_url('photo').'?modals=true'; ?>">
        </div>
        <div class="form-group">
            <div class="media">
                <div class="media-left">
                <img id="image_img" src="<?php echo isset($data->image)?config_item('base_domain').$data->image:''; ?>" class="media-object" style="width: 300px;height: auto;border-radius: 10px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
                <input type="hidden" id="image" name="image" value="<?php echo isset($data->image)?$data->image:''; ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
            <textarea id="content" name="content" class="form-control" rows="100"><?php echo isset($data->content)?$data->content:'' ?></textarea>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="pin" name="pin" value="1" <?php echo !empty($data->pin)?'checked':'' ?>>
            <label class="form-check-label" for="pin">Pin</label>
        </div>
        <div class="form-group">
            <label>Tag *</label>
            <textarea id="tag" name="tag" class="form-control"><?php echo isset($data->tag)?htmlentities($data->tag):'' ?></textarea>
        </div>
        <div class="form-group">
        <label>Status *</label>
        <select name="status" id="status" class="form-control">
            <option value="DRAFT" <?php echo isset($data->status) && $data->status=='DRAFT'?'selected':''?>>DRAFT</option>
            <option value="PUBLISH" <?php echo isset($data->status) && $data->status=='PUBLISH'?'selected':''?>>PUBLISH</option>
            <option value="DELETED" <?php echo isset($data->status) && $data->status=='DELETED'?'selected':''?>>DELETED</option>
        </select>
        </div>
        </form>
    </div>
    <div class="box-footer">
        <button type="button" class="btn_action btn btn-sm btn-warning" data-idle="<i class='fa fa-save'></i> Save" data-form="#form_data" data-redirect="<?php echo base_url('article/index').get_query_string() ?>" data-form="#form_data" data-process="Saving..."><i class="fa fa-save"></i> Save</button>
        <button type="button" class="btn_close btn btn-sm btn-default" data-idle="Close" data-process="Closing..." data-redirect="<?php echo base_url('article/index').get_query_string() ?>"><i class="fa fa-close"></i> Close</button>
    </div>
</div>
<?php $this->load->view('script/article') ?>