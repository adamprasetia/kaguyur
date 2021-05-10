<div class="section py-20 bg-cover bg-no-repeat mt-10">
    <!-- section -->
    <div class="container px-5 mx-auto">
    <h1 class="font-bold uppercase"><?php echo $title ?></h1>
    <div class="text-sm">
          <form method="post" id="form_data" action="<?php echo $action ?>">
            <div class="mb-3">
              <label class="font-semibold block">Judul</label>
              <input class="field w-full" type="text" name="title" id="title" value="<?php echo isset($data->title)?$data->title:''; ?>"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Deskripsi</label>
              <textarea class="field w-full" name="description" cols="30" rows="5"><?php echo isset($data->description)?$data->description:''; ?></textarea>
            </div>
            <div class="mb-3">
              <textarea class="field w-full" id="content" name="content" cols="30" rows="5"><?php echo isset($data->content)?$data->content:''; ?></textarea>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="DRAFT" <?php echo isset($data->status) && $data->status=='DRAFT'?'selected':''?>>DRAFT</option>
                    <option value="PUBLISH" <?php echo isset($data->status) && $data->status=='PUBLISH'?'selected':''?>>PUBLISH</option>
                    <option value="DELETED" <?php echo isset($data->status) && $data->status=='DELETED'?'selected':''?>>DELETED</option>
                </select>
            </div>
            <div class="flex items-center justify-center my-5">
                <button type="button" class="btn btn__black btn_action" id="btn_simpan" data-idle="SIMPAN" data-process="Saving..." data-form="#form_data" data-redirect="<?php echo current_url(); ?>">SIMPAN</button>
                &nbsp;
                <a href="<?php echo base_url('artikel/list') ?>" class="btn btn__black">KEMBALI</a>
            </div>
          </form>
        </div>
    </div>
</div>