<form id="form_data" action="<?php echo $action ?>" method="post">
    <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title"><?php echo $title; ?></h3>
        </div>
        <div class="box-body">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="hidden" id="id" name="id" value="<?php echo isset($data->id)?$data->id:'' ?>" required>
                    <label>Judul *</label>
                    <input placeholder="Title" autocomplete="off" type="text" id="title" name="title" class="form-control" value="<?php echo isset($data->title)?$data->title:'' ?>">
                </div>
                <div class="form-group">
                    <input type="hidden" id="id" name="id" value="<?php echo isset($data->id)?$data->id:'' ?>" required>
                    <label>Link Youtube *</label>
                    <input autocomplete="off" type="text" id="url" name="url" class="form-control" value="<?php echo isset($data->url)?$data->url:'' ?>">
                </div>
                <?php if(!empty($data->id_youtube)){ ?>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $data->id_youtube ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <?php } ?>
            </div>
        </div>
        <div class="box-footer">
            <button type="button" name="button" class="btn btn-primary btn_action" data-idle="Save" data-form="#form_data" data-formid="#id" data-process="Saving..." data-action="<?php echo base_url('video/add') ?>" data-redirect="<?php echo base_url('video/index').get_query_string() ?>">Save</button>
            <button type="button" name="button" class="btn btn-default btn_close" data-redirect="<?php echo base_url('video/index').get_query_string() ?>">Close</button>
        </div>
    </div>
</form>
