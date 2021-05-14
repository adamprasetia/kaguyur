<div class="box box-default">
    <div class="box-header with-border">
        <form id="form_data" action="<?php echo $action ?>" method="post">
        <div class="form-group">
            <input type="hidden" id="input_id" name="input_id" value="<?php echo isset($data->id)?$data->id:'' ?>">
            <label>Judul *</label>
            <input type="text" id="title" name="title" class="form-control" value="<?php echo isset($data->title)?$data->title:'' ?>">
            <?php if (isset($data->status) && $data->status=='PUBLISH'): ?>
                <label class="label label-default">Publish at <?php echo format_dmy($data->published_date) ?></label>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label>Description *</label>
            <textarea id="description" name="description" class="form-control"><?php echo isset($data->description)?$data->description:'' ?></textarea>
        </div>
        <div class="form-group">
            <textarea id="content" name="content" class="form-control" rows="100"><?php echo isset($data->content)?$data->content:'' ?></textarea>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="pin" name="pin" value="1" <?php echo isset($data->pin)?'checked':'' ?>>
            <label class="form-check-label" for="pin">Pin</label>
        </div>
        <div class="form-group">
        <label>Status *</label>
        <select name="status" id="status" class="form-control">
            <option value="DRAFT" <?php echo $data->status=='DRAFT'?'selected':''?>>DRAFT</option>
            <option value="PUBLISH" <?php echo $data->status=='PUBLISH'?'selected':''?>>PUBLISH</option>
            <option value="DELETED" <?php echo $data->status=='DELETED'?'selected':''?>>DELETED</option>
        </select>
        </div>

        </form>
    </div>
    <div class="box-footer">
        <button type="button" class="btn_action btn btn-sm btn-warning" data-idle="<i class='fa fa-save'></i> Save" data-form="#form_data" data-redirect="<?php echo base_url('article/index').get_query_string() ?>" data-form="#form_data" data-process="Saving..."><i class="fa fa-save"></i> Save</button>
        <button type="button" class="btn_close btn btn-sm btn-default" data-idle="Close" data-process="Closing..." data-redirect="<?php echo base_url('article/index').get_query_string() ?>"><i class="fa fa-close"></i> Close</button>
    </div>
</div>
<script>
$(document).ready(function(){
    tinymce.init({
        selector: '#content',
        height: 1000,
        menubar: false,
        plugins: ['lists hr code photocms videocms media paste link table'],
        relative_urls: false,
        remove_script_host: false,
        toolbar: 'bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | table | undo redo | link | photocms | videocms | hr | code | formatselect fontsizeselect | media',
        setup: function(editor) {
            editor.on('Change', function(e) {
                $('#content').html(tinymce.get('content').getContent());
            });
        }
    });

    $("#general-modal-iframe").on('load',function () {
        $(this).contents().find(".btn_add_photo").click(function(){
            var id = $(this).attr('data-id');
            var id_tinymce = $(this).attr('data-id-tinymce');
            var imagedata = $("#general-modal-iframe").contents().find('.imagedata-'+id).data();
            tinymce.get(id_tinymce).execCommand('mceInsertContent', false, '<img width="100%" src="'+base_domain+imagedata.src+'">');
            $('#general-modal').modal('hide');
        });

        $(this).contents().find(".btn_add_video").click(function(){
            var id = $(this).attr('data-id');
            var videodata = $("#general-modal-iframe").contents().find('.videodata-'+id).data();
            console.log(videodata);
            tinymce.execCommand('mceInsertContent', false, '<iframe class="video" width="100%" height="100%" src="'+videodata.embed+'"></iframe>');
            $('#general-modal').modal('hide');
        });

    });

    

});

</script>